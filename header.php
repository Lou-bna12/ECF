<?php
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
  <a href="home.php" class="logo">Garage V. Parrot</a>


<nav class="navbar">
    <a href="home.php">Accueil</a>
    <a href="about.php">À propos</a>
    <a href="shop.php">Nos services</a>
    <a href="contact.php">Contacter-nous</a>
    <a href="orders.php">Commandes</a>

</nav>

<div class="icons">
   <div id="menu-btn" class="fas fa-bars"></div>
   <a href="search_page.php" class="fas fa-search"></a>
   <div id="user-btn" class="fas fa-user"></div>
   <?php
        $select_cart_number = mysqli_query($conn, "SELECT * FROM cart WHERE user_id ='name'") or die('query failed');
        $cart_rows_number = mysqli_num_rows($select_cart_number);
     ?>
   <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_rows_number; ?>)</span></a>
</div>
<div class="user-box">
  <p>Prénom :<span><?php echo $_SESSION['name'];  ?></span> </p>
   <p>Adresse email : <span><?php echo $_SESSION['email']; ?></span> </p>
  <a href="logout.php" class="delete-btn">Déconnexion</a>
</div>


</div> 

</div>
</div>

</header>