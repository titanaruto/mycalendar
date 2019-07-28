var learnMore = function learnMore(resultHtml, id) {
    //send ajax
    $.ajax({
        type: "POST",
        url: "contentAjaxArticle.php",
        data: {id: id},
        success: function (html) {
            //result
            $(resultHtml).html(html);
        }
    });
};

var addComments = function addComments(formid, resultHtml) {
    var form = $(formid).serialize();
    console.log(form);
    //send ajax
    $.ajax({
        type: "POST",
        url: "addComments.php",
        data: form,
        success: function (html) {
            //result
            $(resultHtml).html(html);
        }
    });
};