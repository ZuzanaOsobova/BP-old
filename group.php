<?php
include "header.inc.php";

$current_page = "group_name"; /* připsat PHP, které bude měnit jméno */


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="group_stylesheet.css">
</head>

<body>

<main>

    <div class="column_chat">
        <div class="social_club">
            <h2>The Social Club</h2>
            <div class="social_club_content">
                Hello
            </div>

        </div>

        <div class="chat">

        </div>


    </div>

    <!-- druhý column, zde jsou postavy -->
    <div class="column">
        <div class="dropdown">
            <h2 class="dropdown-hover">Characters</h2>
            <div class="dropdown-content">
                <!-- zde bude PHP nebo JavaScrip, který vyčte všechny postavy-->
                <a href="#a">Link 1</a>
                <a href="#b">Link 2</a>
                <a href="#c">Link 3</a>
            </div>
        </div>
    </div>

    <!--třetí column, ve kterém jsou schované kategorie a poznámky -->
    <div class="column">

        <div class="dropdown">
            <h2 class="dropdown-hover">Categories</h2> <!--název bude vždy categories - jméno aktegorie, ve které zrovna jsme -->
            <div class="dropdown-content">
                <!-- zde bude PHP nebo JavaScrip, který vyčte všechny kategorie-->
                <a href="#a">Link 1</a>
                <a href="#b">Link 2</a>
                <a href="#c">Link 3</a>
                <a href="#a">Link 1</a>
                <a href="#b">Link 2</a>
                <a href="#c">Link 3</a>
                <a href="#a">Link 1</a>
                <a href="#b">Link 2</a>
                <a href="#c">Link 3</a>
                <a href="#a">Link 1</a>
                <a href="#b">Link 2</a>
                <a href="#c">Link 3</a>
            </div>
        </div>

        <div class="notes">
            <div class="note">
                <h3>Note název</h3>
                <div class="note_content">
                    Note content
                </div>
            </div>

        </div>
    </div>

</main>

</body>
</html>
