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
    <link href="index.css" rel="stylesheet" />
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

$mysqli = new mysqli("mysql-pixelshare.alwaysdata.net", "288616", "62rzrWLzmvyh2FW", "pixelshare_bdd");
$mysqli->set_charset("utf8");
$requete = 'SELECT * FROM Dessin WHERE Auteur="' . $reponse['Pseudo']  .'" ORDER BY Note DESC';
$resultat = $mysqli->query($requete);

	while ($reponseimage = $resultat->fetch_assoc())

  {
echo'
<div class="row">
    <div class="col s3 offset-s3">
      <div class="card">
        <div class="card-image">
        <a id="'. $reponseimage['ID_Dessin']. '"></a>

          <img src="' . $reponseimage['Image'] . '">
          
          <form action="like.php?like='. $reponseimage['ID_Dessin']. '&cuser='.$_SESSION['id'].'" method="post">	
          <button class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">❤</button></a>
          </form>
         
  </div>




        <div class="card-content">
	<span class="card-title">' . $reponseimage['Titre'] . '</span>
<p>Auteur :  ' . $reponseimage['Auteur'] .'</p>
<p>Like : ' . $reponseimage['Note'] . '</p>
<p>ID : ' . $reponseimage['ID_Dessin'] . '</p>
        </div>
      </div>
    </div>
  </div>
  ';
  }
  
  ?>

<?php
if(!isset($_SESSION['id'])) {
header('location: index.php');

} else { 
$Pseudo = $_SESSION['id'];
}
?> 



    
</body>
</html>