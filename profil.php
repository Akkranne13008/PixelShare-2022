<?php
session_start();
$hote = 'mysql-pixelshare.alwaysdata.net';
$utilisateur = '288616';
$mdp = '';
$nombdd = 'pixelshare_bdd';
$bdd = new PDO("mysql:host=$hote;dbname=$nombdd", $utilisateur, $mdp);


    $requete = $bdd->prepare('SELECT * FROM utilisateur WHERE id = '.$_SESSION['id']);
    $requete->execute();
    $reponse = $requete->fetch(PDO::FETCH_ASSOC);

    $requeteage = $bdd->prepare('SELECT YEAR(CURRENT_DATE()) - YEAR(Age) FROM utilisateur WHERE id = '.$_SESSION['id']);
    $requeteage->execute();
    $reponseage = $requeteage->fetch();

    $decrypt_pseudo = $reponse["Pseudo"];
    $decrypt_email = $reponse["Email"];

    $iv = '1234567891011121';
    
    
    $options = 0;
    
    $ciphering = "AES-128-CTR";    
    $key= "solaria";
            
    $decryption_pseudo = openssl_decrypt($decrypt_pseudo, $ciphering, $key, $options, $iv);
    $decryption_email = openssl_decrypt($decrypt_email, $ciphering, $key, $options, $iv);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="profil.css" rel="stylesheet" />
    <title>PixelShare - Acceuil</title>
 <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<header>

<nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">PixelShare</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
	  <li><a href="index.php">Acceuil</a></li>
        <li><a href="profil.php"><?php print_r($decryption_pseudo) ?></a></li>
        <li><a href="logout.php" > Deconnexion</a></li>
      </ul>
    </div>
  </nav>
</header>

<?php
if(!isset($_SESSION['id'])) {
header('location: index.php');

} else { 
$Pseudo = $_SESSION['id'];
}
?> 


 
<body>



<div class="col-lg-4 align-self-center">
                    <ul>
                      <li>Pseudo : <span><?php print_r($decryption_pseudo) ?></span></li>
                      <li>Email : <span><?php print_r($decryption_email) ?></span></li>
                      <li>Age : <span><?php  print_r($reponseage[0]);  ?> ans</span></li>
                      <li>Permission : <span><?php 
                      if($reponse['Permission'] == 0){
                        echo "Utilisateur";
                      }
                        elseif ($reponse['Permission'] == 1)
                        echo "Administrateur"; 
                    
                        ?></span></li>
                    </ul>


                    <?php 
                      if($reponse['Permission'] == 0){

                        echo '
                        <form action="annonce.php" method="post">
                        <label for="pseudo">Poster une annonce</label>
                        <input type="text" name="titre" id="titre" placeholder="titre">
                        <input type="file" name="fic" size=50 />
                        <input type="text" name="auteur" id="auteur" readonly  value="'. 
                        $decryption_pseudo . '" placeholder="auteur"  >  
                        <input type="submit" value="Enovoyer">
                        </form>';

                      }
                        elseif ($reponse['Permission'] == 1)
                        echo '
                        <form action="ban.php" method="post">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo">
                        <input type="submit" value="Bannir">
                        </form>
                        <form action="upgrade.php" method="post">
                        <label for="Pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo">
                        <input type="submit" value="Admin">
                        </form>
                        <form action="deleteannonce.php" method="post">
                        <label for="pseudo">Id annone</label>
                        <input type="text" name="pseudo" id="pseudo">
                        <input type="submit" value="Delete">
                        </form>
                        '
                        
                        ;
                  
                        ?>
    
</body>
</html>