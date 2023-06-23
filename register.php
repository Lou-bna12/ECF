<?php

include('config.php');

if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $cpassword = $_POST['cpassword'];
   $user_type = $_POST['user_type'];

   if($password == $cpassword){
      $sql = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      if(!$result->num_rows > 0){
         $sql = "INSERT INTO users (name, email, password, user_type)
         VALUES ('$name', '$email', '$password', '$user_type')";
         $result = mysqli_query($conn, $sql);
         if($result){
            echo "<script>alert(' Utilisateur enregistré avec succès.')</script>";
            $name = "";
            $email = "";
            $_POST['password'] = "";
            $_POST['cpassword'] = "";
            $user_type = "";
         }else{
            echo "<script>alert('Woops! Quelque chose s'est mal passé.')</script>";
         }
      }else{
         echo "<script>alert('Woops! Email déjà existant.')</script>";
      }

      
   }else{
      echo "<script>alert('Mot de passe ne correspond pas.')</script>";
      header("Location: login.php");
   }

}

?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer</title>

    <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!--  css dossier -->

<link rel="stylesheet" href="Garage Parrot/css/style.css">

   </head>
<body>

<?php include('header.php'); ?>

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
      <option value="user">Employé</option>
      <option value="admin">Admin</option>
   </select>
   <input type="submit" name="submit" value="Connexion" class="btn">
   <p>Vous avez déja un compte?<a href="login.php"> Connectez-vous</a></p>
</form>

</div>
<?php include('footer.php')?>
</body>
</html>