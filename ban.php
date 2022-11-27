
<?php
   $hote = 'mysql-pixelshare.alwaysdata.net';
   $utilisateur = '288616';
   $mdp = '';
   $nombdd = 'pixelshare_bdd';
   $bdd = new PDO("mysql:host=$hote;dbname=$nombdd", $utilisateur, $mdp);
         
      $pseudo = $_POST['pseudo']; 
      $query = $bdd->exec("DELETE FROM `utilisateur` WHERE `Pseudo` = '$pseudo'");
      header('Location: profil.php');
?>