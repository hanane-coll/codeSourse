<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php

$bdd = new PDO('mysql:host=localhost;dbname=gestion_compte','root','');
$stmt = $bdd->prepare('SELECT * FROM Compte');
$stmt->execute();


if(isset($_GET['m']) AND !empty($_GET['m'])){
    $recherche = htmlspecialchars($_GET['m']);
    $stmt = $bdd->query('SELECT * FROM Compte WHERE login
                                LIKE "%'.$recherche.'%" ');
}
echo'<div class="container-fluid">';
echo'<form method="GET">
<div class="md-form mt-0">
        <div class="row">
            <div class="col-sm">
                <input  type="text" placeholder="Recherche par login" name="m">
                <input class="btn btn-primary" type="submit" value="Submit" />
            </div>
        </div>    
</form>';


echo '<table class="container mt-5 table table-striped table-hover table-sm table-sm container-fluid">';
echo '<tr>
        <td>login</td>
        <td>email</td>
        <td>password</td>
        <td>photo</td>
        <td>etat de compte</td>
        <td>Opérations</td>
    </tr>';


while ($data = $stmt->fetch()) {
    $linkModi = '<a class="btn btn-warning" name="modifier" href="UpdateCompte.php?idCompte=' . $data['idCompte'] . '"  > Modifier </a>';
    if ($data['enabled']==0) 
        $EtatCompte= '<button type="submit" value="activer"  class="btn btn-danger" href="activerCompte.php?idCompte=' . $data['idCompte'] .'">Enabled</button>';
    else 
        $EtatCompte= '<button type="submit" value="desactiver" class="btn btn-success" href="desactiveCompte.php?idCompte=' . $data['idCompte'] .'">En cours</button>';
   
    echo '<tr><td>' . $data['login'] . '</td><td>' . $data['afficheEmail'] .'</td><td>' . $data['password'] . '</td><td><img src="'.$data['affichePhoto'] .'" style="width:50px;height:50px;"</td><td>'. $EtatCompte .'</td><td>'. $linkModi .'</td><tr>';
}


echo '</table>';
echo '</div>';
?>

</body>
</html>