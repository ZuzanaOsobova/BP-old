<?php
include "header.inc.php";
include "user_required.inc.php";
include "database_connection.inc.php";


$group_id = $_GET["group_id"];

$current_category = $_GET['category'];

$stmt = $db->prepare("SELECT group_name FROM groups WHERE group_id = ? LIMIT 1");
$stmt->execute([$group_id]);
$group_name = $stmt ->fetchAll(PDO::FETCH_ASSOC);

$group_name = $group_name[0]['group_name'];
echo"<script>console.log('$group_name'), console.log($current_category)</script>";


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

        if (empty($errors)){
            $stmt = $db->prepare("INSERT INTO categories (group_id, category_name) VALUES (?, ?)");
            $stmt->execute([$group_id, $newCategoryName]);
            header('Location:group.php?group_id='.$group_id);
        }


    }

    if ($form_type == "new_note"){

        $category_id = $_POST['category_id'];
        $group_id = $_POST['group_id'];
        $note_name = "New Note Name";
        $note_text = "New Note Text";

        $stmt = $db->prepare("INSERT INTO notes (category_id,group_id, note_name, note_text) VALUES (?, ?, ?, ?)");
        $stmt->execute([$category_id, $group_id, $note_name, $note_text]);

    }

    if ($form_type == "edit_note"){
        $note_id = $_POST['note_id'];
        $note_name = htmlspecialchars(trim($_POST['note_name']));
        $note_text = htmlspecialchars(trim($_POST['note_text']));

        $stmt = $db->prepare("UPDATE notes SET note_name = ? , note_text = ? WHERE note_id = ?");
        $stmt->execute([$note_name, $note_text, $note_id]);

    }
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="group_stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="group_javascript.js"></script>

    <title><?php echo $group_name;?></title>

</head>

<body>

<main>

    <div class="column_chat">
        <div class="social_club">
            <h2><?php echo $group_name;?></h2>
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
                <?php

                @$category_id = $_GET['category'];

                echo "<script>console.log('$group_id, $category_id')</script>";

                if (!empty($category_id)){
                    $stmt = $db->prepare("SELECT category_name FROM categories WHERE category_id = ? LIMIT 1 ");
                    $stmt->execute([$category_id]);

                    $category_names = $stmt ->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($category_names)){
                        $category_name = $category_names[0]['category_name'];
                        echo $category_name;

                        echo '<form method="post">
                    <input type="hidden" name="form_type" value="new_note">
                    <input type="hidden" name="group_id" value='.$group_id.'>
                <input type="hidden" name="category_id" value='.$category_id.'>
                <input type="submit" id="submit" value="New Note">
                </form>';

                    }

                } else {
                    echo "Categories";
                }


                ?>
                <button id="showFormButton" onclick="">New Category</button>
                <form id="hiddenForm" method="post" style="display: none">
                    <input type="hidden" name="form_type" value="new_category">
                    <input type="hidden" name="group_id" value="<?php echo $group_id ?>">
                    <?php if (!empty($errors['category_name'])): ?>
                        <div style="color: red" class="invalid-feedback"><?php echo $errors['category_name']; ?></div>
                    <?php endif; ?>
                    <input type="text" name="category" required>
                    <input type="submit" id="submit" value="submit">
                </form>

            </h2> <!--název bude vždy categories - jméno aktegorie, ve které zrovna jsme -->
            <div class="dropdown-content">
                <?php
                $query = $db ->prepare("SELECT category_name, category_id FROM categories WHERE group_id = ?");
                $query->execute([$group_id]);
                $categories = $query ->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($categories)){
                    foreach ($categories as $category){
                        $category_name = $category['category_name'];
                        $category_id = $category['category_id'];
                        echo"<a href='group.php?group_id=$group_id&category=$category_id'>$category_name</a>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="notes">

            <?php
            echo "<script>console.log($current_category)</script>";

            $query = $db ->prepare("SELECT note_name, note_text, note_id FROM notes WHERE category_id = ?");
            $query->execute([$current_category]);
            $notes = $query ->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($notes)){
                foreach ($notes as $note){
                    $note_name = $note['note_name'];
                    $note_text = $note['note_text'];
                    $note_id = $note['note_id'];

                    echo "
                    <div id='normal_note_$note_id'>
                    <div class='note'>
                    <h3>$note_name
                    <button class='note_edit_button' onclick='' id='shown_note_edit_$note_id' data-note-id='$note_id'>Edit Note</button></h3>
                        <div class='note_content'>
                            $note_text
                        </div>
                    </div>
                    </div>
                    ";

                    echo "
                    
                    <form method='post' id='hidden_note_edit_$note_id' style='display: none' data-note-id='$note_id'>
                    <input type='hidden' name='note_id' value='$note_id'>
                    <input type='hidden' name='form_type' value='edit_note'>
                    <div class='note'>
                    <h3><textarea id='note_name' name='note_name'>$note_name</textarea></h3>
                    <div class='note_content'>
                    <textarea name='note_text' id='note_text' required>$note_text</textarea>
                    </div>
                    
                    <input type='submit' value='Save'>
                    <button type='button' class='cancel_button' data-note-id='$note_id'>Cancel</button>                    
                    </div>
                    </form>
                    ";
                }
            }

            ?>


        </div>

    </div>

</main>

</body>
</html>
