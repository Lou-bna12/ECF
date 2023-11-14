$(function () {
  let userBox = $('.header .header-2 .user-box');
  let navbar = $('.header .header-2 .navbar');

  $('#user-btn').click(function () {
    userBox.toggleClass('active');
    navbar.removeClass('active');
  });

  $('#menu-btn').click(function () {
    navbar.toggleClass('active');
    userBox.removeClass('active');
  });

  function handleNavbarOnScroll() {
    userBox.removeClass('active');
    navbar.toggleClass('active', $(window).scrollTop() > 60);
  }

  handleNavbarOnScroll();

  $(window).on('resize', function () {
    if ($(window).width() > 768) {
      navbar.removeClass('active');
    }
  });

  $(window).on('scroll', handleNavbarOnScroll);

  $('#appliquerFiltres').on('click', function () {
    var prix = $('#prix').val();
    var km = $('#km').val();
    var annee = $('#annee').val();

    $.post('home.php', { prix: prix, km: km, annee: annee }, function (data) {
      $('.box-container').html(data);
    });
  });
});

$(document).ready(function () {
  // ...

  // Utiliser une seule fonction ready
  $('#appliquerFiltres').on('click', function () {
    var prix = $('#prix').val();
    var km = $('#km').val();
    var annee = $('#annee').val();

    $.post(
      'resultats.php',
      { prix: prix, km: km, annee: annee },
      function (data) {
        // Mettre à jour la section des résultats filtrés avec les nouveaux résultats
        $('.resultats-container').html(data);
      }
    );
  });
});
