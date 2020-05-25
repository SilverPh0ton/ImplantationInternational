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
            '<tr>' +
                '<td>' +
                    '<input class="inputEndroit" type="hidden" name="endroit" maxlength="50" value="' + name + '">' + name +
                '</td>' +
                '<td>' +
                    '<input class="inputDescription" type="hidden" name="description" maxlength="100" value="' + description + '">' + description +
                '</td>' +
                '<td>' +
                    '<input class="inputDateDepart" type="hidden" name="dateDepart" value="' + startYear + '-' + startMonth + '-' + startDay + '">' + startYear + '-' + startMonth + '-' + startDay +
                '</td>' +
                '<td>' +
                    '<input class="inputDateRetour" type="hidden" name="dateRetour" value="' + endYear + '-' + endMonth + '-' + endDay + '">' + endYear + '-' + endMonth + '-' + endDay +
                '</td>' +
                '<td>' +
                    '<button type="button" class="deleteRow"><i class="fa fa-trash"></i></button>' +
                '</td>' +
            '</tr>';
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
        var index;

        index = 0;
        $('.activityTable').find('.inputEndroit').each(function () {
            $(this).attr('name', ("endroit" + index.toString()));
            index++;
        });
        index = 0;
        $('.activityTable').find('.inputDescription').each(function () {
            $(this).attr('name', ("description" + index.toString()));
            index++;
        });
        index = 0;
        $('.activityTable').find('.inputDateDepart').each(function () {
            $(this).attr('name', ("dateDepart" + index.toString()));
            index++;
        });
        index = 0;
        $('.activityTable').find('.inputDateRetour').each(function () {
            $(this).attr('name', ("dateRetour" + index.toString()));
            index++;
        });

    }

    $(function() {
        adjust_id();
    });
});