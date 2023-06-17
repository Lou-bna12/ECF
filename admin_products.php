<?php

include('config.php');

    session_start();

    $admin_id = $_SESSION['name'];

    if(!isset($admin_id)){
        header("Location:login.php");
    };

  if(isset($_POST['add_product'])){
    
    $imma = mysqli_real_escape_string($conn, $_POST['imma']);
    $marque = mysqli_real_escape_string($conn, $_POST['marque']);
    $prix = mysqli_real_escape_string($conn, $_POST['prix']);
    $annee = mysqli_real_escape_string($conn, $_POST['annee']);
    $km = mysqli_real_escape_string($conn, $_POST['km']);
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = "uploaded_img/".$image;
    

    $select_product_name  = mysqli_query($conn, "SELECT * FROM automobiles WHERE imma = '$imma'");

    if(mysqli_num_rows($select_product_name) > 0){
        $messgae[] = "Ce véhicule existe déjà";
    }else{
        $add_product_query = mysqli_query($conn, "INSERT INTO automobiles (imma, marque, prix, annee, km, image) VALUES ('$imma', '$marque', '$prix', '$annee', '$km', '$image')");

        if($add_product_query){   
            if($image_size > 2000000){
                $message[] = "La taille de l'image est trop grande";
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = "Véhicule ajouté avec succès";
            }
        }else{
            $message[] = "Erreur lors de l'ajout du véhicule";
      }
     }
    }
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM automobiles WHERE imma = '$delete_id'") or die(mysqli_error($conn));
    header("Location:admin_products.php");
}

if(isset($_POST['update_product'])){
    $update_p_imma  = $_POST['update_p_imma'];
    $update_marque = $_POST['update_marque'];
    $update_prix = $_POST['update_prix'];
    $update_annee = $_POST['update_annee'];
    $update_km = $_POST['update_km'];
    $update_image = $_FILES['update_image']['name'];

 mysqli_query($conn, "UPDATE automobiles SET imma = '$update_p_imma', prix = '$update_prix', annee = '$update_annee', km = '$update_km' WHERE imma = '$update_p_imma'") or die(mysqli_error($conn));

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = "uploaded_img/".$update_image;
    $update_old_image = $_POST['update_old_image'];

    if(!empty($update_image)){
        if($update_image_size > 2000000){
            $message[] = "La taille de l'image est trop grande";
        }else{
           mysqli_query($conn, "UPDATE automobiles SET image = '$update_image' WHERE imma = '$update_p_imma'") or die(mysqli_error($conn));
           move_uploaded_file($update_image_tmp_name, $update_folder);
              unlink("uploaded_img/".$update_old_image);
        }
    }
    
    header("Location:admin_products.php");

}


?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     <title>Véhicules d'occassion </title>

    <!-- font awesome -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   
      <!--  css dossier admin -->

      <link rel="stylesheet" href="Garage Parrot/css/admin_style.css">
</head>
<body>

<?php include('admin_header.php'); ?>
  
<!-----section start----->

<section class="add-products">

<h1 class="title">Notre colection de voitures </h1>

    <form action="" method="post" enctype="multipart/form-data">
        <h3>Ajouter ou modifier une voiture</h3>

        <input type="text"  name="imma" placeholder="L'immatriculation de la voiture" class="box" required>
        <input type="text"  name="marque" placeholder="La marque de la voiture" class="box" required>
        <input type="text"  name="prix" placeholder="Le prix de la voiture" class="box" required>
        <input type="text"  name="annee" placeholder="L'année de la voiture" class="box" required>
        <input type="text"  name="km" placeholder="Le kilométrage de la voiture" class="box" required>
        <input type="file"  name="image"  class="box" required>
               
        <input type="submit" value="Ajouter un véhicule" name="add_product" class="btn">
 
    </form>

</section>
<section class="show-products">

<div class="box-container">

    <?php
        $select_products = mysqli_query($conn, "SELECT * FROM automobiles") or die(mysqli_error($conn)); 
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
    <div class="box">
        <img src = "uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="product-img">

        <div class="image"><?php echo $fetch_products['image']; ?></div>
        <div class="marque">Marque: <?php echo $fetch_products['marque']; ?></div>
        <div class="imma">Immatriculation: <?php echo $fetch_products['imma']; ?></div>
        <div class="prix">Prix: <?php echo $fetch_products['prix']; ?> €</div>
        <a href="admin_products.php?update=<?php echo $fetch_products['imma']; ?>" class="option-btn" onclick="return confirm('Vous voulez vraiment modifier les informations de cette voiture?')">Modifier</a>
        <a href="admin_products.php?delete=<?php echo $fetch_products['imma']; ?>" class="delete-btn" onclick="return confirm('Supprimer cette voiture?')">Supprimer</a>
        <div class="annee">Année: <?php echo $fetch_products['annee']; ?></div>
        <div class="km">kilométrage: <?php echo $fetch_products['km']; ?> km</div>

    </div>
    <?php

           }
        }else{
            echo '<p class="empty">Aucun véhicule trouvé... </p>';
        }
    ?>     
   </div>

</section>

<section class="edit-product-form">
    <?php
        if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM automobiles WHERE imma = '$update_id'") or die(mysqli_error($conn));
            if(mysqli_num_rows($update_query) > 0){
                while($fetch_update = mysqli_fetch_assoc($update_query)){
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="update_p_imma" value="<?php echo $fetch_update['imma']; ?>">
        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
        <img src = "uploaded_img/<?php echo $fetch_update['image']; ?>" alt="" class="product-img">
        <input type="text"   name="update_prix" value="<?php echo $fetch_update['prix']; ?>" class="box" required placeholder="Le prix de la voiture">
        <input type="text"   name="update_annee" value="<?php echo $fetch_update['annee']; ?>" class="box" required placeholder="L'année de la voiture">
        <input type="text"   name="update_km" value="<?php echo $fetch_update['km']; ?>" class="box" required placeholder="Le kilométrage de la voiture" >
        <input type="text"   name="update_marque" value="<?php echo $fetch_update['marque']; ?>" class="box" required placeholder="La marque de la voiture">
        <input type="file"   name="update_image" accept="image/jpg, image/jpeg, image/png">
        <input type="submit" value="Modifier" name="update_product" class="option-btn">
        <input type="reset" value="Annuler"   id="close-update" class="delete-btn">
    </form> 
        <?php
          }
        }
        }else{
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        } 
        ?>   
              
</section>


 <!-- js dossier admin -->

   <script src="Garage Parrot/js/admin_script.js">

   </script>
  


</body>
</html>