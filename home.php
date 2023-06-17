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
            }else{
         $_SESSION['name'] = $row['name'];
         header("Location: home.php");
      }
   }else{
      echo "<script>alert('Woops! Email ou mot de passe incorrect.')</script>";
   }
}



?>