
var liste = [];

$(document).ready(function() {
  $(".caseClass").change(function() {
liste = [];
    $(".caseClass").each(function() {
    liste.push($(this).prop("checked"));
  });
    liste.shift();
  var questionId = $(this).attr("data-id");
  $("input[name=" + questionId+"]").val(liste.join(";"));
    });


});
