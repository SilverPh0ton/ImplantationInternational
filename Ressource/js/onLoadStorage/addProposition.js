function savedata() {
    sessionStorage.setItem("brouillon", $('#brouillon').is(":checked"));
    sessionStorage.setItem("nom_projet", $('input[name="nom_projet"]').val());
    sessionStorage.setItem("id_destination", $('select[name="id_destination"]').val());
    sessionStorage.setItem("ville", $('input[name="ville"]').val());
    sessionStorage.setItem("note", $('textarea[name="note"]').val());
    sessionStorage.setItem("date_depart[year]", $('select[name="date_depart[year]"]').val());
    sessionStorage.setItem("date_depart[month]", $('select[name="date_depart[month]"]').val());
    sessionStorage.setItem("date_depart[day]", $('select[name="date_depart[day]"]').val());
    sessionStorage.setItem("date_retour[year]", $('select[name="date_retour[year]"]').val());
    sessionStorage.setItem("date_retour[month]", $('select[name="date_retour[month]"]').val());
    sessionStorage.setItem("date_retour[day]", $('select[name="date_retour[day]"]').val());

    //Calendrier des activités prévues
    sessionStorage.setItem("endroit_field", $('#endroit_field').val());
    sessionStorage.setItem("description_field", $('#description_field').val());
    sessionStorage.setItem("activite_date_depart[year]", $('select[name="activite_date_depart[year]"]').val());
    sessionStorage.setItem("activite_date_depart[month]", $('select[name="activite_date_depart[month]"]').val());
    sessionStorage.setItem("activite_date_depart[day]", $('select[name="activite_date_depart[day]"]').val());
    sessionStorage.setItem("activite_date_retour[year]", $('select[name="activite_date_retour[year]"]').val());
    sessionStorage.setItem("activite_date_retour[month]", $('select[name="activite_date_retour[month]"]').val());
    sessionStorage.setItem("activite_date_retour[day]", $('select[name="activite_date_retour[day]"]').val());

    var activity_arr = new Array();
    var table = document.getElementById("activityTable");

    for (var i = 1; i < table.rows.length-1; i++) {
        var row = table.rows[i];
        var cell_content = new Array();
       for (var j = 0, col; col = row.cells[j]; j++) {
           cell_content[j] = row.cells[j].textContent;
       }
       var activity_obj = {
           endroit:cell_content[0],
           description:cell_content[1],
           date_depart:cell_content[2],
           date_fin:cell_content[3]
       };
       activity_arr.push(activity_obj)
       activity_json = JSON.stringify(activity_arr);
    }
    sessionStorage.setItem("activity_json", activity_json);

    $('div .card').each(function(i, obj) {

        console.log(obj);
    });
}

window.onload = function() {

    var brouillon = sessionStorage.getItem("brouillon");
    var isTrueSet = (brouillon == 'true');
    if (brouillon !== null) $('#brouillon').prop('checked', isTrueSet);

    var nom_projet = sessionStorage.getItem("nom_projet");
    if (nom_projet !== null) $('input[name="nom_projet"]').val(nom_projet);

    var id_destination = sessionStorage.getItem("id_destination");
    if (id_destination !== null) $('select[name="id_destination"]').val(id_destination);

    var ville = sessionStorage.getItem("ville");
    if (ville !== null) $('input[name="ville"]').val(ville);

    var note = sessionStorage.getItem("note");
    if (note !== null) $('textarea[name="note"]').val(note);

    var ddYear = sessionStorage.getItem("date_depart[year]");
    if (ddYear !== null) $('select[name="date_depart[year]"]').val(ddYear);

    var ddMonth = sessionStorage.getItem("date_depart[month]");
    if (ddMonth !== null) $('select[name="date_depart[month]"]').val(ddMonth);

    var ddDay = sessionStorage.getItem("date_depart[day]");
    if (ddDay !== null) $('select[name="date_depart[day]"]').val(ddDay);

    var drYear = sessionStorage.getItem("date_retour[year]");
    if (drYear !== null) $('select[name="date_retour[year]"]').val(drYear);

    var drMonth = sessionStorage.getItem("date_retour[month]");
    if (drMonth !== null) $('select[name="date_retour[month]"]').val(drMonth);

    var drDay = sessionStorage.getItem("date_retour[day]");
    if (drDay !== null) $('select[name="date_retour[day]"]').val(drDay);


    //Calendrier des activités prévues
    var endroit_field = sessionStorage.getItem("endroit_field");
    if(endroit_field !== null) $('#endroit_field').val(endroit_field);

    var description_field = sessionStorage.getItem("description_field");
    if(description_field !== null) $('#description_field').val(description_field);

    var addYear = sessionStorage.getItem("activite_date_depart[year]");
    if (addYear !== null) $('select[name="activite_date_depart[year]"]').val(addYear);

    var addMonth = sessionStorage.getItem("activite_date_depart[month]");
    if(addYear !== null) $('select[name="activite_date_depart[month]"]').val(addMonth);

    var addDay = sessionStorage.getItem("activite_date_depart[day]");
    if (addDay !== null) $('select[name="activite_date_depart[day]"]').val(addDay);

    var adrYear = sessionStorage.getItem("activite_date_retour[year]");
    if (adrYear !== null) $('select[name="activite_date_retour[year]"]').val(adrYear);

    var adrMonth = sessionStorage.getItem("activite_date_retour[month]");
    if(adrYear !== null) $('select[name="activite_date_retour[month]"]').val(adrMonth);

    var adrDay = sessionStorage.getItem("activite_date_retour[day]");
    if (adrDay !== null) $('select[name="activite_date_retour[day]"]').val(adrDay);

    var activity_json = sessionStorage.getItem("activity_json");
    if (activity_json != null) {
        var activity_object = JSON.parse(activity_json);

        for (var i = 0; i < activity_object.length;i++){

        }

    }



    //clearSessionItems();
}

function clearSessionItems(){
    sessionStorage.removeItem('pseudo');
    sessionStorage.removeItem('select_type_acc');
    sessionStorage.removeItem('actif');
    sessionStorage.removeItem('courriel');
    sessionStorage.removeItem('prenom');
    sessionStorage.removeItem('nom');
    sessionStorage.removeItem('telephone');
    sessionStorage.removeItem('id_programme');
    sessionStorage.removeItem('date_naissance[year]');
    sessionStorage.removeItem('date_naissance[month]');
    sessionStorage.removeItem('date_naissance[day]');
}
