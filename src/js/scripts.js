
$(document).ready(function () {
    $(".form_note").submit(function (e) {
        e.preventDefault();
        let date = $("#date_note").val();
        let description = $("#description_note").val();

        console.log(date);
        console.log(description);
        return false;
    });


});
