<?php
include "header.inc.php";
include "user_required.inc.php";
include "database_connection.inc.php";


$group_id = intval($_GET["group_id"]);


@$current_category = $_GET['category'];
@$current_protagonist = $_GET['protagonist'];

$group_name = "";
$group_info = "";
$group_description = "";
$group_trouble = "";
$group_renown = "";
$group_readies = "";
$group_trophies = "";
$group_den = "";
$group_updates = "";

//Získáme vše k aktivní skupině
$stmt = $db->prepare("SELECT * FROM groups WHERE group_id = ? LIMIT 1");
$stmt->execute([$group_id]);
$group = $stmt ->fetch(PDO::FETCH_ASSOC);

if (!empty($group)){

    $group_name = $group['group_name'];
    $group_info = $group['group_info'];
    $group_description = $group['group_description'];
    $group_trouble = $group['group_trouble'];
    $group_renown = $group['group_renown'];
    $group_readies = $group['group_readies'];
    $group_trophies = $group['group_trophies'];
    $group_den = $group['group_den'];
    $group_updates = $group['group_updates'];

} else {
    header("Location: index.html");
}

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

    if ($form_type == "edit_protagonist"){

        $protagonist_id = intval($_POST['protagonist_id']);

        $protagonist_name = htmlspecialchars($_POST['protagonist_name']);
        $protagonist_info = htmlspecialchars($_POST['protagonist_info']);
        $protagonist_description = htmlspecialchars($_POST['protagonist_description']);
        $protagonist_mementos = htmlspecialchars($_POST['protagonist_mementos']);
        $protagonist_flaw = htmlspecialchars($_POST['protagonist_flaw']);
        $protagonist_dilemma = htmlspecialchars($_POST['protagonist_dilemma']);
        $protagonist_background = htmlspecialchars($_POST['protagonist_background']);
        $protagonist_readies = intval($_POST['protagonist_readies']);
        $protagonist_standing = intval($_POST['protagonist_standing']);
        $protagonist_status = htmlspecialchars($_POST['protagonist_status']);

        $stmt = $db->prepare("UPDATE `protagonists` SET 
                          `protagonist_name`= ?,`protagonist_info`= ?,`protagonist_description`= ?,
                          `protagonist_mementos`= ?,`protagonist_flaw`= ?,`protagonist_dilemma`= ?,
                          `protagonist_background`= ?,`protagonist_readies`= ?,`protagonist_standing`= ?,`protagonist_status`= ?
                           WHERE protagonist_id = ?");
        $stmt->execute([$protagonist_name, $protagonist_info, $protagonist_description,
            $protagonist_mementos, $protagonist_flaw, $protagonist_dilemma,
            $protagonist_background,  $protagonist_readies, $protagonist_standing, $protagonist_status,
            $protagonist_id]);


        $protagonist_trait_ids = $_POST['trait_ids'];

        foreach ($protagonist_trait_ids as $protagonist_trait_id){
            $protagonist_trait_level = intval($_POST['trait_'.$protagonist_trait_id]);


            $stmt = $db -> prepare("UPDATE rel_protagonist_trait SET protagonist_trait_level = ? WHERE protagonist_trait_id = ?");
            $stmt->execute([$protagonist_trait_level, $protagonist_trait_id]);
        }


        $cues_ids = $_POST['cue_ids'];
        $protagonist_cue_ids = $_POST['protagonist_cue_ids'];

        foreach ($cues_ids as $key =>$cue_id){
            $cue_number = intval($_POST['cue_'.$cue_id]);
            $protagonist_cue_id = $protagonist_cue_ids[$key];


            if (empty($protagonist_cue_id)){

                $stmt = $db->prepare("INSERT INTO rel_protagonist_cue (protagonist_id, cue_id, protagonist_cue_number)
                                            VALUES (?, ?, ?)");
                $stmt->execute([$protagonist_id, $cue_id, $cue_number]);

            } else {

                $stmt = $db->prepare("UPDATE rel_protagonist_cue SET protagonist_cue_number = ? WHERE protagonist_cue_id = ?");
                $stmt->execute([$cue_number, $protagonist_cue_id]);
            }


        }



        header("Location:group.php?group_id=$group_id&protagonist=$protagonist_id&category=$current_category");

    }


    if ($form_type == "edit_group"){

        $group_id = intval($_POST['group_id']);

        $group_name = htmlspecialchars($_POST['group_name']);
        $group_info = htmlspecialchars($_POST['group_info']);
        $group_description = htmlspecialchars($_POST['group_description']);
        $group_trouble = htmlspecialchars($_POST['group_trouble']);
        $group_den = htmlspecialchars($_POST['group_den']);
        $group_trophies = intval($_POST['group_trophies']);
        $group_readies = intval($_POST['group_readies']);
        $group_renown = intval($_POST['group_renown']);

        $stmt = $db->prepare("UPDATE groups SET 
                 group_name = ?, group_info = ?, group_description = ?, 
group_trouble = ?, group_den = ?, group_trophies = ?,
group_readies = ?, group_renown = ?
WHERE group_id = ?");
        $stmt->execute([$group_name, $group_info, $group_description,
            $group_trouble, $group_den, $group_trophies,
            $group_readies, $group_renown,
            $group_id]);




        //Editujeme nové upgrades pokud jsou
        if ($group_updates == 1){

            $upgrades_ids = $_POST['upgrade_ids'];

            foreach ($upgrades_ids as $upgrades_id){

                $upgrade_id = intval($upgrades_id);

                echo "<script>console.log($upgrade_id)</script>";

                $stmt = $db -> prepare("INSERT INTO rel_group_upgrade(group_id, upgrade_id) VALUES (?,?)");
                $stmt->execute([$group_id, $upgrade_id]);


            }

        }



        echo"<script>console.log('Yippe')</script>";
        header("Location:group.php?group_id=$group_id&protagonist=$protagonist_id&category=$current_category");




    }
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="group_stylesheet.css">
    <script src="group_javascript.js"></script>

    <title><?php echo $group_name;?></title>

</head>

<body>

<main>

    <div class="column_chat">
        <div class="social_club">
            <h2><?php echo $group_name;?></h2>
            <div class="social_club_content">
                <div id="group_info" >
                    <input type='button' id='group_edit_button' value='Edit Group'>
                    <p><b>Info:</b><?php echo $group_info ?></p>
                    <p><b>Description:</b><?php echo $group_description ?></p>
                    <p><b>Trouble:</b><?php echo $group_trouble ?></p>
                    <p><b>Den:</b><?php echo $group_den ?></p>
                    <p><b>Trophies:</b><?php echo $group_trophies ?></p>
                    <p><b>Renown:</b><?php echo $group_renown ?></p>
                    <p><b>Readies:</b><?php echo $group_readies ?></p>


                    <div id="upgrades">
                    <?php
                    if ($group_updates == 1){

                        //Nevlastněné upgrades
                        $stmt = $db->prepare("SELECT *
                                                    FROM upgrades
                                                    LEFT JOIN rel_group_upgrade ON upgrades.upgrades_id = rel_group_upgrade.upgrade_id 
                                                    AND rel_group_upgrade.group_id = ?
                                                    WHERE rel_group_upgrade.upgrade_id IS NULL;");
                        $stmt->execute([$group_id]);
                        $upgrades = $stmt->fetchAll();

                        foreach ($upgrades as $upgrade){
                            $upgrade_id = $upgrade['upgrades_id'];
                            $upgrade_name = $upgrade['upgrades_name'];
                            $upgrade_text = $upgrade['upgrades_text'];
                            $upgrade_requirements = $upgrade['upgrades_requirements'];

                            echo "
                            <p><b>$upgrade_name:</b><br> $upgrade_text<br>$upgrade_requirements</p>
                            ";
                        }


                        //vlastněné upgrades
                        $stmt = $db->prepare("SELECT group_upgrade_id, rel_group_upgrade.upgrade_id, upgrades.upgrades_name, upgrades.upgrades_text 
                                                    FROM rel_group_upgrade 
                                                    LEFT JOIN upgrades 
                                                    ON rel_group_upgrade.upgrade_id = upgrades.upgrades_id
                                                    WHERE group_id = ?");
                        $stmt->execute([$group_id]);
                        $owned_upgrades =$stmt->fetchAll();

                        if (!empty($owned_upgrades)){
                            echo "<div> <b>OWNED UPGRADES</b><br>";
                            foreach ($owned_upgrades as $owned_upgrade){
                                $owned_id = $owned_upgrade['group_upgrade_id'];
                                $owned_name = $owned_upgrade['upgrades_name'];
                                $owned_text = $owned_upgrade['upgrades_text'];

                                echo "
                            <p>$owned_name<br>$owned_text</p>
                            ";
                            }
                            echo "</div>";
                        }





                    }
                    ?>
                    </div>

                    <!-- PHP a SQL pro existující updates -->

                </div>

                <div id="group_edit" style="display: none">
                    <form method="post">
                        <input type='hidden' name='group_id' value='<?php echo $group_id?>'>
                        <input type='hidden' name='form_type' value='edit_group'>

                        <label for='group_name'><b>Name:</b></label>
                        <textarea  id='group_name' name='group_name'><?php echo $group_name ?></textarea><br>

                        <label for='group_info'><b>Info:</b></label><br>
                        <textarea id='group_info' name='group_info'><?php echo $group_info ?></textarea><br>

                        <label for='group_description'><b>Description:</b></label>
                        <textarea id='group_description' name='group_description'><?php echo $group_description ?></textarea><br>

                        <label for='group_trouble'><b>Trouble:</b></label>
                        <textarea id='group_trouble' name='group_trouble'><?php echo $group_trouble ?></textarea><br>

                        <label for='group_den'><b>The DEN:</b></label>
                        <textarea id='group_den' name='group_den' ><?php echo $group_den ?></textarea><br>

                        <label for='group_trophies'><b>The Trophies:</b></label>
                        <input type="number" id='group_trophies' name='group_trophies' value="<?php echo $group_trophies ?>"><br>

                        <label for='group_readies'><b>Readies:</b></label>
                        <input type="number" id="group_readies" name="group_readies" value="<?php echo $group_readies ?>"><br>

                        <label for='group_renown'><b>Renown:</b></label>
                        <input type="number" id="group_renown" name="group_renown" value="<?php echo $group_renown ?>" min="0" max="15"><br>


                        <!-- dodělat if statement spolu s upgrades -->
                        <?php
                        if ($group_updates == 1){

                            //Nevlastněné upgrades
                            $stmt = $db->prepare("SELECT *
                                                    FROM upgrades
                                                    LEFT JOIN rel_group_upgrade ON upgrades.upgrades_id = rel_group_upgrade.upgrade_id 
                                                    AND rel_group_upgrade.group_id = ?
                                                    WHERE rel_group_upgrade.upgrade_id IS NULL;");
                            $stmt->execute([$group_id]);
                            $upgrades = $stmt->fetchAll();

                            foreach ($upgrades as $upgrade){
                                $upgrade_id = $upgrade['upgrades_id'];
                                $upgrade_name = $upgrade['upgrades_name'];

                                echo "                              
                                <input type='checkbox' name='upgrade_ids[]' id='upgrade_$upgrade_id' value='$upgrade_id'>
                                <label for='upgrade_$upgrade_id'>$upgrade_name</label>
                                
                                <br>
                            ";

                                //
                            }
                        }

                        ?>



                        <input type='submit' value='Save'>
                        <button type='button' id='group_cancel_button'>Cancel</button>
                    </form>

                </div>
            </div>

        </div>


    </div>

    <!-- druhý column, zde jsou postavy -->
    <div class="column">
        <div class="dropdown">
            <h2 class="dropdown-hover">
                <!-- phpko pro vypsání jména postavy, jako názvu, nebo jen Protagonists, pokud žádný není zvolený -->
            <?php
            @$protagonist_id = $_GET['protagonist'];

            //Výpis názvu protagonisty
            if (!empty($protagonist_id)){
                $stmt = $db->prepare("SELECT protagonist_name FROM protagonists WHERE protagonist_id = ? LIMIT 1 ");
                $stmt->execute([$protagonist_id]);

                $protagonist_names = $stmt ->fetch(PDO::FETCH_ASSOC);

                if (!empty($protagonist_names)){
                    $protagonist_name = $protagonist_names['protagonist_name'];
                    echo "<script>console.log($protagonist_name)</script>";
                    echo $protagonist_name;

                }

            } else {
                echo "Protagonists";
            }
            ?>
                <!-- forma, která nás pošle na tvorbu protagonisty spolu s potřebnými údaji -->
                <form action="protagonist.php">
                    <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                    <input type="submit" value="New Protagonist">
                </form>
            </h2>

            <!-- výčet všech postav, které se ve skupině nacházejí -->
            <div class="dropdown-content">
                <?php
                $query = $db ->prepare("SELECT protagonist_name, protagonist_id FROM protagonists WHERE group_id = ?");
                $query->execute([$group_id]);
                $protagonists = $query ->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($protagonists)){
                    foreach ($protagonists as $protagonist){
                        $protagonist_name = $protagonist['protagonist_name'];
                        $protagonist_id = $protagonist['protagonist_id'];
                        echo"<a href='group.php?group_id=$group_id&protagonist=$protagonist_id&category=$current_category'>$protagonist_name</a>";
                    }
                }
                ?>

            </div>
        </div>


        <div class="notes">

            <?php
            echo "<script>console.log($current_protagonist)</script>";

            $query = $db ->prepare("SELECT * FROM protagonists WHERE protagonist_id = ?");
            $query->execute([$current_protagonist]);
            $protagonist = $query ->fetch(PDO::FETCH_ASSOC);

            if (!empty($protagonist)){
                $protagonist_name = $protagonist['protagonist_name'];
                $protagonist_info = $protagonist['protagonist_info'];
                $protagonist_description = $protagonist['protagonist_description'];
                $protagonist_mementos = $protagonist['protagonist_mementos'];
                $protagonist_flaw = $protagonist['protagonist_flaw'];
                $protagonist_dilemma = $protagonist['protagonist_dilemma'];
                $protagonist_background = $protagonist['protagonist_background'];
                $protagonist_readies = $protagonist['protagonist_readies'];
                $protagonist_standing = $protagonist['protagonist_standing'];
                $protagonist_status = $protagonist['protagonist_status'];

                $archetype_id = $protagonist['archetype_id'];

                $query = $db ->prepare("SELECT archetype_name FROM archetypes WHERE archetype_id = ?");
                $query->execute([$archetype_id]);
                $archetype_names = $query ->fetch(PDO::FETCH_ASSOC);

                if (!empty($archetype_names)){
                    $archetype_name = $archetype_names['archetype_name'];
                }

                $query = $db ->prepare("SELECT 
                                                protagonist_trait_id, rel_protagonist_trait.trait_id, protagonist_trait_level, traits.trait_name 
                                                FROM rel_protagonist_trait 
                                                JOIN traits ON rel_protagonist_trait.trait_id = traits.trait_id 
                                                WHERE rel_protagonist_trait.protagonist_id = ?");
                $query->execute([$current_protagonist]);
                $traits = $query->fetchAll(PDO::FETCH_ASSOC);


                $stmt = $db->prepare("SELECT cues.cue_id, cues.cue_name, cues.cue_text, cues.archetype_id, rel_protagonist_cue.protagonist_cue_number, rel_protagonist_cue.protagonist_cue_id
                                            FROM cues
                                            LEFT JOIN rel_protagonist_cue ON rel_protagonist_cue.cue_id = cues.cue_id 
                                            AND rel_protagonist_cue.protagonist_id = ?
                                            WHERE cues.archetype_id = ?");
                $stmt->execute([$current_protagonist,$archetype_id]);
                $cues = $stmt->fetchAll(PDO::FETCH_ASSOC);



                //NORMÁLNÍ TEXT

                echo "
                <div id='character_info'>
                <input type='button' id='protagonist_edit_button' value='Edit Protagonist'>";

                foreach ($traits as $trait){
                    $protagonist_trait_id = $trait['protagonist_trait_id'];
                    $trait_id = $trait['trait_id'];
                    $protagonist_trait_level = $trait['protagonist_trait_level'];
                    $trait_name = $trait['trait_name'];

                    echo "
                    <p><b>$trait_name:</b> $protagonist_trait_level</p><br>
                    
                    ";

                }

                echo"
                <p><b>Archetype:</b> $archetype_name</p><br>
                <p><b>Protagonist info:</b><br> $protagonist_info</p><br>
                <p><b>Background info:</b><br> $protagonist_background</p><br>
                <p><b>Protagonist Description:</b><br> $protagonist_description</p><br>
                <p><b>Protagonist's readies:</b> $protagonist_readies</p><br>
                <p><b>Protagonist's memento:</b> $protagonist_mementos</p><br>
                <p><b>Protagonist's flaw:</b> $protagonist_flaw</p><br>
                <p><b>Protagonist's dilemma:</b> $protagonist_dilemma</p><br>
                <p><b>Protagonist's status:</b> $protagonist_status</p><br>
                <p><b>Protagonist's standing:</b> $protagonist_standing</p><br>
                ";



                foreach ($cues as $cue){
                    $cue_id = $cue['cue_id'];
                    $cue_name = $cue['cue_name'];
                    $cue_text = $cue['cue_text'];
                    $cue_number = $cue['protagonist_cue_number'];

                    if (empty($cue_number)){
                        $cue_number = 0;
                    }

                    echo "
                    <p><b>$cue_name</b><br>Number of use: $cue_number<br> $cue_text</p>
                    ";
                }

                echo "
            </div>
                ";


            //EDIT TEXT
                echo "
                <div id='character_edit' style='display: none'>
                <form method='post' >
                    <input type='hidden' name='protagonist_id' value='$protagonist_id'>
                    <input type='hidden' name='form_type' value='edit_protagonist'>
                    
                    <label for='protagonist_name'><b>Name:</b></label>
                    <input type='text' id='protagonist_name' name='protagonist_name' value='$protagonist_name'><br>
                    ";

                foreach ($traits as $trait){
                    $protagonist_trait_id = $trait['protagonist_trait_id'];
                    $trait_id = $trait['trait_id'];
                    $protagonist_trait_level = $trait['protagonist_trait_level'];
                    $trait_name = $trait['trait_name'];

                    //TODO
                    // předělat max value dle toho, zda skupina používá updates a zda má jeden update

                    echo "
                    <label for='trait_$protagonist_trait_id'><b>$trait_name</b></label>
                    <input type='number' name='trait_$protagonist_trait_id' id='trait_$protagonist_trait_id' min='1' max='8' value='$protagonist_trait_level'><br>
                    <input type='hidden' name='trait_ids[]' value='$protagonist_trait_id'>
                                    
                ";

                }

                echo "<h3>Protagonist Cues</h3>";

                foreach ($cues as $cue){
                    $cue_id = $cue['cue_id'];
                    $cue_name = $cue['cue_name'];
                    $cue_text = $cue['cue_text'];
                    $cue_number = $cue['protagonist_cue_number'];
                    $protagonist_cue_id = $cue['protagonist_cue_id'];

                    if (empty($cue_number)){
                        $cue_number = 0;
                    }

                    echo "
                    <label for='cue_$cue_id'><b>$cue_name</b></label>
                    <input type='number' name='cue_$cue_id' id='cue_$cue_id' min='0' max='3' value='$cue_number'><br>
                    <input type='hidden' name='cue_ids[]' value='$cue_id'>
                    <input type='hidden' name='protagonist_cue_ids[]' value='$protagonist_cue_id'>
                    ";
                }




                    echo "
                    <label for='protagonist_info'><b>Info:</b></label><br>
                    <textarea name='protagonist_info' id='protagonist_info'>$protagonist_info</textarea><br>
                    
                    <label for='protagonist_background'><b>Background:</b></label><br>
                    <textarea name='protagonist_background' id='protagonist_background'>$protagonist_background</textarea><br>
                    
                    <label for='protagonist_description'><b>Description:</b></label><br>
                    <textarea name='protagonist_description' id='protagonist_description'>$protagonist_description</textarea><br>
                    
                    <label for='protagonist_readies'><b>Number of readies:</b></label>
                    <input type='number' name='protagonist_readies' id='protagonist_readies' value='$protagonist_readies'><br>
                    
                    <label for='protagonist_mementos'><b>Mementos:</b></label>
                    <input type='text' id='protagonist_mementos' name='protagonist_mementos' value='$protagonist_mementos'><br>
                    
                    <label for='protagonist_flaw'><b>Flaw:</b></label>
                    <input type='text' id='protagonist_flaw' name='protagonist_flaw' value='$protagonist_flaw'><br>
                    
                    <label for='protagonist_dilemma'><b>Dilemma:</b></label>
                    <input type='text' id='protagonist_dilemma' name='protagonist_dilemma' value='$protagonist_dilemma'><br>
                    
                    <label for='protagonist_status'><b>Status:</b></label>
                    <input type='text' id='protagonist_status' name='protagonist_status' value='$protagonist_status'><br>
                    
                    <label for='protagonist_standing'><b>Standing:</b></label>
                    <input type='number' id='protagonist_standing' name='protagonist_standing' min='-10' max='10' value='$protagonist_standing'><br>
                    
                    <!--Potřeba přidat další php SQL na traity a pro cues -->
                    
                    <input type='submit' value='Save'>
                    <button type='button' id='character_cancel_button'>Cancel</button>                    
                    
                    </form>
                </div>
                ";



            }


            ?>



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

                        //tvorba nové poznámky, jen se vytvoří, jméno se ještě nedává
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
                        echo"<a href='group.php?group_id=$group_id&category=$category_id&protagonist=$current_protagonist'>$category_name</a>";
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
