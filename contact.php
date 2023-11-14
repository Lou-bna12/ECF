<?php

include ('config.php');

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email ='$email' AND number =
   '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Message déjà envoyé !';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) 
      VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Message envoyé avec succès !';
   }

}


?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contacte</title>

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

   <h3>Contacter-nous</h3>
<p><a href="index.php">Accueil</a> / Contacte </p>
</div> 

<section class="contact">
<form action="" method="post">
      <h3>Dites quelque chose!</h3>
      <input type="text" name="name" required placeholder="Entrer votre nom " class="box">
      <input type="email" name="email" required placeholder="Entrer votre addresse email" class="box">
      <input type="number" name="number" required placeholder="Entrer votre number de téléphone" class="box">
      <textarea name="message" class="box" placeholder="Entrer votre message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Envoyer" name="send" class="btn">
   </form>

</section>



<!-- js dossier admin -->
<script src="Garage Parrot/js/script.js"></script>

<?php include('footer.php')?>
</body>
</html>