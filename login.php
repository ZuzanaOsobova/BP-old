<?php
session_start();
require "database_connection.inc.php";

//database check
$query = $db ->query('SELECT * FROM users');
$query -> execute();
$posts = $query ->fetchAll(PDO::FETCH_ASSOC);


if (!empty($_POST)){
    $name = htmlspecialchars(trim($_POST['name']));
    $password = htmlspecialchars($_POST['password']);
    $stmt = $db->prepare("SELECT * FROM users WHERE user_name = ? ");
    $stmt->execute([$name]);


    if (($existingUser=$stmt->fetch(PDO::FETCH_ASSOC)) && password_verify($password, @$existingUser['user_password'])){
        //povedlo se nám najít daného uživatele v DB a zároveň bylo zadáno platné heslo => uložíme si ID uživatele do SESSION a přesměrujeme ho na homepage
        $_SESSION['user_id'] = $existingUser['user_id'];
        header('Location: index.php');

    }else{
        //u přihlášení uživatele nezobrazujeme konkrétní chybu (je to jediná výjimka, kdy není vhodné mít u formuláře úplně konkrétní chybu)
        $formError="Invalid user or password!";
    }

    if (!empty($formError)) {
        echo '<p style="color:red;">' . $formError . '</p>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="signin_stylesheet.css">
    <title>Log In</title>
</head>
<body>

<main>

    <div class="form">
        <form method="post">

            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" value="" required><br>

            <input type="submit" id="submit" value="Log In"><br>
        </form>
    </div>

</main>

</body>
</html>
