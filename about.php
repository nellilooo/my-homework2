<?php
session_start();

if (!isset($_SESSION['username'])) {
    http_response_code(403); // 403 - доступ запрещен
    echo "Доступ запрещен. Пожалуйста, авторизуйтесь.";
    exit();
}

$username = $_SESSION['username'];
$metaData = json_encode($_SERVER);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Unbounded' rel='stylesheet'>
    <link rel="stylesheet" href="css/styleA.css">
    <title>About</title>
</head>
<body>
    <h1 class="gradient-text">Добро пожаловать, <?= htmlspecialchars($username) ?></h1>
        <script src="index.js"></script>
        <span id="doc_time" class="gradient-text">Дата и время</span>
            <script type="text/javascript">
                clock();
            </script>
    <h2 class="gradient-text">Информация о сервере:</h2><br>
    <ul class="gradient-text">
        <?php print_r($metaData); ?>
    </ul>
    <button class="button" onclick="document.location='accounts.php'">Список аккаунтов</button>
</body>
</html>