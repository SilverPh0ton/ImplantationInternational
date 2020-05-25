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

    sessionStorage.setItem("activiteTable", document.getElementById("activityTable").innerHTML);

    //Renseignements supplémentaires

    let prevNames = new Array();
    let prevNamesR = new Array();
    var leArray = new Array();

    $('div .card-body *').filter(':input').each(function(){
        var type = $(this).attr('type');
        var name = $(this).attr('name');

        switch (type) {
            case "checkbox":
                let reponse_choix = new Array()
                if(prevNames.includes(name) == false){
                    $("input[name='" +name+ "']").each(function(index,data) {
                        reponse_choix.push($(this).is(':checked'));
                    });
                    var question_reponse = { [name] : reponse_choix };
                    leArray.push(question_reponse);
                }
                prevNames.push(name);
                break;
            case "radio":
                let reponse_choix2 = new Array()
                if(prevNamesR.includes(name) == false){
                    $("input[name='" +name+ "']").each(function(index,data) {
                        reponse_choix2.push($(this).is(':checked'));
                    });
                    var question_reponse2 = { [name] : reponse_choix2 };
                    leArray.push(question_reponse2);
                }
                prevNamesR.push(name);
            case "default" :
                value = $(this).val();
                var question_reponse = { [name] : value };
                leArray.push(question_reponse);
                break;
        }
    });

    $('div .card-body *').filter('textarea').each(function(){
        var name = $(this).attr('name');

         value = $(this).val();
         var question_reponse = { [name] : value };
         leArray.push(question_reponse);
    });

    $('div .card-body *').filter('select').each(function(){
        var name = $(this).attr('name');

         value = $(this).val();
         var question_reponse = { [name] : value };
         leArray.push(question_reponse);
    });


    qrDyn_json = JSON.stringify(leArray);
    sessionStorage.setItem("qrDyn_json", qrDyn_json);
}

window.onload = function() {

  var table = sessionStorage.getItem("activiteTable");
    if(table !== null){
        document.getElementById("activityTable").innerHTML = table;
    }

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


    //Renseignements supplémentaires
    var prevNames = new Array();
    var prevNamesR = new Array();
    var chaine = "";

    var qrDyn_json = sessionStorage.getItem("qrDyn_json");
    if (qrDyn_json != null) {
        var qrDyn_object = JSON.parse(qrDyn_json);
        var keys = new Array();
        for (var i=0; i<qrDyn_object.length;i++){
            keys.push(Object.keys(qrDyn_object[i]));
        }

        $('div .card-body *').filter(':input').each(function(){
            var type = $(this).attr('type');
            var name = $(this).attr('name');

             // if (type=="hidden") $(this).val("false;false;true")

            for (var i = 0; i < qrDyn_object.length; i++) {
                if (keys[i] == name) {
                    switch (type) {
                        case "checkbox":
                            if (prevNames.includes(name) == false) {
                                boolArr = qrDyn_object[i][keys[i]];
                                $("input[name='" +name+ "']").each(function(index,data) {
                                    var isTrueSet = (boolArr[index] == true);
                                    $(this).prop('checked', isTrueSet);
                                    chaine += boolArr[index]+";";
                                });
                                var dataId = $(this).attr('data-id');
                                $('input[name='+dataId+']').val(chaine);
                            }
                            prevNames.push(name);
                            break;
                        case "radio":
                            if (prevNamesR.includes(name) == false) {
                                $("input[name='" +name+ "']").each(function(index,data) {
                                    if ($(this).val() == qrDyn_object[i][keys[i]]){
                                        $(this).prop('checked', qrDyn_object[i][keys[i]]);
                                    }
                                });
                            }
                            prevNamesR.push(name);
                            break;
                        case "default" :
                            console.log($(this).attr('name'));
                            $(this).val(qrDyn_object[i][keys[i]]);
                            break;
                    }
                }
            }
        });

        $('div .card-body *').filter('textarea').each(function(){
            var name = $(this).attr('name');

            for (var i = 0; i < qrDyn_object.length; i++) {
                if (keys[i] == name) {
                    $(this).val(qrDyn_object[i][keys[i]]);
                }
            }
        });

        $('div .card-body *').filter('select').each(function(){
            var name = $(this).attr('name');

            for (var i = 0; i < qrDyn_object.length; i++) {
                if (keys[i] == name) {
                    $(this).val(qrDyn_object[i][keys[i]]);
                }
            }
        });

    }

    //alert('IMPORTANT : Vous devez retéléverser vos fichiers.');
    clearSessionItems();
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
    sessionStorage.removeItem('activiteTable')

}
