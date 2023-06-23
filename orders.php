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
   <title>Vos commandes</title>

      <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
   <!--  css dossier admin -->

   <link rel="stylesheet" href="Garage Parrot/css/style.css">
</head>
<body>

<?php include('header.php'); ?>
   
<div class="heading">

   <h3>Vos commandes</h3>
   <p><a href="home.php">Accueil</a> / Vos commandes </p>
</div>

<section class="placed-orders">

   <h1 class="title">Commandes passées</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> La date de commande a été établie le : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Nom : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Numéro de téléphone : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Adresse email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Addresse : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Methode de paiement : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Vos commandes : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total : <span><?php echo $fetch_orders['total_price']; ?> €</span> </p>
         <p> Statut du paiement : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="Aucune commande n\'a encore été passée !</p>';
      }
      ?>
   </div>

</section>





<?php include('footer.php')?>




 <!-- js dossier admin -->
 <script src="Garage Parrot/js/script.js"></script>


</body>
</html>