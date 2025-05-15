<?php
$to = "chaddi_3d@mail.ru";
$from = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
$name = htmlspecialchars($_REQUEST['name']);
$subject = htmlspecialchars($_REQUEST['subject']);
$number = htmlspecialchars($_REQUEST['number']);
$cmessage = htmlspecialchars($_REQUEST['message']);

if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
    die("Неверный email");
}

$headers = "From: $from\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$email_subject = "You have a message from your Bitmap Photography.";

$logo = 'https://example.com/img/logo.png'; // Абсолютный URL
$link = 'https://example.com';

$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
$body .= "<table style='width: 100%;'>";
$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
$body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
$body .= "</td></tr></thead><tbody><tr>";
$body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
$body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
$body .= "</tr>";
$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject}</td></tr>";
$body .= "<tr><td style='border:none;'><strong>Phone:</strong> {$number}</td></tr>";
$body .= "<tr><td></td></tr>";
$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
$body .= "</tbody></table>";
$body .= "</body></html>";

$send = mail($to, $email_subject, $body, $headers);

if ($send) {
    echo "Письмо отправлено!";
} else {
    echo "Ошибка при отправке письма.";
}
?>