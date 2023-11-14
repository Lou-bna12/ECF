<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

   <!--JQuery-->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="Garage Parrot/css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">

   <h3>Vos commandes</h3>
   <p> <a href="home.php">Accueil</a> / Vos commandes  </p>
</div>

<section class="placed-orders">

   <h1 class="title">Commandes passées</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed: ' . mysqli_error($conn));


         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> La date de commande a été établie le : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Nom  : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Numéro de téléphone : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> E-mail : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Adresse : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Méthode de paiement  : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Vos commandes : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total : <span><?php echo $fetch_orders['total_price']; ?> €</span> </p>
         <p> Statut du paiement: <span style="color:<?php if($fetch_orders['payment_status'] == 'En attente')
         { echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
      }
      }else{
         echo '<p class="empty">Aucune commande n\'a encore été passée !</p>';
      }
      ?>
   </div>
   
</section>







<?php include('footer.php')?>
<!-- js dossier admin -->
<script src="Garage Parrot/js/script.js">

</script>


</body>
</html>
