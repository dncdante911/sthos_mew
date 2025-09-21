<?php
if ($_POST['message']) {
    $message = strip_tags($_POST['message']);
    $subject = strip_tags($_POST['subject'] ?? 'Сообщение с чата');
    $urgent = $_POST['urgent'] === '1';
    $page = strip_tags($_POST['page'] ?? '');
    $time = strip_tags($_POST['time'] ?? date('d.m.Y H:i:s'));
    $user_agent = strip_tags($_POST['user_agent'] ?? '');
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    
    // Разные email в зависимости от типа сообщения
    $to_email = $urgent ? 'support@sthost.pro, sales@sthost.pro' : 'support@sthost.pro';
    
    // Формируем тему письма
    $email_subject = $urgent ? "🚨 СРОЧНО: $subject" : $subject;
    
    $email_body = "
" . ($urgent ? "⚠️  КЛИЕНТ ЗАПРАШИВАЕТ ОПЕРАТОРА!\n\n" : "") . "
Время: $time
Страница: $page
IP адрес: $ip

Сообщение клиента:
\"$message\"

" . ($urgent ? "
👆 ТРЕБУЕТСЯ СВЯЗАТЬСЯ С КЛИЕНТОМ!
Рекомендуемые действия:
1. Позвонить по номеру (если есть в профиле)
2. Написать на email (если указан)  
3. Ответить в чате на сайте

" : "") . "
---
Браузер: $user_agent
Автоматическое уведомление с сайта sthost.pro
";

    // Отправляем email
    $headers = [
        'From: noreply@sthost.pro',
        'Reply-To: support@sthost.pro',
        'Content-Type: text/plain; charset=utf-8'
    ];
    
    mail($to_email, $email_subject, $email_body, implode("\r\n", $headers));
    
    // Логируем в файл для истории
    $log_entry = "[" . date('Y-m-d H:i:s') . "] " . 
                 ($urgent ? "[URGENT] " : "") . 
                 "IP: $ip | Message: $message" . 
                 ($urgent ? " | OPERATOR REQUESTED" : "") . "\n";
    
    file_put_contents(__DIR__ . '/chat_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode(['status' => 'sent', 'urgent' => $urgent]);
} else {
    echo json_encode(['status' => 'error']);
}

// Добавьте в функцию отправки уведомлений
if ($urgent) {
    sendSMS($message);
}

function sendSMS($message) {
    $api_id = 'YOUR_SMS_API_ID'; // Получите на sms.ru
    $phone = '380996239637'; // Ваш номер
    
    $text = "StormHosting: Клиент запрашивает оператора! " . substr($message, 0, 100);
    
    $url = "https://sms.ru/sms/send?api_id=$api_id&to=$phone&msg=" . urlencode($text);
    
    file_get_contents($url);
}

?>