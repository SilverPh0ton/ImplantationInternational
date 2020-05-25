var liste = [];

$(document).ready(function () {
    $(".caseClass").change(function () {
        liste = [];

        var questionId = $(this).attr("data-id");
        $("input[name=" + "case" + questionId + "]").each(function () {
            liste.push($(this).prop("checked"));
        });
        // liste.shift();
        $("input[name=" + questionId + "]").val(liste.join(";"));
    });

    $(".radioClass").change(function () {
        liste = [];
        let questionId = $(this).attr("data-id");
        $("input[name=" + "radio" + questionId + "]").each(function () {
            liste.push($(this).prop("checked"));
        });

        $("input[name=" + questionId + "]").val(liste.join(";"));
    });


});
