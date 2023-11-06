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
     <title>Espace admin</title>

    <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
      <!--  css dossier admin -->

      <link rel="stylesheet" href="Garage Parrot/css/admin_style.css">
</head>
<body>


<?php include('admin_header.php'); ?>

<!-- début admin tableau de bord -->



<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">Tableau de bord</h1>
   <div class="box-container">

      <div class="box">
      <?php 
      $total_pendings = 0;
      $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status='pending'") or die(mysqli_error($conn));
if(mysqli_num_rows($select_pending) > 0){
   while($row = mysqli_fetch_assoc($select_pending)){
      $total_price = $row['total_price'];
      $total_pendings += $row['total_price'];
   };

  };

?>
      <h3><?php echo $total_pendings; ?></h3>
      <p>Commandes en attente</p>
    </div>

    <div class="box">
 <?php 
      $total_completed = 0;
      $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status='Terminée'") or die(mysqli_error($conn));
if(mysqli_num_rows($select_completed) > 0){
   while($row = mysqli_fetch_assoc($select_completed)){
      $total_price = $row['total_price'];
      $total_completed += $row['total_price'];
  };

};
?>
      <h3><?php echo $total_pendings; ?></h3>
      <p>Commandes terminées</p>
    </div>
         
    <div class="box">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die(mysqli_error($conn));
      $num_orders = mysqli_num_rows($select_orders);
      ?>
      <h3><?php echo $num_orders; ?></h3>
      <p>Commandes totales</p>
      </div>

      <div class="box">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die(mysqli_error($conn));
      $num_products = mysqli_num_rows($select_products);
      ?>
      <h3><?php echo $num_products; ?></h3>
      <p>Véhicule ajoutés</p>
</div>

<div class="box">
      <?php
      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'Employé'") or die(mysqli_error($conn));
      $num_users = mysqli_num_rows($select_users);
      ?>
      <h3><?php echo $num_users; ?></h3>
      <p>Employés</p>
      </div>

      <div class="box">
      <?php
      $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type='Admin'") or die(mysqli_error($conn));
      $num_admins = mysqli_num_rows($select_admins);
      ?>
      <h3><?php echo $num_admins; ?></h3>
      <p>Administrateurs</p>
   </div>

   <div class="box">
      <?php
      $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die(mysqli_error($conn));
      $num_account = mysqli_num_rows($select_account);
      ?>
      <h3><?php echo $num_account; ?></h3>
      <p>Total des comptes</p>
      </div>

      <div class="box">
      <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die(mysqli_error($conn));
      $num_message = mysqli_num_rows($select_message);
      ?>
      <h3><?php echo $num_message; ?></h3>
      <p>Nouveaux messages</p>
  </div>

 <!-- fin admin tableau de bord -->

 <!-- js dossier admin -->
   <script src="Garage Parrot/js/admin_script.js"></script>


</body>
</html>



