<?php

/* TODO LIST
- výpis všech skupin
- nastavení pro admina
- logout tlačítko
-
 *  */

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

</head>

<body>
<header>

    <a href="settings.php">Settings</a>
    <a href="#">Group 1</a>
    <a href="#">Group 2</a>
    <a href="#">Group 3</a>
    <a href="#">Group 1</a>
    <a href="#">Group 2</a>
    <a href="#">Group 3</a>
    <a href="#">Group 1</a>
    <a href="#">Group 2</a>
    <a href="#">Group 3</a>
    <a href="logout.php" id="logout">Log Out</a>

</header>
</body>
</html>
