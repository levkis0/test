<?php
// Токен вашого бота
$token = "7892443614:AAHkVSkHpJJtbioXlawxhPKu_6pLAw4j5mI";
// ID чату (отримайте його через @userinfobot у Telegram)
$chat_id = "5542983364";

// Отримання даних із форми
$name = $_POST['name'] ?? 'Не вказано';
$phone = $_POST['phone'] ?? 'Не вказано';
$product = $_POST['product'] ?? 'Не вказано';

// Формуємо текст повідомлення
$message = "Нове замовлення:\n";
$message .= "Ім'я: $name\n";
$message .= "Телефон: $phone\n";
$message .= "Товар: $product";

// Відправка повідомлення до Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";
$data = [
    'chat_id' => $chat_id,
    'text' => $message
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Повертаємо відповідь
if ($result) {
    echo 'OK';
} else {
    echo 'Error';
}
?>