<?php
header('Content-Type: text/html');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['count']) && is_numeric($_GET['count'])) {
    $count = (int)$_GET['count'];
    $users = json_decode(file_get_contents('users.json'), true);
    
    if ($users === null) {
        http_response_code(500);
        echo json_encode(['error' => 'Не удалось загрузить данные пользователей']);
        exit;
    }

    $response = array_slice($users, 0, $count);
    echo json_encode($response);
    exit; 
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Unbounded' rel='stylesheet'>
    <link rel="stylesheet" href="css/styleAC.css">
    <title>Account</title>
</head>
<body>
    <h1 class="gradient-text">Список пользователей</h1>
    <form method="get" action="">
        <label for="count" class="gradient-text">Введите количество аккаунтов:</label>
        <input type="number" name="count" id="count" min="1" required>
        <button type="submit" class="button">Получить аккаунты</button>
    </form>
    <div id="userList"></div>

    <script> //js
        // Получение данных из accounts.php после отправки формы
        const form = document.querySelector('form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            const count = document.getElementById('count').value;

            
            const response = await fetch(`accounts.php?count=${count}`);
            if (!response.ok) {
                const errorData = await response.json();
                document.getElementById('userList').innerHTML = `<p>Error: ${errorData.error}</p>`;
                return;
            }
            const users = await response.json();
            // Формирование таблицы пользователей
            let tableHTML = '<table><tr><th>ID</th><th>Имя</th></tr>';
            users.forEach(user => {
                tableHTML += `<tr><td>${user.username}</td><td>${user.password}</td></tr>`;
            });
            tableHTML += '</table>';
            document.getElementById('userList').innerHTML = tableHTML;
        });
    </script>
</body>
</html>
