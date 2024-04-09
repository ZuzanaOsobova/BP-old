<?php

include "user_required.inc.php";
include "database_connection.inc.php";



$user_id = @$_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title> <!-- zde přidělat current page name php -->

    <style>

        header {
            height: 10%;
            width: 96%;
            position: fixed;
            left: 2%;
            top: 2%;
            background-color: #ffe8c9;
            alignment: center;

            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            align-items: center;


        }

        a {
            text-decoration: none;
            color: black;

            background-color: #ffe8c9;
            display: flex;
            text-align: center;
            box-sizing: border-box;
            text-align: center;
            padding: 1%;

            flex-shrink: 0;

            font-size: 20px;
            font-weight: bold;
        }

        a:hover {
            background-color: #c8443c;
            color: #ffe8c9;

        }

        #logout {
            position: fixed;
            right: 2%;
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
<header>
    <a href="index.php">Home</a>
    <?php

    if ($user_id == 1){
        echo "<a href='settings.php'>Settings</a>";
    }


    $query = $db ->prepare("SELECT groups.group_id, groups.group_name 
FROM groups 
    JOIN rel_user_group ON rel_user_group.group_id = groups.group_id 
WHERE rel_user_group.user_id = ?");
    $query->execute([$user_id]);
    $groups = $query ->fetchAll(PDO::FETCH_ASSOC);


    if(!empty($groups)){
        foreach ($groups as $group){
            $group_name = $group['group_name'];
            $group_id = $group['group_id'];

            echo "<a href='group.php?group_id=$group_id'> $group_name</a>";
        }
    }

    ?>


    <a href="logout.php" id="logout">Log Out</a>

</header>
</body>
</html>
