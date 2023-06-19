<?php
include('config.php');


?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <title>Utilisateurs </title>

    <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
      <!--  css dossier admin -->

      <link rel="stylesheet" href="Garage Parrot/css/admin_style.css">
</head>
<body>

<?php include('admin_header.php'); ?>

<section class="users">

   <div class="box-container">
    <?php
        $select_users = mysqli_query($conn, "SELECT * FROM users") or die('query failed');
        while($fetch_users = mysqli_fetch_assoc($select_users)){
    ?>  
        <div class="box">
          <p> Nom : <span><?php echo $fetch_users['name']; ?></span> </p>
          <p> Adresse email : <span><?php echo $fetch_users['email']; ?></span> </p>
          <p>Le type d'utilisateur : <span><?php echo $fetch_users['user_type']; ?></span> </p>
          <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Supprimer cette commande?');"
     class="delete-btn">Supprimer</a>
    </div>
    <?php
    
       };
    
    ?>







 <!-- js dossier admin -->
   <script src="Garage Parrot/js/admin_script.js"></script>


</body>
</html>