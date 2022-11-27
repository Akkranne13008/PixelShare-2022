<?php
   $hote = 'mysql-pixelshare.alwaysdata.net';
   $utilisateur = '288616';
   $mdp = '';
   $nombdd = 'pixelshare_bdd';
   $bdd = new PDO("mysql:host=$hote;dbname=$nombdd", $utilisateur, $mdp);
   
      $query = $bdd->exec("UPDATE Dessin SET Note = Note - 1 WHERE ID_Dessin=".$_GET["like"]);
      header('Location: index.php#'.$_GET["like"]);
?>