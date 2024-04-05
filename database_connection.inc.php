<?php

$db = new PDO('mysql:host=localhost;dbname=flabbergasted;charset=utf8', 'admin', 'admin123');

//vyhazuje výjimky v případě neplatného SQL výrazu
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>