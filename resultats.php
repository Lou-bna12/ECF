<?php
include('config.php');

// Assurrant nous que la connexion à la base de données est établie
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

$prix = isset($_POST['prix']) ? $_POST['prix'] : null;
$km = isset($_POST['km']) ? $_POST['km'] : null;
$annee = isset($_POST['annee']) ? $_POST['annee'] : null;

$query = "SELECT * FROM `automobiles` WHERE 1";

if ($prix !== null) {
   $query .= " AND prix <= $prix";
}

if ($km !== null) {
   $query .= " AND km <= $km";
}

if ($annee !== null) {
   $query .= " AND annee >= $annee";
}

$result = mysqli_query($conn, $query);

// Vérification si la requête a réussi
if ($result) {
   if (mysqli_num_rows($result) > 0) {
   while ($row = mysqli_fetch_assoc($result)) {
          // Affichez les résultats ici
         echo '<div>' . $row['marque'] . ' - Prix: ' . $row['prix'] . ' - Kilomètres: ' . $row['km'] . ' - Année: ' . $row['annee'] . '</div>';
}
} else {
      echo 'Aucun résultat trouvé.';
   }

    // Ferméture de  la connexion à la base de données après avoir récupéré les résultats
   mysqli_free_result($result);
} else {
    // Gérez l'erreur de la requête
   echo 'Erreur dans la requête : ' . mysqli_error($conn);
}

?>
