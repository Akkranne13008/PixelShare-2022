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
    $sql = "select Pseudo from utilisateur"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet">
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
		<?php
if(!isset($_SESSION['id'])) {
	echo '<li><a href="login.php">Connexion</a></li>
        <li><a href="signup.php">Inscription</a></li>
		</ul>
		</div>
	  </nav>';

} else { 
	echo' 
  <li><a href="checkprofil.php">Mes Postes</a></li>
  <li><a href="profil.php">'. $reponse['Pseudo'] . '</a></li>
		  <li><a href="logout.php">Deconnexion</a></li>
	</div>
  </nav>';

}
?> 



</header>
<body>


<?php 

$mysqli = new mysqli("mysql-pixelshare.alwaysdata.net", "288616", "", "pixelshare_bdd");
$mysqli->set_charset("utf8");
$requete = 'SELECT * FROM Dessin ORDER BY Note DESC';
$resultat = $mysqli->query($requete);
$reponseimage = $resultat->fetch_assoc();




	while ($reponseimage = $resultat->fetch_assoc())
  {
      echo'
          <p>'. $reponseimage['ID_Dessin']. '</p>        
    ';
}
 
  
  ?>





    
</body>
</html>