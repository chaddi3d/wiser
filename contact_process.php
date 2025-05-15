<?php
$to = "chaddi_3d@mail.ru";

// Собираем данные, подставляя пустые строки при отсутствии
$from = "noreply@wiser.kz";
$firstname = isset($_GET['firstname']) ? htmlspecialchars($_GET['firstname']) : '';
$lastname = isset($_GET['lastname']) ? htmlspecialchars($_GET['lastname']) : '';
$phone = isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : '';
$email = isset($_GET['email']) ? filter_var($_GET['email'], FILTER_SANITIZE_EMAIL) : '';
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';

// Проверка валидности email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Неверный email");
}

// Заголовки
$headers = "From: $from\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$email_subject = "Новая заявка на поступление";

// HTML-письмо с тем же стилем таблицы
$body = "<!DOCTYPE html><html lang='ru'><head><meta charset='UTF-8'><title>Заявка</title></head><body>";
$body .= "<table style='width: 100%;'>";
$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
$body .= "<h2>Заявка на поступление</h2>";
$body .= "</td></tr></thead><tbody><tr>";
if(!empty($firstname)) {
    $body .= "<td style='border:none;'><strong>Имя:</strong> {$firstname}</td>";
}
if(!empty($lastname)) {
    $body .= "<td style='border:none;'><strong>Фамилия:</strong> {$lastname}</td>";
}
$body .= "</tr><tr>";
if(!empty($phone)) {
    $body .= "<td style='border:none;'><strong>Телефон:</strong> {$phone}</td>";
}
if(!empty($email)) {
    $body .= "<td style='border:none;'><strong>Email:</strong> {$email}</td>";
}
$body .= "</tr><tr>";
if(!empty($message)) {
    $body .= "<td colspan='2' style='border:none;'><strong>Сообщение:</strong><br>{$message}</td>";
}
$body .= "</tr></tbody></table>";
$body .= "</body></html>";

// Отправка
$send = mail($to, $email_subject, $body, $headers);

if ($send) {
    header("Location: /");
} else {
    header("Location: /");
}
