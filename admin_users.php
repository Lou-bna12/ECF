<?php
include('config.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
header('location:login.php');
}

if(isset($_GET['delete'])){
$delete_id = $_GET['delete'];
mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") 
or die('query failed');
   header("Location:admin_users.php");
}

?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

   <title>Utilisateurs </title>

      <!--JQuery-->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

      <!-- font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

      <!--  css dossier admin -->

   <link rel="stylesheet" href="Garage Parrot/css/admin_style.css">


</head>
<body>

<?php include('admin_header.php'); ?>

<section class="users">

   <h1 class="title"> Comptes utilisateurs </h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> Identifiant : <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> Nom : <span><?php echo $fetch_users['name']; ?></span> </p>
         <p>Adresse email : <span><?php echo $fetch_users['email']; ?></span> </p>
         <p>Type d'utilisateur: <span style="color:<?php if($fetch_users['user_type'] == 'admin')
         { echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>
         " onclick="return confirm('Supprimer cet utilisateur?');" class="delete-btn">Supprimer l'utilisateur</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>







 <!-- js dossier admin -->
   <script src="Garage Parrot/js/admin_script.js"></script>


</body>
</html>