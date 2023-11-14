<?php 
include 'config.php';



session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:home.php');

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!--  css dossier admin -->

    <link rel="stylesheet" href="Garage Parrot/css/style.css">
</head>
<body>
    <!-- Barre de Navigation -->
<header class="header">
<div class="header-1">
    <div class="flex">
    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
    </div>
    <p> Nouvelle  <a href="login.php">Connexion</a> | <a href="register.php">Inscrivez-vous</a> </p>
</div>
</div>  

    <div class="header-2">
    <div class="flex">
    <a href="index.php" class="logo">Garage V. Parrot</a>


<nav class="navbar">
    <a href="index.php">Accueil</a>
    <a href="about.php">À propos</a>
    <a href="shop.php">Nos services</a>
    <a href="contact.php">Contacter-nous</a>
    <a href="orders.php">Commandes</a>
</nav>
</div>
</div>

<div class="heading">
<h3>Accueil</h3>
<p><a href="index.php">Véhicules</a> / Nos services</p>
</header> 
<section class="products">
<h1 class="title">La liste des véhicules les plus récents</h1>

<div class="box-container">

   

<?php
   $select_products = mysqli_query($conn, "SELECT * FROM `automobiles` LIMIT 6") or die('query failed');
   if(mysqli_num_rows($select_products) > 0){
   while($fetch_products = mysqli_fetch_assoc($select_products)){
?>

<form action="" method="post"class="box">
   <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
   <div class="marque"><?php echo $fetch_products['marque']; ?></div>
   <div class="prix"><?php echo $fetch_products['prix']; ?> €</div>
   <input type="number" min="1" max="15" name="product_quantity"value="1" class="qty">
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



<!-- js dossier admin -->
<script src="Garage Parrot/js/script.js"></script>




<?php include('footer.php')?>
</body>
</html>



