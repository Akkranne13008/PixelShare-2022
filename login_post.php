
<?php
session_start();
if(isset($_POST['pseudo']) && isset($_POST['password']))
{
   $hote = 'mysql-pixelshare.alwaysdata.net';
   $utilisateur = '288616';
   $mdp = '';
   $nombdd = 'pixelshare_bdd';
   $bdd = new PDO("mysql:host=$hote;dbname=$nombdd", $utilisateur, $mdp);
         
      $pseudo = $_POST['pseudo']; 
      $password = $_POST['password'];



      $ciphering = "AES-128-CTR";    


      $options = 0;
      
      $iv = '1234567891011121';
          
      $key= "solaria";
      
      $encryption_pseudo = openssl_encrypt($pseudo, $ciphering, $key, $options, $iv);
      $encryption_password = openssl_encrypt($password, $ciphering, $key, $options, $iv);
      
         if($encryption_pseudo !== "" && $encryption_password !== ""){
         $requete = $bdd -> prepare("SELECT count(*), id FROM utilisateur where Pseudo = ? AND MotDePasse = ?");
         $requete->bindParam(1, $encryption_pseudo);
         $requete->bindParam(2, $encryption_password);

         $requete->execute();
         $reponse = $requete->fetch(PDO::FETCH_ASSOC);
         $count = $reponse['count(*)'];
         if($count!=0) 
         {  
            $_SESSION['pseudo'] = $encryption;
            $_SESSION['id'] = $reponse['id'];
            $_SESSION['acces'] = 1;
            header('Location: index.php');
         }
         else
         {
            header('Location: login.php');
         }
      }
   }
else
{
   header('Location: login.php');
}
?>
