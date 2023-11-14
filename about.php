<?php

include ('config.php');

session_start();

$user_id = $_SESSION['user_id'];

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

   <!--JQuery-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
   <!--  css dossier admin -->

   <link rel="stylesheet" href="Garage Parrot/css/style.css">
</head>
<body>

<?php include('header.php'); ?>

<div class="heading">

   <h3>À propos</h3>
<p><a href="home.php">Accueil</a> / À propos</p>
</div> 

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="Garage Parrot/images/about-img.jpg" alt="">
</div>

<div class="content">
   <h3>Pourquoi avons-nous choisi ?</h3>
   <p>
   Installée depuis 2003 à Nantes, (44000), le garage V.Parrot vous accueille et vous conseille pour l'entretien et la réparation de votre véhicule.<br>
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

<section class="reviews">
<h1 class="title">Les commentaires des clients</h1>

<div class="box-container">

<div class="box">
      <img src="Garage Parrot/images/pic-1.png" alt="">
   <p>Garage sérieux et responsabilité professionnelle.</p>
   <div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
   </div>
   <h3>Mickaël BEAUMANN</h3>
</div>

<div class="box">
   <img src="Garage Parrot/images/pic-2.png" alt="">
   <p>Super, garage.Bravo à toutes l'équipe.</p>
   <div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
   </div>
   <h3>Maryline SUZINEAU</h3>
</div>

<div class="box">
   <img src="Garage Parrot/images/pic-3.png" alt="">
 <p>Bon garage ,bon accueil, réparations bien tenue...</p>
   <div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
   </div>
   <h3>Serge RAULT</h3>
</div>

<div class="box">
   <img src="Garage Parrot/images/pic-4.png" alt="">
   <p>Excellent accueil, rdv très rapide.</p>
   <div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
   </div>
   <h3>Michélle MERCEUR</h3>
</div>

<div class="box">
   <img src="Garage Parrot/images/pic-5.png" alt="">
   <p> Super accueil avec un suivi de qualité.</p>
   <div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
   </div>
   <h3>Thierry BONNEFOI</h3>
</div>

<div class="box">
   <img src="Garage Parrot/images/pic-6.png" alt="">
   <p>Bon accueil travaux propre.</p>
   <div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
   </div>
   <h3>Auréline JEAN</h3>
</div>

</div>

</section>

<section class="teams">

<h1 class="title">Notre meilleure équipe</h1>

   <div class="box-container">

   <div class="box">
      <img src="Garage Parrot/images/team-1.jpg" alt="">
      <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>John DOE<h3>
      </div>
   
   <div class="box">
      <img src="Garage Parrot/images/team-2.jpg" alt="">
      <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Stephanie REBELLE<h3>
     </div>
<div class="box">
      <img src="Garage Parrot/images/team-3.jpg" alt="">
      <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Alexis MARTINEZ<h3>
      </div>
 <div class="box">
      <img src="Garage Parrot/images/team-4.jpg" alt="">
      <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Cedric DASILVA<h3>
      </div>
      <div class="box">
      <img src="Garage Parrot/images/team-5.jpg" alt="">
      <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Adam DASIA<h3>
</div>
<div class="box">
      <img src="Garage Parrot/images/team-6.jpg" alt="">
      <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Mark MARTINE<h3>
 </div>


</div>
</section>








<?php include('footer.php')?>




 <!-- js dossier admin -->
 <script src="Garage Parrot/js/script.js"></script>


</body>
</html>