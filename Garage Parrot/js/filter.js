$(document).ready(function () {
  $('#filter-form').submit(function (event) {
    event.preventDefault();

    var prix = $('#prix').val();
    var km = $('#km').val();
    var annee = $('#annee').val();

    var data = {};
    if (prix) data.prix = prix;
    if (km) data.km = km;
    if (annee) data.annee = annee;

    $.ajax({
      type: 'POST',
      url: 'resultats.php',
      data: data,
      dataType: 'html', // Ajoutez cette ligne
      success: function (response) {
        $('.resultats-container').html(response);
      },
    });
  });
});
