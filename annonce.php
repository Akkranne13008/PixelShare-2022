<?php
   $hote = 'mysql-pixelshare.alwaysdata.net';
   $utilisateur = '288616';
   $mdp = '';
   $nombdd = 'pixelshare_bdd';
   $bdd = new PDO("mysql:host=$hote;dbname=$nombdd", $utilisateur, $mdp);
   $requete = $bdd->prepare('SELECT * FROM utilisateur WHERE id = '.$_SESSION['id']);
   $requete->execute();
   $reponse = $requete->fetch(PDO::FETCH_ASSOC);     

      $titre=htmlspecialchars($_POST['titre']); 
      $image=htmlspecialchars($_POST['image']); 
      $auteur=htmlspecialchars($_POST['auteur']); 
      $insertUser=$bdd->prepare("INSERT INTO Dessin(Titre,Image,Auteur) VALUES (?,?,?)");
      $insertUser->bindParam(1, $titre);
      $insertUser->bindParam(2, $image);
      $insertUser->bindParam(3, $auteur);
      $insertUser->execute();
      header("Location: profil.php");
?>