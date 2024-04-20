document.addEventListener("DOMContentLoaded", function (){


    //kód pro ukazování a schovávání group info a edit
    var group_button = document.getElementById("group_edit_button");
    var group_info = document.getElementById("group_info");
    var group_edit = document.getElementById("group_edit");

    group_button.addEventListener("click", function (){
        group_info.style.display = "none";
        group_edit.style.display = "block";
        console.log("cklick")

    })

    var group_cancel_button = document.getElementById("group_cancel_button");

    group_cancel_button.addEventListener("click", function (){
        group_info.style.display = "block";
        group_edit.style.display = "none";
        console.log("clack")
    })


    //Kód pro schovávání a ukazování tvorby nové kategorie
    document.getElementById("showFormButton").addEventListener("click", function (){

        var hiddenForm = document.getElementById("hiddenForm");

        if (hiddenForm.style.display === "none" || hiddenForm.style.display === ""){
            hiddenForm.style.display = "block";
        } else {
            hiddenForm.style.display = "none";
        }

    })



    //kód pro spuštění edit módu pro notes => schování normálního note textu
    var editButtons = document.querySelectorAll(".note_edit_button");

    editButtons.forEach(function (button){

        button.addEventListener("click", function (){

            var note_id = this.getAttribute("data-note-id");

            var hidden_form_id = "hidden_note_edit_" + note_id;
            var normal_note_id = "normal_note_" + note_id;

            var hidden_form = document.getElementById(hidden_form_id);
            hidden_form.style.display = "block";

            var shown_form = document.getElementById(normal_note_id);
            shown_form.style.display = "none";

        })


    })


    //kód pro cancel edit módu, bez uložení, a zobrazení původního note textu
    var cancelButtons = document.querySelectorAll(".cancel_button");

    cancelButtons.forEach(function (button){

        button.addEventListener("click", function (){

            var note_id = this.getAttribute("data-note-id");

            var hidden_form_id = "hidden_note_edit_" + note_id;
            var normal_note_id = "normal_note_" + note_id;

            var hidden_form = document.getElementById(hidden_form_id);
            hidden_form.style.display = "none";

            var shown_form = document.getElementById(normal_note_id);
            shown_form.style.display = "block";

        })


    })

    //kód pro ukazování / mizení protagonist notes a edit
    var protagonist_button = document.getElementById("protagonist_edit_button");
    var character_info = document.getElementById("character_info");
    var character_edit = document.getElementById("character_edit");

    //kód pro kontrolu otho, že je vybrána nějaká postava



    protagonist_button.addEventListener("click", function (){


        if (character_info.style.display === "block" || character_edit.style.display === "none"){
            character_info.style.display = "none";
            character_edit.style.display = "block";
        }
    })

    var character_cancel_button = document.getElementById("character_cancel_button");

    character_cancel_button.addEventListener("click", function (){
        character_info.style.display = "block";
        character_edit.style.display = "none";
    })






})


