<?php
include "header.inc.php";
//include "user_required.inc.php";
include "database_connection.inc.php";


//TODO
/* DONE - Character name
 * DONE - character class - SQL + dropdown form
 * character trait +- a základ na základě vybraného archetypu a počítadlo, kolik jich ještě mají a musí přidat
 * --
 * character info - základ textarea s doplěním věku, profese, title, vztahu a přezdívky (poznámka, nic z toho není povinné, ale alespoň něco)
 * DONE - character fyzický popis - text area
 * DONE - character mementos
 * DONE but gotta make CSS - character flaw - text area, ale možnost dropdown si vybrat???
 * DONE - character dilema
 * DONE - character background
 * --bude nastaveno samo--
 * character readies - nastaví se na začátku automaticky podle knihy
 * character stanting - mastaví se na začátku automaticky 0
 * character status - automaticky healthy
 * group_id - přenese se z url!!!
 *
 * */

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
        <form method="post">

            <label for="protagonist_name"><b>Protagonist's name:</b></label><br>
            <?php if (!empty($errors['protagonist_name'])): ?>
                <div style="color: red" class="invalid-feedback"><?php echo $errors['protagonist_name']; ?></div>
            <?php endif; ?>
            <input type="text" id="protagonist_name" name="protagonist_name" value="" required><br>

            <label for="protagonist_class"><b>Choose a class:</b><br>Choose wisely, because your traits will change based on your class, and if you want to change them, you will have to click everything again.</label><br> <!-- přidat základní hodnotu aristocrat a přidat php pro classy -->

            <?php
            $query = $db ->prepare("SELECT * FROM archetypes");
            $query->execute();
            $archetypes = $query ->fetchAll(PDO::FETCH_ASSOC);

            ?>

            <select name="protagonist_class" id="protagonist_class">
                <?php foreach ($archetypes as $archetype):
                    $archetype_readies = $archetype['archetype_readies'];
                    ?>
                <option value="<?php echo $archetype['archetype_id'];?>">
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



            <!-- přidat trait maker, responsive pomocí javascriptu -->

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

        <label for="protagonist_description"><b>How do you look?</b><br>Write out any distinct features for your Protagonist here.</label>
        <input type="text" name="protagonist_description" id="protagonist_description"><br>

        <label for="protagonist_dilemma"><b>What is your dilema?</b><br>The dilema is na all-consumming burden that is a current fixture in your Protagonist's life, and at some point, sooner rather than later, they will have to adress it.</label><br>
        <input type="text" name="protagonist_dilemma" id="protagonist_dilemma"><br>

        <label for="protagonist_memento"><b>What is your first memento?</b><br>This can be anything from a packet of cigarettes, a guitar, a family signet ring, or anything your Protagonist holds dear</label><br>
        <input type="text" name="protagonist_memento" id="protagonist_memento"><br>

        <!-- udělat custom css pro select options https://www.w3schools.com/howto/howto_custom_select.asp-->
        <label for="protagonist_flaw"><b>Choose a flaw:</b><br>Assign your Protagonist a main FLAW or vice. No colourful character is complete without a few quirks! Use your flaw as a reminder on how to portray your Protagonist.</label><br>
        <input type="text" name="protagonist_flaw" id="protagonist_flaw"><br>



        <input type="submit" value="Create Protagonist">
        </form>
    </div>

</main>
</body>

</html>
