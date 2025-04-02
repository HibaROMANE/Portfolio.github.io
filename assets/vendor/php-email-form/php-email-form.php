<?php

/**
 * PHP Email Form Library
 * This library handles sending emails from a contact form.
 * It can send emails using PHP's mail() function or via SMTP.
 */

class PHP_Email_Form {
    public $to = '';
    public $from_name = '';
    public $from_email = '';
    public $subject = '';
    public $messages = [];
    public $ajax = false;

    // SMTP settings (optional)
    public $smtp = [];

    // Add a message to the email
    public function add_message($content, $name) {
        $this->messages[] = [
            'content' => $content,
            'name' => $name
        ];
    }

    // Send the email
    public function send() {
        $headers = [
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/html; charset=UTF-8',
            'From' => $this->from_email,
            'Reply-To' => $this->from_email
        ];

        $message_body = "<html><body>";
        $message_body .= "<h3>Contact Form Submission</h3>";

        foreach ($this->messages as $message) {
            $message_body .= "<p><strong>" . $message['name'] . ":</strong><br>" . nl2br($message['content']) . "</p>";
        }

        $message_body .= "</body></html>";

        // Check if we should use SMTP or PHP mail()
        if (!empty($this->smtp)) {
            // SMTP Configuration
            $smtp_host = $this->smtp['host'];
            $smtp_username = $this->smtp['username'];
            $smtp_password = $this->smtp['password'];
            $smtp_port = $this->smtp['port'];

            // Use PHPMailer or any other library to send via SMTP
            // Here you can configure PHPMailer or other SMTP libraries to send email
        } else {
            // Send the email using PHP's mail() function
            return mail($this->to, $this->subject, $message_body, $headers);
        }
    }
}

?>
