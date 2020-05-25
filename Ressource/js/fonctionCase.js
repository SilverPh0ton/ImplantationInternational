
var liste = [];

$(document).ready(function() {
  $(".caseClass").change(function() {
liste = [];

var questionId = $(this).attr("data-id");
    $("input[name="+"case"+questionId+"]").each(function() {
    liste.push($(this).prop("checked"));

  });
   // liste.shift();
  var questionId = $(this).attr("data-id");
  $("input[name=" + questionId+"]").val(liste.join(";"));
    });


});


$(document).ready(function() {
  $(".radioClass").change(function() {
liste = [];
var questionId = $(this).attr("data-id");
$("input[name="+"radio"+questionId+"]").each(function() {
liste.push($(this).prop("checked"));
  });

  var questionId = $(this).attr("data-id");
  $("input[name=" + questionId+"]").val(liste.join(";"));
    });


});
