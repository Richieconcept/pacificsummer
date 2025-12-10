<?php

// Email address where messages will be sent
$receiving_email_address = 'pacifictravelsng@gmail.com';

// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Send email
    if (mail($receiving_email_address, "New Contact Form Message: $subject", $email_content, $email_headers)) {
        http_response_code(200);
        echo "Your message has been sent successfully!";
    } else {
        http_response_code(500);
        echo "Failed to send message. Please try again.";
    }

} else {
    http_response_code(403);
    echo "Invalid request.";
}
?>
