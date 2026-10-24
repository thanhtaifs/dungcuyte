<?php

if (!defined('NV_IS_MOD_SHOPS')) {
    die('Stop!!!');
}

/** Finish checkout before contacting SMTP, keeping notification attempts in this worker. */
function nv_shops_checkout_redirect($url, array $messages, $order_id)
{
    ignore_user_abort(true);
    // Persist the cleared cart and release the lock before the success page opens.
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_write_close();
    }
    header('Location: ' . $url, true, 302);
    // Checkout returns only a redirect. Discard any buffered page/debug output.
    while (ob_get_level() > 0) {
        if (!ob_end_clean()) {
            break;
        }
    }
    header('Content-Length: 0');
    if (function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    } else {
        // Apache/mod_php (including XAMPP) can finish the HTTP response here too.
        header('Connection: close');
        flush();
    }

    foreach ($messages as $index => $message) {
        try {
            $sent = nv_sendmail($message['from'], $message['to'], $message['subject'], $message['body']);
            if (!$sent) {
                error_log('[shops-checkout] Email failed for order ' . (int)$order_id . ', message ' . $index);
            }
        } catch (Throwable $e) {
            // One failed notification must not prevent the remaining recipients.
            error_log('[shops-checkout] Email exception for order ' . (int)$order_id . ', message ' . $index);
        }
    }
    exit();
}
