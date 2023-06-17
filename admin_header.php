<?php

include('config.php');

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Garage<span>Parrot</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Accueil</a>
         <a href="admin_products.php">Services</a>
         <a href="admin_orders.php">Commande</a>
         <a href="admin_users.php">Utilisateurs</a>
         <a href="admin_contacts.php">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
    
         <p>Nom : <span><?php echo $_SESSION['name']; ?></span></p>
         <p>Adresse email : <span><?php echo $_SESSION['email']; ?></span></p>
             <a href="logout.php" class="delete-btn">Déconnexion</a>
    
 </div>
</div>

</header>
