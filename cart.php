<?php

include ('config.php');

session_start();

$user_id = $_SESSION['name'];

if(!isset($user_id)){
  header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'Quantité du panier mise à jour !';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location: cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location: cart.php');
}


?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panier</title>

      <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
   <!--  css dossier admin -->

   <link rel="stylesheet" href="Garage Parrot/css/style.css">
</head>
<body>

<?php include('header.php'); ?>
   
<div class="heading">

   <h3>Panier</h3>
   <p><a href="home.php">Accueil</a> / Commandes </p>
</div>

<section class="shopping-cart">

   <h1 class="title">Les véhicules ajoutés</h1>

   <div class="box-container">
      <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
   ?>
<div class="box">
   <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Supprimer ce produit du panier ?');"></a>
   <img src="uploaded_img/<?php echo $fetch_cart['image'] ;?>" alt="">
   <div class="marque"><?php echo $fetch_cart['marque']; ?></div>
   <div class="prix"><?php echo $fetch_cart['prix']; ?> €</div>
   <div class="annee"><?php echo $fetch_cart['annee']; ?></div>
   <div class="km"><?php echo $fetch_cart['km']; ?> km</div>
   <form action="" method="post">
      <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
      <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
      <input type="submit" name="update_cart" value="Modifier" class="delete-btn"> 
         </form>
         <div class="sub-total">Sous-total de :<span><?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['prix']); ?> €</span></div>

         </div>
   <?php
   $grand_total += $sub_total;
   }
}else{
   echo '<p class="empty">Votre panier est vide</p>';
}
?>
</div>

<div style="margin-top: 2rem; text-align:center;">
   <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>"
    onclick="return confirm('Supprimer tous les articles du panier ?');">Supprimer tous</a>
   </div>

   <div class="cart-total">
      <p>Total : <span>$<?php echo $grand_total; ?> €</span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">Poursuivre les achats</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Procéder à la vérification</a>
      </div>
   </div>


</section>








<?php include('footer.php')?>




 <!-- js dossier admin -->
 <script src="Garage Parrot/js/script.js"></script>


</body>
</html>