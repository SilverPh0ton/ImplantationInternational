$(document).ready(function() {
  hideAll();

  $(".displayOption").click(function() {
    hideAll();

    if ($(this).val() === 'Curseur' || $(this).val() === 'Chiffre') {
      selectNumber();
    } else if ($(this).val() === 'Liste' || $(this).val() === 'Case' || $(this).val() === 'Radio'){
      selectList();
    } else if ($(this).val() === 'Telechargement') {
      selectDownload();
    }});

    $("#categorie").change(function () {
        $("#id_categorie").val($("#categorie").val());
    })

    $("#regroupementChange").change(function () {
        $("#regroupementHidden").val($("#regroupementChange").val());
    })

  let chechedOption = $("input[name=affichage]:checked").val();
  if (chechedOption === 'Curseur' || chechedOption === 'Chiffre') {
    selectNumber();
  } else if (chechedOption === 'Telechargement') {
    selectDownload();
  } else if (chechedOption === 'Liste' || chechedOption === 'Case'|| chechedOption === 'Radio') {
    selectList();
  }

});

function selectNumber() {
  $("#options").show();
  $("#optionBorder").show();

  $("#value_min").show();
  $("#value_max").show();
  $("#value_step").show();

  $("#input_option").val("0;100;1");

  $("#value_min").find("input").keyup(function() {
    $("#input_option").val(generatNumberOption());
    if (parseFloat($("#value_min").find("input").val()) > parseFloat($("#value_max").find("input").val())) {
      $("#value_min").find("input").val($("#value_max").find("input").val())
    }
  });

  $("#value_max").find("input").keyup(function() {
    $("#input_option").val(generatNumberOption());
    if (parseFloat($("#value_min").find("input").val()) > parseFloat($("#value_max").find("input").val())) {
      $("#value_max").find("input").val($("#value_min").find("input").val())
    }
  });

  $("#value_step").find("input").keyup(function() {
    $("#input_option").val(generatNumberOption());
    if (parseFloat($("#value_step").find("input").val()) > parseFloat($("#value_max").find("input").val())) {
      $("#value_step").find("input").val($("#value_max").find("input").val())
    }
  });
}

function selectList() {
  $("#options").show();
  $("#optionBorder").show();

  $("#list_option").show();
  $("#list_option").find("input").prop('required', "required");

  $("#list_option").find("input").keyup(function() {
    $("#input_option").val($(this).val());
  });
}

function selectDownload() {
  $("#options").show();
  $("#optionBorder").show();

  $("#file").show();
  $("#file").find("input").prop('required', "required");

  $("#file").find("input").change(function(e) {
    $("#input_option").val(e.target.files[0].name);
  });
}

function hideAll() {
  $("#options").hide();
  $("#optionBorder").hide();

  $("#list_option").find("input").prop('required', false);
  $("#file").find("input").prop('required', false);

  $("#list_option").hide();
  $("#value_min").hide();
  $("#value_max").hide();
  $("#value_step").hide();
  $("#file").hide();
}

function generatNumberOption() {
  let min = parseFloat($("#value_min").find("input").val() === "" ? 0 : $("#value_min").find("input").val());
  let max = parseFloat($("#value_max").find("input").val() === "" ? 100 : $("#value_max").find("input").val());
  let step = parseFloat($("#value_step").find("input").val() === "" ? 1 : $("#value_step").find("input").val());

  return min + ";" + max + ";" + step;
}