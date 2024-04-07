$(document).ready(function (){



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



})


