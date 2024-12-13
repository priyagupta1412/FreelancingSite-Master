<?php
if (isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $msg = htmlspecialchars(strip_tags(trim($_POST['msg'])));

    if ($email === false) {
        echo "<h1>Invalid email format. Please try again.</h1>";
        exit;
    }

    // Define the recipient and email content
    $to = 'priyagupta12530@gmail.com'; // Replace with your email ID
    $subject = 'Form Submission';
    $message = "Name: " . $name . "\n" .
               "Phone: " . $phone . "\n" .
               "Wrote the following:\n\n" . $msg;
    $headers = "From: noreply@yourdomain.com\r\n"; // Use a generic "From" email address
    $headers .= "Reply-To: " . $email . "\r\n";

    // Send email and handle errors
    if (mail($to, $subject, $message, $headers)) {
        echo "<h1>Sent Successfully! Thank you, " . $name . ". We will contact you shortly!</h1>";
    } else {
        echo "<h1>Something went wrong! Please try again later.</h1>";
    }
}
?>
