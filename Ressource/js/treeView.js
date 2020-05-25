$(function () {
    $( ".sortableCat" ).sortable({
        containment: "parent",
        axis: "y",
        items: "> li",
        start: function( event, ui ) {
            ui.item.find('.nested').removeClass('active')
            ui.item.height('auto');
        },
        deactivate: function( event, ui ) {
            recalulatOrder();
        }
    });
    $( ".sortableQu" ).sortable({
        containment: "parent",
        axis: "y",
        items: "> li",
        deactivate: function( event, ui ) {
            recalulatOrder();
        }
    });

    $(".caret").click(function() {
        $(this).next().toggleClass("active");
        $(this).toggleClass("caret-down");
    });

    $(".parentCheckbox").change(function() {
        $(this).parent().find(".childCheckbox").prop('checked', $(this).prop('checked'));
        $(this).next().next().addClass("active");
        $(this).next().addClass("caret-down");
    });

    $(".childCheckbox").change(function() {
        $(this).closest('.nested').prev().prev().prop("indeterminate", true);
    });

    recalulatOrder();

    $('.parentCheckbox').each(function( index ) {
        let checked = 0;
        $(this).parent().find('.childCheckbox').each(function() {
            if($(this).prop("checked") === true){
                checked += 1;
            }
        });
        if(checked === $(this).parent().find('.childCheckbox').length){
            $(this).prop( "checked", true );
        }else if(checked > 0){
            $(this).prop("indeterminate", true);
        }
        console.log($(this).parent().find('.childCheckbox').length + '   ' + checked);
    });
});

function recalulatOrder(){

    $(".sortableCat").each(function( index ) {
        cat_ctr=0;
        $(this).find(".card-header").each(function( index ) {
            ctr=0;
            $(this).find("ul").find("li")
                .each(function( index ) {
                    $(this).find("table").find("tr").find("td").find(".cat_order").val(cat_ctr);
                    $(this).find("table").find("tr").find("td").find(".order").val(ctr++);
                });
            cat_ctr++
        });
    });



}
