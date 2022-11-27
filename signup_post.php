<?php
   $hote = 'mysql-pixelshare.alwaysdata.net';
   $utilisateur = '288616';
   $mdp = '';
   $nombdd = 'pixelshare_bdd';
   $bdd = new PDO("mysql:host=$hote;dbname=$nombdd", $utilisateur, $mdp);
         
        
if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
    $mail=htmlspecialchars($_POST['email']); 
    $password=htmlspecialchars($_POST['password']); 
    $age=htmlspecialchars($_POST['age']); 
    $pseudo=htmlspecialchars($_POST['pseudo']);

    $ciphering = "AES-128-CTR";    


$options = 0;

$iv = '1234567891011121';
    
$key= "solaria";

$encryption_pseudo = openssl_encrypt($pseudo, $ciphering, $key, $options, $iv);
$encryption_email = openssl_encrypt($mail, $ciphering, $key, $options, $iv);
$encryption_password = openssl_encrypt($password, $ciphering, $key, $options, $iv);


        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            echo "L'adresse e-mail est valide";
            header("Location: signup.php");
        }
        else {
            $insertUser=$bdd->prepare("INSERT INTO utilisateur (Pseudo,Email,Age,MotDePasse) VALUES (?, ?, ?, ?)");
            $insertUser->bindParam(1, $encryption_pseudo);
            $insertUser->bindParam(2, $encryption_email);
            $insertUser->bindParam(3, $age);
            $insertUser->bindParam(4, $encryption_password);
            $insertUser->execute();
            header("Location: login.php");
        }
}
else {
    header("Location: signup.php");
    echo "Problème lors de l'inscription";
}
?>