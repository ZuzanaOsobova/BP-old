<?php
include "header.inc.php";
include "user_required.inc.php";
include "database_connection.inc.php";

$user_id = @$_SESSION['user_id'];

//Is User admin
if ($user_id != 1){
    header('Location: index.php');
}

//Making new user
if (!empty($_POST)){


    if (isset($_POST['user_name'])){

        $user_name = htmlspecialchars(trim($_POST['user_name']));
        $password = htmlspecialchars($_POST['password']);

        //checking user name
        $stmt = $db->prepare("SELECT * FROM users WHERE user_name = ? ");
        $stmt->execute([$user_name]);

        if ($stmt ->rowCount() >0){
            $errors ['username']="User with such name already exists.";

        }


        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if (empty($errors)){
            //inserting new user into database
            $stmt = $db->prepare("INSERT INTO users(user_name, user_password) VALUES (?, ?)");
            $stmt->execute([$user_name, $passwordHash]);
            header('Location:settings.php');
        }
    }




    if (isset($_POST['group_name'])){
        $group_name = htmlspecialchars(trim($_POST['group_name']));
        $group_upgrades = $_POST['group_upgrade'];

        //checking group name
        $stmt = $db->prepare("SELECT * FROM groups WHERE group_name = ? ");
        $stmt->execute([$group_name]);

        if ($stmt ->rowCount() >0){
            $errors ['group_name']="Group with such name already exists.";

        }

        if (empty($errors)){
            //tvorba nové skupin, edit skupiny nesmí mít renown a readies
            $group_renown = 0;
            $group_readies = 0;

            //inserting new group into database
            $stmt = $db->prepare("INSERT INTO groups(group_name, group_updates) VALUES (?, ?)");
            $stmt->execute([$group_name, $group_upgrades]);

            //Getting groups new id
            //$group_id = $db->lastInsertId();
            $stmt = $db->prepare("SELECT group_id FROM groups WHERE group_name = ?");
            $stmt->execute([$group_name]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row){
                $group_id = $row['group_id'];

                //creating admin group connection
                $stmt = $db->prepare("INSERT INTO rel_user_group (group_id, user_id) VALUES (?, ?)");
                $stmt->execute([$group_id, $user_id]);

                header('Location:settings.php');
            } else {
                $errors['group_id'] = "En error occurred while creating the Group.";
            }
        }
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

    <!-- Users and user part -->
    <div class="window">
        <h2>Users</h2>

        <div class="columns">

            <div class="column2">
                <h3>Add new user</h3>
                <form method="post">
                    <label for="user_name">Name:</label><br>
                    <?php if (!empty($errors['username'])): ?>
                        <div style="color: red" class="invalid-feedback"><?php echo $errors['username']; ?></div>
                    <?php endif; ?>
                    <input type="text" id="user_name" name="user_name" value="" required><br>

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

    <!-- Groups and Group part -->
    <div class="window">
        <h2>Groups</h2>
        <div class="columns">

            <div class="column2">
                <h3>Add new group</h3>

                <form method="post">
                    <label for="group_name">Group Name:</label><br>
                    <?php if (!empty($errors['group_name'])): ?>
                        <div style="color: red" class="invalid-feedback"><?php echo $errors['group_name']; ?></div>
                    <?php endif; ?>
                    <input type="text" id="group_name" name="group_name" value="" required><br>

                    <p>Include group updates?</p>
                        <input type="radio" id="group_upgrades_yes" name="group_upgrade" value="1">
                        <label for="group_upgrade">YES</label><br>

                        <input type="radio" id="group_upgrades_no" name="group_upgrade" value="0">
                        <label for="group_upgrade">NO</label><br>

                    <input type="submit" id="submit" value="Create new group">

                </form>

            </div>

            <div class="column2">
                <h3>Groups</h3>
                <?php
                $query = $db ->prepare("SELECT group_name FROM groups");
                $query->execute();
                $groups = $query ->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($groups)){
                    foreach ($groups as $group){
                        $group_name = $group['group_name'];
                        echo"<li>$group_name<br>";
                    }
                }
                ?>
            </div>

        </div>
    </div>

</main>
</body>

</html>