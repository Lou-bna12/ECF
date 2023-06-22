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
   <title>La caisse</title>
    
      <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
   <!--  css dossier admin -->

   <link rel="stylesheet" href="Garage Parrot/css/style.css">
</head>
<body>

<?php include('header.php'); ?>
   
<div class="heading">

   <h3>La caisse</h3>
   <p><a href="home.php">Accueil</a> / La caisse </p>
</div>

<section class="display-order">

<?php
$grand_total = 0;
$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select_cart) > 0){
   while($fetch_cart = mysqli_fetch_assoc($select_cart)){
      $total_prix = ($fetch_cart['prix'] * $fetch_cart['quantity']);
      $grand_total += $total_prix;
?>
<p> <?php echo $fetch_cart['marque']; ?> <span>(<?php echo $fetch_cart['prix'].'€'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
<?php
}
}else{
echo '<p class="empty">Votre panier est vide</p>';
}
?>





</section>


<section class="checkout">



</section>





<?php include('footer.php')?>




 <!-- js dossier admin -->
 <script src="Garage Parrot/js/script.js"></script>


</body>
</html>