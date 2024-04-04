<?php
include "header.inc.php";
include "user_required.inc.php";
include "database_connection.inc.php";


//Making new user
if (!empty($_POST)){
    $name = htmlspecialchars(trim($_POST['name']));
    $password = htmlspecialchars($_POST['password']);

    //checking user name
    $stmt = $db->prepare("SELECT * FROM users WHERE user_name = ? ");
    $stmt->execute([$name]);

    if ($stmt ->rowCount() >0){
        $errors ['username']="User with such name already exists.";

    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($errors)){
        //inserting new user into database
        $stmt = $db->prepare("INSERT INTO users(user_name, user_password) VALUES (?, ?)");
        $stmt->execute([$name, $passwordHash]);
    }

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="settings_stylesheet.css">
    <title>Admin Settings</title>

</head>

<body>
<main>

    <div class="window">
        <h2>Users</h2>

        <div class="columns">

            <div class="column2">
                <h3>Add new user</h3>
                <form method="post">
                    <label for="name">Name:</label><br>
                    <?php if (!empty($errors['username'])): ?>
                        <div style="color: red" class="invalid-feedback"><?php echo $errors['username']; ?></div>
                    <?php endif; ?>
                    <input type="text" id="name" name="name" value="" required><br>

                    <label for="password">Password:</label><br>
                    <input type="text" id="password" name="password" value="" required><br>

                    <input type="submit" id="submit" value="Add new user"><br>
                </form>
            </div>

            <div class="column2">
                <h3>Users</h3>
                <div class="users">
                    <?php
                    $query = $db ->prepare("SELECT user_name FROM users");
                    $query->execute();
                    $users = $query ->fetchAll(PDO::FETCH_ASSOC);
                    if(!empty($users)){
                        foreach ($users as $user){
                            $user_name = $user['user_name'];
                            echo"<li>$user_name<br>";
                        }
                    }
                    ?>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                    <li>Name1</li>
                </div>
            </div>

        </div>

    </div>

    <div class="window">
        <div class="window_text">

        </div>

    </div>

</main>
</body>

</html>