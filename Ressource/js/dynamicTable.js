$(document).ready(function () {

    $(".activityTable").on('click',".addRow", (function() {

        var name = $("#endroit_field").val();
        var description = $("#description_field").val();
        var startYear = $("#startYear").val();
        var startMonth = $("#startMonth").val();
        var startDay = $("#startDay").val();
        var endYear = $("#endYear").val();
        var endMonth = $("#endMonth").val();
        var endDay = $("#endDay").val();
        var markup =
            "<tr>" +
            "<td class='tdEndroit'>" + "<input type=\"hidden\" name=\"endroit\"" + " maxlength=\"50\"" + "\" value=" + name + ">" + name + "</td>" +
            "<td class='tdDescription'>" + "<input type=\"hidden\" name=\"description"+ " maxlength=\"100\"" + "\" value=" + description + ">" + description + "</td>" +
            "<td>" + "<input type=\"hidden\" name=\"dateDepart" + "\" value=" + startYear + '-' + startMonth + '-' + startDay + ">" + startYear + '-' + startMonth + '-' + startDay + "</td>" +
            "<td>" + "<input type=\"hidden\" name=\"dateRetour" + "\" value=" + endYear + '-' + endMonth + '-' + endDay + ">" + endYear + '-' + endMonth + '-' + endDay + "</td>" +
            "<td>  <button type='button' class=\"deleteRow\"><i class=\"fa fa-trash\"></i></button></td>    " +
            "</tr>";
        $("table tbody ").prepend(markup);
        adjust_id();

        $("#endroit_field").val("");
        $("#description_field").val("");
        $("#startYear").val($("#endYear").val());
        $("#startMonth").val($("#endMonth").val());
        $("#startDay").val($("#endDay").val());
        $('.addRow').attr('disabled', true);
    }));

    $('.addRow').attr('disabled', true);

    $(".activityTable").on('keyup',".endroit_type", (function() {
        if ($(this).val().length > 3) {
            $('.addRow').attr('disabled', false);
        } else {
            $('.addRow').attr('disabled', true);
        }
    }));

    $(".activityTable").on("click", ".deleteRow", function () {
        $(this).parents("tr").remove();
        adjust_id();
    });


function adjust_id() {
    var index = 0;
    $('.activityTable > tbody  > tr').each(function () {
        $(this.childNodes[0].firstChild).attr('name', ("endroit" + index.toString()));
        $(this.childNodes[1].firstChild).attr('name', ("description" + index.toString()));
        $(this.childNodes[2].firstChild).attr('name', ("dateDepart" + index.toString()));
        $(this.childNodes[3].firstChild).attr('name', ("dateRetour" + index.toString()));
        index++;
    });
    console.log("Testing");

    $('.activityTable > tbody  > tr').last().each(function () {
        $(this.childNodes[0].firstChild).attr('name', (""));
        $(this.childNodes[1].firstChild).attr('name', (""));
        $(this.childNodes[2].firstChild).attr('name', (""));
        $(this.childNodes[3].firstChild).attr('name', (""));
    });
}

$(function() {
   adjust_id();
});
});

