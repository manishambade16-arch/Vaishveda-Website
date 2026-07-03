<?php
session_start();
header('Content-Type: application/json');
include 'db.php'; // This connects to MySQL and selects the 'vaishveda' database

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    // ----------------------------------------------------
    // ORDERS ENDPOINTS
    // ----------------------------------------------------
    case 'create_order':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input data.']);
            exit;
        }

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

    case 'list_orders':
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

    case 'list_all_orders':
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

    case 'update_order_status':
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

    case 'delete_order':
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

    // ----------------------------------------------------
    // USERS ENDPOINTS
    // ----------------------------------------------------
    case 'register_user':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input data.']);
            exit;
        }

        $email = isset($data['email']) ? $conn->real_escape_string(trim($data['email'])) : '';
        $name = isset($data['name']) ? $conn->real_escape_string(trim($data['name'])) : '';
        $phone = isset($data['phone']) ? $conn->real_escape_string(trim($data['phone'])) : '';
        $password = isset($data['password']) ? $data['password'] : '';

        if (empty($email) || empty($name) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Required fields (email, name, password) cannot be empty.']);
            exit;
        }

        // Check if user already exists
        $check = $conn->query("SELECT `email` FROM `users` WHERE `email` = '$email'");
        if ($check && $check->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'An account with this email address already exists.']);
            exit;
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $password_hash_escaped = $conn->real_escape_string($password_hash);

        // Seed default addresses, wallet transactions, notifications
        $wallet_txs = json_encode([
            [
                'date' => date("d-m-Y"),
                'type' => 'Welcome Bonus',
                'points' => 100,
                'balance' => 100
            ]
        ]);
        $wallet_txs_escaped = $conn->real_escape_string($wallet_txs);

        $notifications = json_encode([
            [
                'id' => time(),
                'title' => 'Welcome to Vaishveda!',
                'message' => 'Thank you for registering. You have been awarded 100 welcome reward points!',
                'date' => date("d-m-Y"),
                'read' => false
            ]
        ]);
        $notifications_escaped = $conn->real_escape_string($notifications);

        $sql = "INSERT INTO `users` (
            `email`, `name`, `phone`, `password_hash`, `reward_points`, `wallet_transactions`, `addresses`, `notifications`
        ) VALUES (
            '$email', '$name', '$phone', '$password_hash_escaped', 100, '$wallet_txs_escaped', '[]', '$notifications_escaped'
        )";

        if ($conn->query($sql)) {
            echo json_encode([
                'success' => true,
                'user' => [
                    'email' => $email,
                    'name' => $name,
                    'phone' => $phone,
                    'rewardPoints' => 100,
                    'walletTransactions' => json_decode($wallet_txs, true),
                    'addresses' => [],
                    'notifications' => json_decode($notifications, true)
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error during registration: ' . $conn->error]);
        }
        break;

    case 'login_user':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $email = isset($data['email']) ? $conn->real_escape_string(trim($data['email'])) : '';
        $password = isset($data['password']) ? $data['password'] : '';

        if (empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
            exit;
        }

        $res = $conn->query("SELECT * FROM `users` WHERE `email` = '$email'");
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            if (password_verify($password, $row['password_hash'])) {
                echo json_encode([
                    'success' => true,
                    'user' => [
                        'email' => $row['email'],
                        'name' => $row['name'],
                        'phone' => $row['phone'],
                        'rewardPoints' => (int)$row['reward_points'],
                        'walletTransactions' => json_decode($row['wallet_transactions'] ?: '[]', true),
                        'addresses' => json_decode($row['addresses'] ?: '[]', true),
                        'notifications' => json_decode($row['notifications'] ?: '[]', true)
                    ]
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid password credentials.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No account found with this email.']);
        }
        break;

    case 'sync_user':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input data.']);
            exit;
        }

        $email = isset($data['email']) ? $conn->real_escape_string($data['email']) : '';
        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Missing email ID.']);
            exit;
        }

        $name = isset($data['name']) ? $conn->real_escape_string($data['name']) : '';
        $phone = isset($data['phone']) ? $conn->real_escape_string($data['phone']) : '';
        $reward_points = isset($data['rewardPoints']) ? (int)$data['rewardPoints'] : 0;
        
        $wallet_txs = isset($data['walletTransactions']) ? json_encode($data['walletTransactions']) : '[]';
        $wallet_txs_escaped = $conn->real_escape_string($wallet_txs);

        $addresses = isset($data['addresses']) ? json_encode($data['addresses']) : '[]';
        $addresses_escaped = $conn->real_escape_string($addresses);

        $notifications = isset($data['notifications']) ? json_encode($data['notifications']) : '[]';
        $notifications_escaped = $conn->real_escape_string($notifications);

        $sql = "UPDATE `users` SET 
            `name` = '$name', 
            `phone` = '$phone', 
            `reward_points` = $reward_points, 
            `wallet_transactions` = '$wallet_txs_escaped', 
            `addresses` = '$addresses_escaped', 
            `notifications` = '$notifications_escaped' 
            WHERE `email` = '$email'";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    case 'delete_user':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $email = isset($data['email']) ? $conn->real_escape_string($data['email']) : '';
        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Missing email.']);
            exit;
        }

        $sql = "DELETE FROM `users` WHERE `email` = '$email'";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    case 'list_users':
        $sql = "SELECT `email`, `name`, `phone`, `reward_points`, `created_at` FROM `users` ORDER BY `created_at` DESC";
        $result = $conn->query($sql);
        $users = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = [
                    'email' => $row['email'],
                    'name' => $row['name'],
                    'phone' => $row['phone'],
                    'rewardPoints' => (int)$row['reward_points'],
                    'joinedDate' => $row['created_at'],
                    'status' => 'Active'
                ];
            }
        }
        echo json_encode($users);
        break;

    // ----------------------------------------------------
    // REVIEWS ENDPOINTS
    // ----------------------------------------------------
    case 'get_reviews':
        $product_id = isset($_GET['product_id']) ? $conn->real_escape_string($_GET['product_id']) : '';
        if (empty($product_id)) {
            echo json_encode([]);
            exit;
        }

        $sql = "SELECT * FROM `reviews` WHERE `product_id` = '$product_id' ORDER BY `created_at` DESC";
        $result = $conn->query($sql);
        $reviews = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reviews[] = [
                    'id' => (int)$row['id'],
                    'productId' => $row['product_id'],
                    'userName' => $row['user_name'],
                    'rating' => (int)$row['rating'],
                    'title' => $row['title'],
                    'comment' => $row['comment'],
                    'likes' => (int)$row['likes'],
                    'date' => $row['date'],
                    'verified' => (bool)$row['verified']
                ];
            }
        }
        echo json_encode($reviews);
        break;

    case 'create_review':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input data.']);
            exit;
        }

        $product_id = isset($data['productId']) ? $conn->real_escape_string($data['productId']) : '';
        $user_name = isset($data['userName']) ? $conn->real_escape_string($data['userName']) : '';
        $rating = isset($data['rating']) ? (int)$data['rating'] : 5;
        $title = isset($data['title']) ? $conn->real_escape_string($data['title']) : '';
        $comment = isset($data['comment']) ? $conn->real_escape_string($data['comment']) : '';
        $date = isset($data['date']) ? $conn->real_escape_string($data['date']) : date("d M Y");
        $verified = isset($data['verified']) ? ($data['verified'] ? 1 : 0) : 1;

        if (empty($product_id) || empty($user_name) || empty($comment)) {
            echo json_encode(['success' => false, 'message' => 'Product ID, user name, and comment are required.']);
            exit;
        }

        $sql = "INSERT INTO `reviews` (
            `product_id`, `user_name`, `rating`, `title`, `comment`, `likes`, `date`, `verified`
        ) VALUES (
            '$product_id', '$user_name', $rating, '$title', '$comment', 0, '$date', $verified
        )";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'review_id' => $conn->insert_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    case 'like_review':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $review_id = isset($data['review_id']) ? (int)$data['review_id'] : 0;

        if ($review_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid review ID.']);
            exit;
        }

        $sql = "UPDATE `reviews` SET `likes` = `likes` + 1 WHERE `id` = $review_id";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    // ----------------------------------------------------
    // FAQS ENDPOINTS
    // ----------------------------------------------------
    case 'get_faqs':
        $sql = "SELECT * FROM `faqs` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        $faqs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $faqs[] = [
                    'id' => $row['id'],
                    'category' => $row['category'],
                    'question' => $row['question'],
                    'answer' => $row['answer']
                ];
            }
        }
        echo json_encode($faqs);
        break;

    case 'save_faq':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input data.']);
            exit;
        }

        $id = isset($data['id']) ? $conn->real_escape_string($data['id']) : '';
        $category = isset($data['category']) ? $conn->real_escape_string($data['category']) : '';
        $question = isset($data['question']) ? $conn->real_escape_string($data['question']) : '';
        $answer = isset($data['answer']) ? $conn->real_escape_string($data['answer']) : '';

        if (empty($id) || empty($category) || empty($question) || empty($answer)) {
            echo json_encode(['success' => false, 'message' => 'Missing fields for FAQ object.']);
            exit;
        }

        $sql = "INSERT INTO `faqs` (`id`, `category`, `question`, `answer`) 
                VALUES ('$id', '$category', '$question', '$answer') 
                ON DUPLICATE KEY UPDATE 
                `category` = '$category', 
                `question` = '$question', 
                `answer` = '$answer'";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    case 'delete_faq':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $id = isset($data['id']) ? $conn->real_escape_string($data['id']) : '';

        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'Missing FAQ ID.']);
            exit;
        }

        $sql = "DELETE FROM `faqs` WHERE `id` = '$id'";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    // ----------------------------------------------------
    // POLICIES ENDPOINTS
    // ----------------------------------------------------
    case 'get_policy':
        $key = isset($_GET['key']) ? $conn->real_escape_string($_GET['key']) : '';
        if (empty($key)) {
            echo json_encode(null);
            exit;
        }

        $sql = "SELECT * FROM `policies` WHERE `key_name` = '$key'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode([
                'key_name' => $row['key_name'],
                'content_json' => json_decode($row['content_json'], true),
                'last_updated' => $row['last_updated']
            ]);
        } else {
            echo json_encode(null);
        }
        break;

    case 'save_policy':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input data.']);
            exit;
        }

        $key = isset($data['key_name']) ? $conn->real_escape_string($data['key_name']) : '';
        $content = isset($data['content_json']) ? json_encode($data['content_json']) : '{}';
        $content_escaped = $conn->real_escape_string($content);
        $last_updated = isset($data['last_updated']) ? $conn->real_escape_string($data['last_updated']) : date("d-m-Y H:i:s");

        if (empty($key)) {
            echo json_encode(['success' => false, 'message' => 'Missing policy key_name.']);
            exit;
        }

        $sql = "INSERT INTO `policies` (`key_name`, `content_json`, `last_updated`) 
                VALUES ('$key', '$content_escaped', '$last_updated') 
                ON DUPLICATE KEY UPDATE 
                `content_json` = '$content_escaped', 
                `last_updated` = '$last_updated'";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
        break;

    case 'send_email_otp':
        include_once 'mail_helper.php';
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input.']);
            exit;
        }

        $email = isset($data['email']) ? trim($data['email']) : '';
        $purpose = isset($data['purpose']) ? trim($data['purpose']) : 'Verification';

        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Email address is required.']);
            exit;
        }

        // Generate 6-digit random code
        $otp_code = strval(rand(100000, 999999));
        
        // Store in session
        $_SESSION['vaishveda_otp'] = [
            'email' => $email,
            'code' => $otp_code,
            'expires' => time() + 300 // Valid for 5 minutes
        ];

        // Send actual email (will use native mail() by default unless SMTP config password is set in mail_helper.php)
        $sent = send_otp_email($email, $otp_code, $purpose);
        if ($sent) {
            echo json_encode(['success' => true]);
        } else {
            // Check if we are running on localhost for local testing fallback
            $is_localhost = ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1' || strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false);
            if ($is_localhost) {
                echo json_encode(['success' => true, 'debug_otp' => $otp_code]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to deliver verification email.']);
            }
        }
        break;

    case 'verify_email_otp':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON input.']);
            exit;
        }

        $email = isset($data['email']) ? trim($data['email']) : '';
        $otp = isset($data['otp']) ? trim($data['otp']) : '';

        if (empty($email) || empty($otp)) {
            echo json_encode(['success' => false, 'message' => 'Email and OTP code are required.']);
            exit;
        }

        if (!isset($_SESSION['vaishveda_otp'])) {
            echo json_encode(['success' => false, 'message' => 'No active OTP verification session found.']);
            exit;
        }

        $session_otp = $_SESSION['vaishveda_otp'];
        
        // Verify email match, code match and expiration
        if (strcasecmp($session_otp['email'], $email) !== 0) {
            echo json_encode(['success' => false, 'message' => 'Email address mismatch.']);
            exit;
        }

        if ($session_otp['code'] !== $otp) {
            echo json_encode(['success' => false, 'message' => 'Incorrect verification code. Please try again.']);
            exit;
        }

        if (time() > $session_otp['expires']) {
            echo json_encode(['success' => false, 'message' => 'Verification code has expired. Please request a new one.']);
            exit;
        }

        // Clear session on successful validation
        unset($_SESSION['vaishveda_otp']);
        echo json_encode(['success' => true]);
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
