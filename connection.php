<?php
header('location: index.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

try{
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_compte','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['idUtilisateur'])) {
    
    $idUtilisateur = $_POST['idUtilisateur'];
    $role=$_POST['role'];
    $login=$_POST['login'];
    $password=$_POST['password'];
    
    $stmt=$bdd->prepare('SELECT * FROM Utilisateur WHERE idUtilisateur = '.$idUtilisateur.'');
    $stmt->execute();
    while ($data=$stmt->fetch()) {
        $email=$data['email'];
        $photo=$data['photo'];
    
        $statement=$bdd->prepare('INSERT INTO Compte (idRole,idUtilisateur,login,password,afficheEmail,affichePhoto) VALUES (:role,:idUtilisateur,:login,:password,:email,:photo)');
        $statement->execute(array(':role'=>$role,':idUtilisateur'=>$idUtilisateur ,':login'=>$login,':password'=>$password,':email'=>$email,':photo'=>$photo));
    }
}   
}catch (Exception $ex) {
    echo $ex;
}






?>