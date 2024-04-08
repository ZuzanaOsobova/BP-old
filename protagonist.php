<?php
include "header.inc.php";
//include "user_required.inc.php";
include "database_connection.inc.php";

$group_id = $_POST['group_id'];



if (!empty($_POST['form'])){
    $protagonist_name = (htmlspecialchars(trim($_POST['protagonist_name'])));


    $protagonist_class = $_POST['protagonist_class'];


    $protagonist_background = (htmlspecialchars(trim($_POST['protagonist_background'])));
    $protagonist_info = (htmlspecialchars(trim($_POST['protagonist_info'])));
    $protagonist_description = (htmlspecialchars(trim($_POST['protagonist_description'])));
    $protagonist_dilemma = (htmlspecialchars(trim($_POST['protagonist_dilemma'])));
    $protagonist_memento = (htmlspecialchars(trim($_POST['protagonist_memento'])));
    $protagonist_flaw = (htmlspecialchars(trim($_POST['protagonist_flaw'])));

    $protagonist_standing = "0";
    $protagonist_status = "Healthy";

    $group_id = $_POST['group_id'];

    //TODO
    // SOmething is wrong, I don't know what, I want to die

    $stmt = $db->prepare("INSERT INTO protagonists (protagonist_name, archetype_id,  
                          protagonist_background, protagonist_info, protagonist_description, 
                          protagonist_dilemma, protagonist_mementos, protagonist_flaw, 
                          protagonist_standing, protagonist_status, group_id) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$protagonist_name, $protagonist_class,
        $protagonist_background, $protagonist_info, $protagonist_description,
        $protagonist_dilemma, $protagonist_memento, $protagonist_flaw,
        $protagonist_standing, $protagonist_status, $group_id]);


    //TODO
    //potřeba napsat foreach kód pro vložení tratů do rel_table, něco je na chatuGPT
    //Co kdybych to udělala tak, že udělám foreach proces a v každé iteraci bych rovnou vložila nový SQL???

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="protagonist_stylesheet.css">
    <script src="protagonist_javascript.js"></script>
    <title>Protagonist Creation</title>

</head>

<body>
<main>

    <div class="column">
        <h2>Protagonist creation</h2>
        <form method="post" id="form" name="form" value="form">
            <input type="hidden" name="group_id" id="group_id" value="<?php echo $group_id ?>">

            <label for="protagonist_name"><b>Protagonist's name:</b></label><br>
            <?php if (!empty($errors['protagonist_name'])): ?>
                <div style="color: red" class="invalid-feedback"><?php echo $errors['protagonist_name']; ?></div>
            <?php endif; ?>
            <input type="text" id="protagonist_name" name="protagonist_name" value="" required><br>

            <label for="protagonist_class"><b>Choose a class:</b><br>Choose wisely, because your traits will change based on your class.</label><br> <!-- přidat základní hodnotu aristocrat a přidat php pro classy -->

            <?php
            $query = $db ->prepare("SELECT * FROM archetypes");
            $query->execute();
            $archetypes = $query ->fetchAll(PDO::FETCH_ASSOC);

            ?>

            <select name="protagonist_class" id="protagonist_class">
                <?php foreach ($archetypes as $archetype):
                    $archetype_readies = $archetype['archetype_readies'];
                    $archetype_id = $archetype['archetype_id'];

                    $archetype_info = [$archetype_id, $archetype_readies];



                    ?>
                <option value="<?php echo $archetype_id ;?>">
                    <?php echo $archetype['archetype_name']?>
                </option>

                <?php endforeach; ?>
            </select>

            <p id="archetype_text"></p>

            <!-- JS script pro ukazování textu k vybrané classe -->
            <script>
                var selectElement = document.getElementById("protagonist_class");
                var archetypeTextElement = document.getElementById("archetype_text");

                selectElement.addEventListener("change", function() {
                    var selectedOption = selectElement.value;
                    var selectedArchetype = <?php echo json_encode($archetypes); ?>.find(function(archetype) {
                        return archetype.archetype_id == selectedOption;
                    });

                    if (selectedArchetype) {
                        archetypeTextElement.textContent = selectedArchetype.archetype_text;
                    } else {
                        archetypeTextElement.textContent = "";
                    }
                });
            </script>

    </div>

    <div class="column">
        <!-- přidat trait maker, responsive pomocí javascriptu -->
        <p><b>Your Traits</b></p>
        <p>Assing 5 points to traits of your choice.</p>
        <?php
        $query = $db ->prepare("SELECT * FROM traits");
        $query->execute();
        $traits = $query ->fetchAll(PDO::FETCH_ASSOC);

        foreach ($traits as $trait){
            $trait_id = $trait['trait_id'];
            $trait_name = $trait['trait_name'];
            $trait_text = $trait['trait_text'];
            $trait_number = "";

            echo"
            <label for='trait_$trait_id'><b>$trait_name</b></label>
            <input type='number' name='trait_$trait_id' id='trait_$trait_id' min='1' max='5' value='1'><br>
            <p id='trait_description'>$trait_text</p>
            
            ";


        }

        ?>



        <label for="protagonist_background"><b>What is your background?</b><br>While your selected class will describe who your character is, your background will describe your upbringing and what events led you to where you are today.</label><br>
        <textarea name="protagonist_background" id="protagonist_background"></textarea><br>

        <label for="protagonist_info"><b>Tell us more about yourself:</b></label><br>
        <textarea name="protagonist_info" id="protagonist_info">
Age:
Profession:
Title:
Nickname:
Relationship: (single/married/it's complicated and who is it)
        </textarea>

    </div>

    <div class="column">

        <label for="protagonist_description"><b>How do you look?</b><br>Write out any distinct features for your Protagonist here.</label><br>
        <input type="text" name="protagonist_description" id="protagonist_description"><br>

        <label for="protagonist_dilemma"><b>What is your dilema?</b><br>The dilema is na all-consumming burden that is a current fixture in your Protagonist's life, and at some point, sooner rather than later, they will have to adress it.</label><br>
        <input type="text" name="protagonist_dilemma" id="protagonist_dilemma"><br>

        <label for="protagonist_memento"><b>What is your first memento?</b><br>This can be anything from a packet of cigarettes, a guitar, a family signet ring, or anything your Protagonist holds dear</label><br>
        <input type="text" name="protagonist_memento" id="protagonist_memento"><br>

        <!-- udělat custom css pro select options https://www.w3schools.com/howto/howto_custom_select.asp-->
        <label for="protagonist_flaw"><b>Choose a flaw:</b><br>Assign your Protagonist a main FLAW or vice. No colourful character is complete without a few quirks! Use your flaw as a reminder on how to portray your Protagonist.</label><br>
        <input type="text" name="protagonist_flaw" id="protagonist_flaw"><br>



        <input type="submit" id="submit" name="submit" value="Create Protagonist">
        </form>
    </div>

</main>
</body>

</html>
