<?php

include ('config.php');

session_start();

$user_id = $_SESSION['name'];

if(!isset($user_id)){
  header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_marque = $_POST['product_marque'];
   $product_prix = $_POST['product_prix'];
   $product_quantity = $_POST['product_quantity'];
   $product_image = $_POST['product_image'];
   $product_annee = $_POST['product_annee'];
   $product_km = $_POST['product_km'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE  '$product_marque' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Déjà ajouté au panier !';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, marque, prix, quantity, image, annee, km) VALUES('$user_id', '$product_marque',  '$product_prix', '$product_quantity', '$product_image', '$product_annee', '$product_km')") or die('query failed');
      $message[] = 'Produit ajouté au panier !';
   }

}



?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Accueil</title>

      <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
   <!--  css dossier admin -->

   <link rel="stylesheet" href="Garage Parrot/css/style.css">
</head>
<body>

<?php include('header.php'); ?>
   
<section class="home">
   <div class="content">
<h3>Garage Parrot</h3>
<p>
   Le meilleur garage de la région
</p>
<a href="about.php" class="white-btn">En savoir plus</a>
   </div>
</section>

<section class="products">
 <div class="box-container">

 <?php
      $select_products = mysqli_query($conn, "SELECT * FROM automobiles LIMIT 4") or die('query failed');
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<form action="" method="post"class="box">
<img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
<div class="marque"><?php echo $fetch_products['marque']; ?></div>
<div class="prix"><?php echo $fetch_products['prix']; ?> €</div>
<input type="number" min="1" name="product_quantity"value="1" class="qty">

<div class="km"><?php echo $fetch_products['km']; ?> km</div>
<div class="annee"><?php echo $fetch_products['annee']; ?></div>
<input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
<input type="hidden" name="product_marque" value="<?php echo $fetch_products['marque']; ?>">
<input type="hidden" name="product_prix" value="<?php echo $fetch_products['prix']; ?>">
<input type="hidden" name="product_km" value="<?php echo $fetch_products['km']; ?>">
<input type="hidden" name="product_annee" value="<?php echo $fetch_products['annee']; ?>">
<input type="submit" value="Ajouter au panier" name="add_to_cart" class="btn">

         </form>

<?php

}
}else{
   echo '<p class="empty">Aucun véhicule n\'a encore été ajouté</p>';
}

?>

 </div>
</section>










<?php include('footer.php')?>




 <!-- js dossier admin -->
 <script src="Garage Parrot/js/script.js"></script>


</body>
</html>