<?php
header('Content-Type: application/json');
include 'db.php'; // This connects to MySQL and selects the 'vaishveda' database

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'create':
        // Read JSON payload from POST request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input data.']);
            exit;
        }

        // Extract and sanitize order details
        $id = isset($data['id']) ? $conn->real_escape_string($data['id']) : '';
        $user_email = isset($data['userEmail']) ? $conn->real_escape_string($data['userEmail']) : '';
        
        $customer = isset($data['customer']) ? $data['customer'] : [];
        $cust_name = isset($customer['name']) ? $conn->real_escape_string($customer['name']) : '';
        $cust_email = isset($customer['email']) ? $conn->real_escape_string($customer['email']) : '';
        $cust_phone = isset($customer['phone']) ? $conn->real_escape_string($customer['phone']) : '';
        $cust_address = isset($customer['address']) ? $conn->real_escape_string($customer['address']) : '';
        $cust_city = isset($customer['city']) ? $conn->real_escape_string($customer['city']) : '';
        $cust_state = isset($customer['state']) ? $conn->real_escape_string($customer['state']) : '';
        $cust_pincode = isset($customer['pincode']) ? $conn->real_escape_string($customer['pincode']) : '';

        $payment_method = isset($data['paymentMethod']) ? $conn->real_escape_string($data['paymentMethod']) : '';
        
        $payment_details = isset($data['paymentDetails']) ? $data['paymentDetails'] : [];
        $transaction_id = isset($payment_details['transactionId']) ? $conn->real_escape_string($payment_details['transactionId']) : null;
        $paypal_email = isset($payment_details['paypalEmail']) ? $conn->real_escape_string($payment_details['paypalEmail']) : null;

        $items = isset($data['items']) ? json_encode($data['items']) : '[]';
        $items_escaped = $conn->real_escape_string($items);

        $subtotal = isset($data['subtotal']) ? (float)$data['subtotal'] : 0.0;
        $shipping = isset($data['shipping']) ? (float)$data['shipping'] : 0.0;
        $total = isset($data['total']) ? (float)$data['total'] : 0.0;
        $status = isset($data['status']) ? $conn->real_escape_string($data['status']) : 'Pending';

        if (empty($id) || empty($cust_name) || empty($cust_email)) {
            echo json_encode(['success' => false, 'message' => 'Missing required order properties.']);
            exit;
        }

        // Insert into database
        $sql = "INSERT INTO `orders` (
            `id`, `user_email`, `customer_name`, `customer_email`, `customer_phone`, 
            `address`, `city`, `state`, `pincode`, `payment_method`, 
            `transaction_id`, `paypal_email`, `items`, `subtotal`, `shipping`, 
            `total`, `status`
        ) VALUES (
            '$id', '$user_email', '$cust_name', '$cust_email', '$cust_phone', 
            '$cust_address', '$cust_city', '$cust_state', '$cust_pincode', '$payment_method', 
            " . ($transaction_id !== null ? "'$transaction_id'" : "NULL") . ", 
            " . ($paypal_email !== null ? "'$paypal_email'" : "NULL") . ", 
            '$items_escaped', $subtotal, $shipping, $total, '$status'
        )";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'order_id' => $id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    case 'list':
        $email = isset($_GET['email']) ? $conn->real_escape_string($_GET['email']) : '';
        if (empty($email)) {
            echo json_encode([]);
            exit;
        }

        $sql = "SELECT * FROM `orders` WHERE `user_email` = '$email' OR `customer_email` = '$email' ORDER BY `created_at` DESC";
        $result = $conn->query($sql);
        $orders = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = formatOrderRow($row);
            }
        }
        echo json_encode($orders);
        break;

    case 'list_all':
        $sql = "SELECT * FROM `orders` ORDER BY `created_at` DESC";
        $result = $conn->query($sql);
        $orders = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = formatOrderRow($row);
            }
        }
        echo json_encode($orders);
        break;

    case 'update_status':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $order_id = isset($data['order_id']) ? $conn->real_escape_string($data['order_id']) : '';
        $status = isset($data['status']) ? $conn->real_escape_string($data['status']) : '';

        if (empty($order_id) || empty($status)) {
            echo json_encode(['success' => false, 'message' => 'Missing order ID or status values.']);
            exit;
        }

        $sql = "UPDATE `orders` SET `status` = '$status' WHERE `id` = '$order_id'";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    case 'delete':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $order_id = isset($data['order_id']) ? $conn->real_escape_string($data['order_id']) : '';

        if (empty($order_id)) {
            echo json_encode(['success' => false, 'message' => 'Missing order ID.']);
            exit;
        }

        $sql = "DELETE FROM `orders` WHERE `id` = '$order_id'";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action endpoint.']);
        break;
}

// Helper to format flat DB row back to the JS-compatible nested order object
function formatOrderRow($row) {
    return [
        'id' => $row['id'],
        'userEmail' => $row['user_email'],
        'customer' => [
            'name' => $row['customer_name'],
            'email' => $row['customer_email'],
            'phone' => $row['customer_phone'],
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'pincode' => $row['pincode']
        ],
        'paymentMethod' => $row['payment_method'],
        'paymentDetails' => [
            'transactionId' => $row['transaction_id'],
            'paypalEmail' => $row['paypal_email']
        ],
        'items' => json_decode($row['items'], true),
        'subtotal' => (float)$row['subtotal'],
        'shipping' => (float)$row['shipping'],
        'total' => (float)$row['total'],
        'status' => $row['status'],
        'createdAt' => $row['created_at']
    ];
}
?>
