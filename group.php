<?php
include "header.inc.php";
include "user_required.inc.php";
include "database_connection.inc.php";

$current_page = "group_name"; /* připsat PHP, které bude měnit jméno */

$group_id = $_GET["group_id"];

$message = "PHP works";
echo "<script>console.log('$message'); console.log('$group_id')</script>";


if (!empty($_POST['form_type'])){

    $form_type = $_POST['form_type'];

    $message = "form_type seen";
    echo "<script>console.log('$message');</script>";


    if ($form_type == "new_category"){

        $newCategoryName = htmlspecialchars(trim($_POST["category"]));
        $group_id = $_POST['group_id'];

        $message = "new_category seen";
        echo "<script>console.log('$message');</script>";

        $stmt = $db->prepare("SELECT * FROM categories WHERE categories.group_id = ? AND category_name = ? ");
        $stmt->execute([$group_id, $newCategoryName]);

        if ($stmt->rowCount() <= 0) {
            header('Location:group.php?group_id='.$group_id);
        }

        $stmt = $db->prepare("INSERT INTO categories (group_id, category_name) VALUES (?, ?)");
        $stmt->execute([$group_id, $newCategoryName]);
        header('Location:group.php?group_id='.$group_id);




    }

}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="group_stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="group_javascript.js"></script>

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
            <h2 class="dropdown-hover">
                Categories
                <button id="showFormButton" onclick="">New Category</button>
                <form id="hiddenForm" style="display: none">
                    <input type="hidden" name="form_type" value="new_category">
                    <input type="hidden" name="group_id" value="<?php echo $group_id ?>">
                    <input type="text" name="category">
                    <input type="submit" id="submit" value="submit">
                </form>
            </h2> <!--název bude vždy categories - jméno aktegorie, ve které zrovna jsme -->
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
