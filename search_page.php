<?php

include ('config.php');

session_start();

$user_id = $_SESSION['name'];

if(!isset($user_id)){
  header('location:login.php');
};
if(isset($_POST['add_to_cart'])){

   $products_marque = $_POST['products_marque'];
   $products_prix = $_POST['products_prix'];
   $products_quantity = $_POST['products_quantity'];
   $products_image = $_POST['products_image'];
   $products_annee = $_POST['products_annee'];
   $products_km = $_POST['products_km'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE  '$products_marque' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Déjà ajouté au panier !';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, marque, prix, quantity, image, annee, km) VALUES('$user_id', '$products_marque',  '$products_prix', '$products_quantity', '$products_image', '$products_annee', '$products_km')") or die('query failed');
      $message[] = 'Produit ajouté au panier !';
   }

}

?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Page de recherche</title>

      <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
   <!--  css dossier admin -->

   <link rel="stylesheet" href="Garage Parrot/css/style.css">
</head>
<body>

<?php include('header.php'); ?>
  <div class="heading">
   <h3>Page de recherche</h3>
   <p> <a href="hpme.php">Accueil</a> / Rechercher </p>
</div>

<section class="search-form">
<form action="" method="post">
  <input type="text" name="search" placeholder="Recherche de véhicules..." class="box">
   <input type="submit" name="submit" value="Recherche" class="btn">
   </form>
</section>

<section class="product" style= "padding-top: 0;">

<div class="box-container">
<?php

if(isset($_POST['submit'])){
      $search_itm = $_POST['search'];
      $select_products = mysqli_query($conn, "SELECT * FROM automobiles WHERE marque LIKE '%{$search_itm}%'") or die('query failed');
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_products = mysqli_fetch_assoc($select_products)){
   
?>
<form action="" method="post"class="box">
<img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
<div class="marque"><?php echo $fetch_products['marque']; ?></div>
<div class="prix"><?php echo $fetch_products['prix']; ?> €</div>
<input type="number" min="1" name="products_quantity"value="1" class="qty">

<div class="km"><?php echo $fetch_products['km']; ?> km</div>
<div class="annee"><?php echo $fetch_products['annee']; ?></div>
<input type="hidden" name="products_image" value="<?php echo $fetch_products['image']; ?>">
<input type="hidden" name="products_marque" value="<?php echo $fetch_products['marque']; ?>">
<input type="hidden" name="products_prix" value="<?php echo $fetch_products['prix']; ?>">
<input type="hidden" name="products_km" value="<?php echo $fetch_products['km']; ?>">
<input type="hidden" name="products_annee" value="<?php echo $fetch_products['annee']; ?>">
<input type="submit" value="Ajouter au panier" name="add_to_cart" class="btn">
</form>
<?php

      }
   }else{
      echo '<p class="empty">Aucun résultat</p>';
   }
   }else{
   echo '<p class="empty">Cherchez quelque chose !</p>';
      }

   ?>
   </div>


</section>








<?php include('footer.php')?>




 <!-- js dossier admin -->
 <script src="Garage Parrot/js/script.js"></script>


</body>
</html>