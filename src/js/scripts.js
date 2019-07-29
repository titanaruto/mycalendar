$(document).ready(function () {
    $(".form_note").submit(function (e) {
        e.preventDefault();
        let date = $("#date_note").val();
        let description = $("#description_note").val();
        let url = "ajaxSaveNote.php";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "HTML",
            data: {
                date: date,
                description: description,
            },
            success: function (data) {
                $(".result_hover").html(data);
            }
        });
        $('#note_Modal').modal('toggle');

        return false;
    });
    $(".datepicker").mouseover(function (e) {
        let target = e.target.nodeName;
        if (target == "A") {
            if (e.target.dataset.id != undefined) {
                let date = e.target.dataset.id;
                let url = "ajaxHover.php";
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "HTML",
                    data: {
                        date: date,
                    },
                    success: function (data) {
                        $(".result_hover").html(data);
                    }
                });
            }
        }
    });

    $(".datepicker").click(function (e) {
        e.preventDefault();
        let clickTarget = e.target.className;
        if (clickTarget == "datepicker-next" || clickTarget == "datepicker-prev") {
            let currentDate = $(".datepicker-title").attr("data-time");
            let event = "";
            if (clickTarget == "datepicker-next") {
                event = "next";
            } else if (clickTarget == "datepicker-prev") {
                event = "prev";
            }
            let url = "ajaxNext.php";
            $.ajax({
                type: "POST",
                url: url,
                dataType: "HTML",
                data: {
                    currentDate: currentDate,
                    event: event,
                },
                success: function (data) {
                    console.log(data);
                    $(".datepicker").html(data);
                }
            });
            return false;
        }


    });

});
