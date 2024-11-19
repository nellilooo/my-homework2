<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $users = json_decode(file_get_contents('users.json'), true);
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('Location: about.php');
            exit;
        }
    }
    $error = 'Неверное имя пользователя или пароль.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Unbounded' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>Welcome!</title>
</head>
    <body> 
        <section>
                <form action="index.php" method="post">
                    <h1>Login</h1>
                    <div class="inputbox">
                        <input type="text" name="username" class="input-field" required>
                        <label for="">Login</label>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="password" class="input-field" required>
                        <label for="">Password</label>
                    </div>
                        <button type="submit" name="submit" class="submit-button" onclick="document.location='about.php'">Sign up</button> 
                </form>
        </section>
    </body>
</html>



