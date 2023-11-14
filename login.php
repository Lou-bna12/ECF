<?php
include('config.php'); 

session_start();
if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users`
   WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'employé'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }elseif($row['user_type'] == 'client'){
         
         $_SESSION['client_name'] = $row['name'];
         $_SESSION['client_email'] = $row['email'];
         $_SESSION['client_id'] = $row['id'];
         header('location:index.php');

   }

   }else{
      $message[] = 'E-mail ou mot de passe incorrect !';
   }

}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Connexion</title>

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
   <h3>Connectez-vous</h3>
   <input type="email" name="email" placeholder="Entrer votre email " required class="box">
   <input type="password" name="password" placeholder="Entrer votre mot de passe" required class="box">
   <input type="submit" name="submit" value="Connexion" class="btn">
   <p>Vous n'avez pas de compte? <a href="register.php"> Inscrivez-vous</a></p>
</form>

</div>

</body>
</html>