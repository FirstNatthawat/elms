$(document).ready(function () {
  $(".datepicker").each(function () {
    var pickr = $(this).pickadate({
      format: "dd/mm/yyyy",
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year
      editable: true,
    });

    $(this).click(function () {
      pickr.pickadate("open");
    });
  });
  $(document).ready(function () {
    $("select").material_select();
  });

  $("input.autocomplete").autocomplete({
    data: {
      Apple: null,
      Microsoft: null,
      Google: "assets/images/google.png",
    },
  });
});
$(".datepicker").datepicker({
  format: "yyyy-mm-dd",
});
