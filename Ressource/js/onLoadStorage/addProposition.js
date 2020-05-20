function savedata() {
    sessionStorage.setItem("nom_projet", $('#nom_projet').val());
    sessionStorage.setItem("id_destination", $('select[name="id_destination"]').val());
    sessionStorage.setItem("ville", $('input[name="ville"]').val());
    sessionStorage.setItem("note", $('textarea[name="note"]').val());
    sessionStorage.setItem("date_depart[year]", $('select[name="dare_depart[year]"]').val());
    sessionStorage.setItem("date_depart[month]", $('select[name="date_depart[month]"]').val());
    sessionStorage.setItem("date_depart[day]", $('select[name="date_depart[day]"]').val());
    sessionStorage.setItem("date_retour[year]", $('select[name="date_retour[year]"]').val());
    sessionStorage.setItem("date_retour[month]", $('select[name="date_retour[month]"]').val());
    sessionStorage.setItem("date_retour[day]", $('select[name="date_retour[day]"]').val());
}

window.onload = function() {

    var pseudo = sessionStorage.getItem("pseudo");
    if (pseudo !== null) $('#pseudo').val(pseudo);

    var select_type_acc = sessionStorage.getItem("select_type_acc");
    if (select_type_acc !== null) $('#select_type_acc').val(select_type_acc);

    var actif = sessionStorage.getItem("actif");
    var isTrueSet = (actif == 'true');
    if (actif !== null) $('#actif').prop('checked', isTrueSet);

    var courriel = sessionStorage.getItem("courriel");
    if (courriel !== null) $('#courriel').val(courriel);

    var prenom = sessionStorage.getItem("prenom");
    if (prenom !== null) $('#prenom').val(prenom);

    var nom = sessionStorage.getItem("nom");
    if (nom !== null) $('#nom').val(nom);

    var telephone = sessionStorage.getItem("telephone");
    if (telephone !== null) $('#telephone').val(telephone);

    var id_programme = sessionStorage.getItem("id_programme");
    if (id_programme !== null) $('#id_programme').val(id_programme);

    var dnYear = sessionStorage.getItem("date_naissance[year]");
    if (dnYear !== null) $('select[name="date_naissance[year]"]').val(dnYear);

    var dnMonth = sessionStorage.getItem("date_naissance[month]");
    if (dnMonth !== null) $('select[name="date_naissance[month]"]').val(dnMonth);

    var dnDay = sessionStorage.getItem("date_naissance[day]");
    if (dnDay !== null) $('select[name="date_naissance[day]"]').val(dnDay);

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
}
