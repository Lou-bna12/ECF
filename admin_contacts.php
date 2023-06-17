<?php
include('config.php');

session_start();

if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
   $result = mysqli_query($conn, $sql);
   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      if($row['user_type'] == 'admin'){
         $_SESSION['name'] = $row['name'];
         header("Location: login.php");
      }
   }else{
      echo "<script>alert('Woops! Email ou mot de passe incorrect.')</script>";
   }
}


?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <title>Contacte </title>

    <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
      <!--  css dossier admin -->

      <link rel="stylesheet" href="Garage Parrot/css/admin_style.css">
</head>
<body>


<?php include('admin_header.php'); ?>


 <!-- js dossier admin -->
   <script src="Garage Parrot/js/admin_script.js"></script>


</body>
</html>