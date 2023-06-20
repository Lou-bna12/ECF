<?php

include ('config.php');

session_start();

$user_id = $_SESSION['name'];

if(!isset($user_id)){
  header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>À propos</title>

      <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
   <!--  css dossier admin -->

   <link rel="stylesheet" href="Garage Parrot/css/style.css">
</head>
<body>

<?php include('header.php'); ?>
   

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="Garage Parrot/images/about-img.jpg" alt="">
</div>

<div class="content">
   <h3>Pourquoi avons-nous choisi ?</h3>
   <p>
   Installée depuis 2003 à Nantes, à Nantes (44000), le garage V.Parrot vous accueille et vous conseille pour l'entretien et la réparation de votre véhicule.<br>
   Parce que le client est au centre de nos préoccupations, nous sommes très attentif à la qualité de nos prestations et services que l'on apporte à votre automobiles.<br>
   Mr Parrot et toute son équipe portent les couleurs du réseau AD Expert.<br>
   c'est aujourd'hui le premier réseau européen de réparateurs indépendants multimarques.<br>
   Le garage V.Parrot assure aussi bien l'entretien courant que les interventions les plus techniques sur tous les véhicules et ce quelle que soit leur marque.<br>
   Nous réalisons toutes les prestations de mécanique, géométrie, décalaminage, réglage des systèmes ADAS, carrosserie ainsi que la vente de véhicules d'occasions. <br>
   Toujours soucieux de la satisfaction de nos clients, nous apportons le meilleur conseil au prix le plus juste. Notre expertise technique nous permet aujourd'hui de garantir nos prestations 2 ans (pièces et main d'oeuvre).<br>
   Pour tous renseignements, le garage V.Parrot reste à votre écoute et ne manquera pas de vous réserver le meilleur accueil.<br>
   Vous pouvez également consulter l'ensemble de nos prestations sur notre site internet.
 </p>
 <a href="contact.php" class="btn">Contacter-nous</a>
</div>

  </div>

</div>

</section>

<section class="home-contact">

<div class="content">
   <h3>Avez-vous des questions ?</3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    <a href="contact.php" class="white-btn">Contacter-nous</a>
</div>


</section>








<?php include('footer.php')?>




 <!-- js dossier admin -->
 <script src="Garage Parrot/js/script.js"></script>


</body>
</html>