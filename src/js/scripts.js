
$(document).ready(function () {
    $(".form_note").submit(function (e) {
        e.preventDefault();
        let date = $("#date_note").val();
        let description = $("#description_note").val();

        console.log(date);
        console.log(description);
        $('#note_Modal').modal('toggle');

        return false;
    });
    $(".datepicker-td").hover(function (e) {
        if(e.target.dataset.id != undefined){
            console.dir(e.target.dataset.id);
        }

    });


});
