<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'")
   or die('query failed');
   $select_users = mysqli_query($conn, "SELECT * FROM `client` WHERE email = '$email' AND password = '$pass'")
   or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'L\'utilisateur existe déjà !';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirmer le mot de passe ne correspond pas !';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type)
         VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'Inscrit avec succès !';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>S'inscrire</title>

   <!--JQuery-->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

   <!--  css dossier -->

<link rel="stylesheet" href="Garage Parrot/css/style.css">

   </head>
<body>


<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="form-container">

<form action="" method="post">
   <h3>Mon espace</h3>
   <input type="text" name="name" placeholder="Entrer votre nom" required class="box">
   <input type="email" name="email" placeholder="Entrer votre email " required class="box">
   <input type="password" name="password" placeholder="Entrer votre mot de passe" required class="box">
   <input type="password" name="cpassword" placeholder="confirmer votre mot de passe" required class="box">
   <select name="user_type" class="box">
      <option value="employé">Employé</option>
      <option value="employé">Client</option>
      <option value="admin">Admin</option>
   </select>
   <input type="submit" name="submit" value="Connexion" class="btn">
   <p>Vous avez déja un compte?<a href="login.php"> Connectez-vous</a></p>
</form>

</div>
<?php include('footer.php')?>
</body>
</html>