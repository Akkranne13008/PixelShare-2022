<?php
session_start();
   $hote = 'mysql-pixelshare.alwaysdata.net';
   $utilisateur = '288616';
   $mdp = '';
   $nombdd = 'pixelshare_bdd';
   $bdd = new PDO("mysql:host=$hote;dbname=$nombdd", $utilisateur, $mdp);

    $like = $bdd->prepare('SELECT COUNT(Dessin_Like) FROM Vote WHERE User_Like = '.$_GET["cuser"].' AND Dessin_Like ='.$_GET["like"]);
    $like->execute();
    $countlikecoded = $like->fetch(PDO::FETCH_ASSOC);
    $verif = $countlikecoded["COUNT(Dessin_Like)"];

    if($verif == 0){

//requete pour créer un élément dans la table like qui contient l'id de lutilisatyeur actuel dans userlike et l'id du dessin dans Dessinlike

$query = $bdd->query('INSERT INTO Vote (Dessin_Like,User_Like) VALUES("' . $_GET["like"] .'", "' . $_GET["cuser"] .'")');
$query = $bdd->query('UPDATE Dessin SET Note = Note + 1 WHERE ID_Dessin=' .$_GET["like"]);


header('Location: index.php#'.$_GET["like"]);
}

else {
    
// requète pour détruire l'élément dans la table like qui contient l'id de lutilisatyeur actuel dans userlike et l'id du dessin dans Dessinlike
$query = $bdd->query('DELETE FROM Vote WHERE Dessin_Like=' .$_GET["like"] .' AND User_Like=' .$_GET["cuser"]);
header('Location: delike.php?like='.$_GET["like"]);
}

?>