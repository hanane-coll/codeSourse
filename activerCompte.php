<?php
header('location: CompteListe.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


    $bdd = new PDO('mysql:host=localhost;dbname=gestion_compte','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $idCompte=$_GET['idCompte'];
    $enabled=1;
    

    $stmt = $bdd->prepare('UPDATE Compte SET enabled = :en where idCompte = '.$idCompte.'');
    $stmt->execute(array('en' => $enabled));

?>