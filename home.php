<?php 

include ('config.php');

session_start();

$user_id = $_SESSION['user_id'];



if(isset($_POST['add_to_cart'])){

   $product_marque = $_POST['product_marque'];
   $product_prix = $_POST['product_prix'];
   $product_quantity = $_POST['product_quantity'];
   $product_image = $_POST['product_image'];
   $product_annee = $_POST['product_annee'];
   $product_km = $_POST['product_km'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE  '$product_marque' AND user_id = '$user_id'")
   or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Déjà ajouté au panier !';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, marque, prix, quantity, image, annee, km)
      VALUES('$user_id', '$product_marque',  '$product_prix', '$product_quantity', '$product_image', '$product_annee', '$product_km')")
      or die('query failed');
      $message[] = 'Produit ajouté au panier !';
   }

}

if(!isset($user_id)){
   header('location:login.php');

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prix'], $_POST['km'], $_POST['annee'])) {
   $_SESSION['filters'] = array(
      'prix' => $_POST['prix'],
      'km' => $_POST['km'],
      'annee' => $_POST['annee']
   );
}
// Utilisez les valeurs des filtres stockées dans la session
$prix = isset($_SESSION['filters']['prix']) ? $_SESSION['filters']['prix'] : '';
$km = isset($_SESSION['filters']['km']) ? $_SESSION['filters']['km'] : '';
$annee = isset($_SESSION['filters']['annee']) ? $_SESSION['filters']['annee'] : '';


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

   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>
<body>

<?php include('header.php'); ?>

   
<section class="home">
   <div class="content">
<h3>Garage Parrot</h3>
<p>Le meilleur garage de la région</p>
<a href="about.php" class="white-btn">En savoir plus</a>
   </div>
</section>

<!--Filtres-->

<form id="filter-form"  method="POST">
   <label for="prix">Fourchette de prix :</label>
   <input type="range" id="prix" name="prix" min="0" max="100000" step="1000">
   <span id="price-value">0 €</span>

   <label for="km">Distance parcourue (km) :</label>
   <input type="range" id="km" name="km" min="0" max="200000" step="5000">
   <span id="km-value">0 km</span>

   <label for="annee">Année de mise en circulation :</label>
   <input type="range" id="annee" name="annee" min="1990" max="2023" step="1">
 

   <input type="submit" value="Filtrer" class="btn" id="filter-btn">

   <div class="resultats-container">
  <!-- Les résultats filtrés seront affichés ici -->
  <?php include ('resultats.php');?>
</div>
</form>



<div class="box-container">


<section class="products">

   <h1 class="title">La liste des véhicules les plus récents</h1>
   <div class="box-container">

<?php
      $select_products = mysqli_query($conn, "SELECT * FROM `automobiles` LIMIT 6") or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
      while ($fetch_products = mysqli_fetch_assoc($select_products)) {
?>
<form action="" method="post" class="box">
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
      } else {
            echo '<p class="empty">Aucun véhicule n\'a encore été ajouté</p>';
      }
   ?>
   </div>
   <div class="load-more" style="margin-top: 2rem; text-align:center">
   <a href="shop.php" class="option-btn">Charger plus</a>
   </div>
</section>

<section class="about">
   <div class="flex">
   <div class="image">
   <img src="Garage Parrot/images/about-img.jpg" alt="">
</div>

<div class="content">
   <h3>À propos de nous</h3>
   <p>Installer depuis 2003 à Nantes, l’équipe du Garage Parrot vous accueille et vous conseille.</p>
   <a href="about.php" class="btn">Lire la suite</a>
      </div>
   </div>
</section>

<section class="home-contact">

<div class="content">
   <h3>Avez-vous des questions ?</3>
   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
   <a href="contact.php" class="white-btn">Contacter-nous</a>
</div>

</section>


<!-- ... le reste du code HTML ... -->

<script src="Garage Parrot/js/script.js"></script>
<script src="Garage Parrot/js/filter.js"></script>

<?php include ('footer.php') ;?>

</body>
</html>