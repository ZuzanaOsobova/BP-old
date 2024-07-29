<?php

require "database_connection.inc.php";

$name = "";
$password = "";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $db->prepare("INSERT INTO users(user_name, user_password) VALUES (?, ?)");
$stmt->execute([$name, $passwordHash]);
?>
