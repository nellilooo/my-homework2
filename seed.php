<?php
function generateUniqueUsernames($count) {
    $usernames = [];
    for ($i = 1; $i <= $count; $i++) {
        $usernames[] = "user" . $i;
    }
    return $usernames;
}

function createUsersJson($filename, $count) {
    $password = password_hash("defaultPassword", PASSWORD_DEFAULT);
    $usernames = generateUniqueUsernames($count);
    $users = [];

    foreach ($usernames as $username) {
        $users[] = ['username' => $username, 'password' => $password];
    }

    file_put_contents($filename, json_encode($users, JSON_PRETTY_PRINT));
}

createUsersJson('users.json', 10000);

