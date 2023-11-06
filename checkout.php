<?php

include ('config.php');

session_start();

$user_id = $_SESSION['name'];

if(!isset($user_id)){
  header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn,  $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
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

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'Le panier est vide';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'La commande est déjà passée !'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'Commande passée avec succès !';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
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
<div class="grand-total"> Total : <span><?php echo $grand_total; ?></span> €</div>



</section>


<section class="checkout">
<form action="" method="post">
   <h3>Passez votre commande</h3>
   <div class="flex">
   <div class="flex">
         <div class="inputBox">
            <span>Nom :</span>
            <input type="text" name="name" required placeholder="Entrer votre nom">
         </div>
         <div class="inputBox">
            <span>Numéro de téléphone :</span>
            <input type="number" name="number" required placeholder="Entrer votre numéro de téléphone ">
         </div>
         <div class="inputBox">
            <span>Adresse email :</span>
            <input type="email" name="email" required placeholder="Entrer votre addresse email">
         </div>
         <div class="inputBox">
            <span>Le mode de paiement :</span>
            <select name="method">
               <option value="A la livraison">A la livraison </option>
               <option value="carte bancaire">carte bancaire</option>
               <option value="paypal">paypal</option>
          </select>
         </div>
         <div class="inputBox">
            <span>Ligne d'adresse 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="Num de la rue...">
         </div>
         <div class="inputBox">
            <span>Ligne d'adresse 02 :</span>
            <input type="text" name="street" required placeholder="Votre addresse...">
         </div>
         <div class="inputBox">
            <span>Ville :</span>
            <input type="text" name="city" required placeholder="Ville...">
         </div>
         <div class="inputBox">
            <span>Code postal :</span>
            <input type="number" min="0" name="pin_code" required placeholder="Code postal...">
         </div> 
         <div class="inputBox">
            <span>Pays :</span>
            <input type="text" name="country" required placeholder="Pays...">
         </div>
       </div>
       <input type="submit" value="Commandez maintenant" class="btn" name="order_btn">    
  </form>

  </section>





<?php include('footer.php')?>




 <!-- js dossier admin -->
 <script src="Garage Parrot/js/script.js"></script>


</body>
</html>