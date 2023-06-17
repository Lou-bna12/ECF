<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['name'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = "Statut de paiement mis à jour avec succès!";

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <title>Les commandes </title>

    <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
      <!--  css dossier admin -->

      <link rel="stylesheet" href="Garage Parrot/css/admin_style.css">
</head>
<body>


<?php include('admin_header.php'); ?>

<section class="orders">

  <h1 class="title">Les commandes passées</h1>

  <div class="box-container">

<?php
$select_orders = mysqli_query($conn, "SELECT * FROM orders ") or die(mysqli_error($conn));
 
if(mysqli_num_rows($select_orders) > 0){
        while($fetch_orders = mysqli_fetch_assoc($select_orders)){
 ?>
<div class="box">
  
  <p> Utilisateur id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
  <p> date de réservation : <span><?php echo $fetch_orders['placed_on']; ?></span></p>
  <p> Nom et prénom : <span><?php echo $fetch_orders['name']; ?></span></p>
  <p> Téléphone : <span><?php echo $fetch_orders['number']; ?></span></p>
  <p> Adresse email : <span><?php echo $fetch_orders['email']; ?></span></p>
  <p> Adresse : <span><?php echo $fetch_orders['address']; ?></span></p>
  <p> Total de commandes : <span><?php echo $fetch_orders['total_products']; ?></span></p>
  <p> prix total : <span><?php echo $fetch_orders['total_price']; ?></span>/-</p>
  <p> Paiement : <span><?php echo $fetch_orders['method']; ?></span></p>
<form action="" method="post">
    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
    <select name="update_payment">
        <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
        <option value="pendding">En attente</option>
        <option value="completed">Terminé</option>
    </select>
    <input type="submit" value="Mettre à jour" name="update_order" class="option-btn">
    <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Supprimer cette commande?');"
     class="delete-btn">Supprimer</a>
    </form>
   </div>
   <?php
        }
     }else{
        echo '<p class="empty">Aucune commande passée</p>';
    }
    ?>
</div>
    
</section>


 <!-- js dossier admin -->

   <script src="Garage Parrot/js/admin_script.js"></script>


</body>
</html>