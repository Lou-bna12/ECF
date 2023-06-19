<?php

include('config.php');

    session_start();

    $admin_id = $_SESSION['name'];

    if(!isset($admin_id)){
        header("Location:login.php");
    };
    if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM `messages` WHERE id = '$delete_id'") or die('query failed');
      header('location:admin_contacts.php');
   }


?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <title>Messages </title>

    <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
      <!--  css dossier admin -->

      <link rel="stylesheet" href="Garage Parrot/css/admin_style.css">

</head>
<body>

<?php include('admin_header.php'); ?>

<section class="messages">
   <h1 class="title"> messages<h1>
   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `messages`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
    <div class="box">
      <p> Identifiant : <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> Nom et prénom : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> Numéro de téléphone : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> Adresse-email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> Message : <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Supprimer ce message?');" class="delete-btn">Supprimer le message</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">Vous n\'avez pas de messages !</p>';
   }
   ?>
   </div>



</section>









 <!-- js dossier admin -->
   <script src="Garage Parrot/js/admin_script.js"></script>


</body>
</html>