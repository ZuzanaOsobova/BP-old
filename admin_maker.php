<?php

require "database_connection.inc.php";


$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $db->prepare("INSERT INTO users(user_name, user_password) VALUES (?, ?)");
$stmt->execute([$name, $passwordHash]);
?>