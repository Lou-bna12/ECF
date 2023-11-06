<?php
include('config.php'); 

session_start();



if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM `users` WHERE email= '$email' AND password='$password'";
   $result = mysqli_query($conn, $sql);
   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      if($row['user_type'] == 'admin'){
         $_SESSION['name'] = $row['name'];
         $_SESSION['email'] = $row['email'];
         header("Location: admin_page.php");
      }else{
         $_SESSION['name'] = $row['name'];
         header("Location: home.php");

      }
   }else{
      echo "<script>alert('Woops! Email ou mot de passe incorrect.')</script>";
   }

}

if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

$sql = "SELECT * FROM `users` WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
   $row = mysqli_fetch_assoc($result);
   if($row['user_type'] == 'user'){
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      header("Location:home.php");
   }else{
      $_SESSION['name'] = $row['name'];

   }
}
}
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

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


<?php include('footer.php')?>

</body>
</html>