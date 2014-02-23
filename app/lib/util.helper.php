<?php

class HelperUtil {

    public static function sendEmail($to, $from, $reply, $html, $text, $subject) {
        $boundary = uniqid('np');

        //headers - specify your from email address and name here
        //and specify the boundary for the email
        //$headers = "MIME-Version: 1.0\r\n";
        //$headers .= "From: $from \r\nReply-To: $reply \r\n";
        //$headers .= "To: " . $to . "\r\n";
        //$headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";
        $headers = 'MIME-Version: 1.0' . "\r\n" . 'From: ' . $from . "\r\n" . 'To: ' . $to . "\r\n" . 'Reply-To: ' . $reply . "\r\n" . "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";
        //  'X-Mailer: PHP/' . phpversion();
        //here is the content body
        $message = "This is a MIME encoded message.";
        $message .= "\r\n\r\n--" . $boundary . "\r\n";
        $message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";

        //Plain text body
        $message .= $text;
        $message .= "\r\n\r\n--" . $boundary . "\r\n";
        $message .= "Content-type: text/html;charset=utf-8\r\n\r\n";

        //Html body
        $message .= $html;
        $message .= "\r\n\r\n--" . $boundary . "--";

        //invoke the PHP mail function
        return @mail($to, $subject, $message, $headers);
    }

    public static function checkEmailAddress($email) {
        // First, we check that there's one @ symbol,
        // and that the lengths are right.
        if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
            // Email invalid because wrong number of characters
            // in one section or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
                return false;
            }
        }
        // Check if domain is IP. If not,
        // it should be valid domain name
        if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false;
                // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                    return false;
                }
            }
        }
        return true;
    }

    public static function shortText($text, $size) {
        // strip tags to avoid breaking any html
        $string = strip_tags($text);
        if (strlen($string) > $size) {
            $stringCut = substr($string, 0, $size);
            $posWhitespace = strrpos($stringCut, ' ');
            $string = substr($stringCut, 0, $posWhitespace) . '...';
        }
        return $string;
    }

    public static function isNullOrEmptyString($variable) {
        return (!isset($variable) || trim($variable) === '' || empty($variable));
    }

}

?>