<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].','. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['marque'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['prix'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method'
   AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'Le panier est vide';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'La commande est déjà passée !'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'Commande passée avec succès !!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

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
   <h3>Procéder au paiement</h3>
   <p> <a href="home.php">Accueil</a> / Paiement </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['prix'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['marque']; ?> <span>(<?php echo $fetch_cart['prix'].'€'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Votre panier est vide</p>';
   }
   ?>
   <div class="grand-total"> Total : <span><?php echo $grand_total; ?> €</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Passez votre commande</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Nom :</span>
            <input type="text" name="name" required placeholder="Entrer votre nom">
         </div>
         <div class="inputBox">
            <span>Numéro de téléphone :</span>
            <input type="number" name="number" required placeholder="Entrer votre numéro de téléphone">
         </div>
         <div class="inputBox">
            <span>E-mail :</span>
            <input type="email" name="email" required placeholder="Entrer votre e-mail">
         </div>
         <div class="inputBox">
            <span>Le mode de paiemen :</span>
            <select name="method">
               <option value="cash on delivery">A la livraison</option>
               <option value="credit card">Carte bancaire</option>
               <option value="paypal">Paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Ligne d'adresse 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. 12...">
         </div>
         <div class="inputBox">
            <span>Ligne d'adresse 02 :</span>
            <input type="text" name="street" required placeholder="Nom de la rue... ">
         </div>
         <div class="inputBox">
            <span>Ville :</span>
            <input type="text" name="city" required placeholder="e.g. Nantes">
         </div>
         <div class="inputBox">
            <span>Code postal :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
         <div class="inputBox">
            <span>Pays :</span>
            <input type="text" name="state" required placeholder="e.g. France">
         </div>
      </div>
      <input type="submit" value="Passer la commande" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>