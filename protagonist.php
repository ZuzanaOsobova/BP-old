<?php
include "header.inc.php";
//include "user_required.inc.php";
include "database_connection.inc.php";


//TODO
/* DONE - Character name
 * character class - SQL + dropdown form
 * character trait +- a základ na základě vybraného archetypu a počítadlo, kolik jich ještě mají a musí přidat
 * --
 * character info - základ textarea s doplěním věku, profese, title, vztahu a přezdívky (poznámka, nic z toho není povinné, ale alespoň něco)
 * character fyzický popis - text area
 * DONE - character mementos
 * DONE but gotta make CSS - character flaw - text area, ale možnost dropdown si vybrat???
 * DONE - character dilema
 * character background
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
    <title>Protagonist Creation</title>

</head>

<body>
<main>

    <div class="column">
        <h2>Protagonist creation</h2>
        <form method="post">

            <label for="protagonist_name">Protagonist's name:</label><br>
            <?php if (!empty($errors['protagonist_name'])): ?>
                <div style="color: red" class="invalid-feedback"><?php echo $errors['protagonist_name']; ?></div>
            <?php endif; ?>
            <input type="text" id="protagonist_name" name="protagonist_name" value="" required><br>

            <label for="protagonist_class">Choose a class:</label><br> <!-- přidat základní hodnotu aristocrat a přidat php pro classy -->
            <select>
                <option></option>
            </select>


            <!-- přidat trait maker, responsive pomocí javascriptu -->

    </div>

    <div class="column">

    </div>

    <div class="column">

        <label for="protagonist_dilemma"><b>What is your dilema?</b><br>The dilema is na all-consumming burden that is a current fixture in your Protagonist's life, and at some point, sooner rather than later, they will have to adress it.</label><br>
        <input type="text" name="protagonist_dilemma" id="protagonist_dilemma"><br>

        <label for="protagonist_memento"><b>What is your first memento?</b><br>This can be anything from a packet of cigarettes, a guitar, a family signet ring, or anything your Protagonist holds dear</label><br>
        <input type="text" name="protagonist_memento" id="protagonist_memento"><br>

        <!-- udělat custom css pro select options https://www.w3schools.com/howto/howto_custom_select.asp-->
        <label for="protagonist_flaw"><b>Choose a flaw:</b></label>
        <select name="protagonist_flaw" id="protagonist_flaw">
            <option value="Ghastly Gossip">Ghastly Gossip - You can't help yourself... There is always some juicy gossip to be shared.</option>
            <option value="Penny-Pincher">Penny Pincher - You’re frugal to a shocking degree.</option>
            <option value="Yellow-Bellied">Yellow-Bellied - Cluck, cluck, cluck. Do I hear a chicken?</option>
            <option value="Card Cheat">Card Cheat - You have a bit of a problem whenever you pick up those cards. No one likes playing with a cheater.</option>
            <option value="Persnickety">Persnickety - You always kick up a fuss. Everything must be precise. All. The. Time.</option>
            <option value="Light-Fingered">Light-Fingered - You love a good sale. And by sale, we mean a five-finger discount.</option>
            <option value="Shop-a-Holic">Shop-a-Holic - When you need to buy a dress for a gala, you buy five just in case.</option>
            <option value="High-Roller">High-Roller - You’d gamble away most if not all of the readies you receive</option>
            <option value="Hot-Headed">Hot-Headed - You’re rash and quick-tempered. Maybe you should avoid being behind the wheel.</option>
            <option value="Jealous">Jealous - You hate not being the centre of attention. You have an envious resentment towards others’ achievements and possessions.</option>
            <option value="Tippler">Tippler - Two whiskeys, please! And make them a double!</option>
            <option value="Superstitious Mind">Superstitious Mind - Some may say you’re irrational, but you’re happy as you are, throwing salt over your shoulder.</option>
            <option value="Drama Queen">Drama Queen - You react to every situation in a melodramatic way. Or maybe everyone else just underreacts.</option>
            <option value="Gullible">Gullible - You believe everything that is said to you, every piece of gossip, every tale. This, unfortunately, makes you an easy target</option>
            <option value="Party Animal">Party Animal - You have a fear of missing out and must attend every single party. Occasionally, multiple parties at once.</option>
            <option value="Snoop">Snoop - While you describe yourself as inquisitive, others simply call you a snoop. You meddle and must find out about everyone’s affairs.</option>
            <option value="Boisterous">Boisterous - You’re loud, brash, and everyone knows when you’ve entered a room. You tend to cause a ruckus wherever you go.</option>
            <option value="Show-Off">Show-Off - You have a myriad of achievements, possessions, and accomplishments. So why not show them off?</option>
            <option value="Shameless Flirt">Shameless Flirt - When you flirt with someone, they’ll know it. Flirting seems to be your default setting</option>
            <option value="Foul_Mouthed">Foul_Mouthed - !”@* $!”</option>
        </select>


        <input type="submit" value="Create Protagonist">
        </form>
    </div>

</main>
</body>

</html>
