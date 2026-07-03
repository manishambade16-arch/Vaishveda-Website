<?php
/**
 * VAISHVEDA SMTP & NATIVE MAIL HELPER
 * Handles secure HTML email delivery via socket-level SMTP (e.g., Hostinger SMTP) or native PHP mail() fallback.
 */

function send_otp_email($to, $otp_code, $purpose_label = "Verification") {
    $subject = "Vaishveda Verification Code: $otp_code";
    
    // HTML email design matching Vaishveda luxury branding (cream/gold/charcoal)
    $message_html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>' . htmlspecialchars($subject) . '</title>
    </head>
    <body style="margin: 0; padding: 0; background-color: #FAF6F0; font-family: \'Georgia\', \'Times New Roman\', serif; color: #2C2C2C;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 40px auto; background-color: #FFFFFF; border: 1px solid #E8DFD0; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); overflow: hidden;">
            <!-- Header Banner -->
            <tr>
                <td style="padding: 40px 20px; text-align: center; background-color: #1E2D2F; color: #FFFFFF;">
                    <h1 style="margin: 0; font-size: 28px; letter-spacing: 2px; font-weight: normal; text-transform: uppercase;">Vaishveda</h1>
                    <p style="margin: 5px 0 0 0; font-size: 11px; letter-spacing: 4px; text-transform: uppercase; color: #C5A880;">Luxury Ayurveda</p>
                </td>
            </tr>
            <!-- Content Area -->
            <tr>
                <td style="padding: 40px 30px; line-height: 1.6; font-size: 15px;">
                    <h2 style="font-family: \'Georgia\', serif; font-weight: normal; font-size: 20px; color: #1E2D2F; margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid #E8DFD0; padding-bottom: 10px;">Security Verification</h2>
                    <p style="margin-bottom: 20px;">Hello,</p>
                    <p style="margin-bottom: 25px;">You have requested a 6-digit verification code to complete your <strong>' . htmlspecialchars($purpose_label) . '</strong> request on Vaishveda.</p>
                    
                    <!-- OTP Code Display -->
                    <div style="background-color: #FAF6F0; border-left: 4px solid #C5A880; border-radius: 6px; padding: 25px; text-align: center; margin-bottom: 30px;">
                        <span style="font-family: \'Courier New\', monospace; font-size: 36px; font-weight: bold; letter-spacing: 8px; color: #1E2D2F;">' . htmlspecialchars($otp_code) . '</span>
                        <p style="margin: 10px 0 0 0; font-size: 12px; color: #8C7D6B; font-style: italic;">This code is valid for 5 minutes. Please do not share it with anyone.</p>
                    </div>
                    
                    <p style="margin-bottom: 15px;">If you did not initiate this request, you can safely ignore this email.</p>
                    <p style="margin-bottom: 0;">Warm regards,<br><span style="color: #1E2D2F; font-weight: bold;">Vaishveda Circle</span></p>
                </td>
            </tr>
            <!-- Footer -->
            <tr>
                <td style="padding: 20px 30px; background-color: #FAF6F0; border-top: 1px solid #E8DFD0; text-align: center; font-size: 12px; color: #8C7D6B; line-height: 1.4;">
                    <p style="margin: 0;">&copy; ' . date("Y") . ' Vaishveda Luxury Ayurveda. All rights reserved.</p>
                    <p style="margin: 5px 0 0 0;"><a href="https://vaishveda.com" style="color: #1E2D2F; text-decoration: none; font-weight: bold;">vaishveda.com</a></p>
                </td>
            </tr>
        </table>
    </body>
    </html>
    ';

    // CONFIGURATIONS (Change these values to connect your Hostinger/Gmail/SMTP server)
    $smtp_host = 'smtp.hostinger.com';
    $smtp_port = 465; // Use 465 for SSL/TLS, or 587 for STARTTLS
    $smtp_user = 'no-reply@vaishveda.com'; // Your SMTP user email address
    $smtp_pass = 'YOUR_SMTP_PASSWORD';     // Your SMTP email password (leave default to fallback to mail())
    $from_email = 'no-reply@vaishveda.com';
    $from_name = 'Vaishveda Luxury Ayurveda';

    // FALLBACK: If SMTP password is not set/default, fallback to standard PHP mail()
    if ($smtp_pass === 'YOUR_SMTP_PASSWORD' || empty($smtp_pass)) {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: $from_name <$from_email>\r\n";
        $headers .= "Reply-To: $from_email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        return @mail($to, $subject, $message_html, $headers);
    }

    // SMTP Socket Handshake
    $host_prefix = ($smtp_port == 465) ? 'ssl://' : '';
    $socket = @fsockopen($host_prefix . $smtp_host, $smtp_port, $errno, $errstr, 10);
    if (!$socket) {
        error_log("Vaishveda SMTP Error: Connection failed: $errstr ($errno)");
        // Try fallback to PHP mail() on socket failure
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: $from_name <$from_email>\r\n";
        return @mail($to, $subject, $message_html, $headers);
    }

    // Reading socket response
    $read_resp = function($sock, $expected) {
        $resp = '';
        while ($line = fgets($sock, 515)) {
            $resp .= $line;
            if (substr($line, 3, 1) == ' ') break;
        }
        $code = substr($resp, 0, 3);
        if ($code != $expected) {
            error_log("Vaishveda SMTP Error: Expected $expected, got: $resp");
            return false;
        }
        return true;
    };

    if (!$read_resp($socket, '220')) { fclose($socket); return false; }

    fwrite($socket, "EHLO " . $_SERVER['SERVER_NAME'] . "\r\n");
    if (!$read_resp($socket, '250')) { fclose($socket); return false; }

    if ($smtp_port == 587) {
        fwrite($socket, "STARTTLS\r\n");
        if (!$read_resp($socket, '220')) { fclose($socket); return false; }
        stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        fwrite($socket, "EHLO " . $_SERVER['SERVER_NAME'] . "\r\n");
        if (!$read_resp($socket, '250')) { fclose($socket); return false; }
    }

    fwrite($socket, "AUTH LOGIN\r\n");
    if (!$read_resp($socket, '334')) { fclose($socket); return false; }

    fwrite($socket, base64_encode($smtp_user) . "\r\n");
    if (!$read_resp($socket, '334')) { fclose($socket); return false; }

    fwrite($socket, base64_encode($smtp_pass) . "\r\n");
    if (!$read_resp($socket, '235')) { fclose($socket); return false; }

    fwrite($socket, "MAIL FROM: <$from_email>\r\n");
    if (!$read_resp($socket, '250')) { fclose($socket); return false; }

    fwrite($socket, "RCPT TO: <$to>\r\n");
    if (!$read_resp($socket, '250')) { fclose($socket); return false; }

    fwrite($socket, "DATA\r\n");
    if (!$read_resp($socket, '354')) { fclose($socket); return false; }

    // SMTP Headers & Payload
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "To: <$to>\r\n";
    $headers .= "From: \"$from_name\" <$from_email>\r\n";
    $headers .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
    $headers .= "Date: " . date('r') . "\r\n";
    $headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $smtp_host . ">\r\n\r\n";

    fwrite($socket, $headers . $message_html . "\r\n.\r\n");
    if (!$read_resp($socket, '250')) { fclose($socket); return false; }

    fwrite($socket, "QUIT\r\n");
    fclose($socket);
    return true;
}
?>
