<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=gestion_compte','root','');
$stmt = $bdd->prepare('SELECT * FROM Etudiant');
$stmt->execute();

//recherche etudiant
if(isset($_GET['e']) AND !empty($_GET['e'])){
    $recherche = htmlspecialchars($_GET['e']);
    $stmt = $bdd->query('SELECT idUtilisateur FROM Etudiant WHERE cne
                                LIKE "%'.$recherche.'%" ');
    while ($data = $stmt->fetch()) {
      $id = $data['idUtilisateur'];
}
}?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">   
                <div class="input-group">
                    <input class="form-control" name="e" type="text" placeholder="CNE" aria-label="Login" aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
</nav>
<?php


if (isset($_POST)) {
    echo '<table class="container mt-5 table table-striped table-hover table-sm table-sm container-fluid">';
    echo '<tr>
        <td>nom</td>
        <td>prenom</td>
        <td>cin</td>
        <td>email</td>
        <td>telephone</td>
        <td>nomArabe</td>
        <td>prenomArabe</td>
        <td>photo</td>
        <td align="center" >Opérations</td>
    </tr>';

    $stmt = $bdd->query('SELECT * FROM Utilisateur WHERE idUtilisateur LIKE "%'.$id.'%"');
    while ($data = $stmt->fetch()) {
        $Ajouter = '<a class = "btn btn-danger" name="Ajouter" href="formAjouter.php?idUtilisateur=' . $data['idUtilisateur'] .'" > Ajouter </a>';
        echo '<tr><td>' . $data['nom'] . '</td><td>' . $data['prenom'] .'</td><td>' . $data['cin'] . '</td><td>' . $data['email'] . '</td><td>' .$data['telephone'] .'</td><td>'.$data['nomArabe'] .'</td><td>'.$data['prenomArabe'] .'</td><td><img src="'.$data['photo'] .'" style="width:50px;height:50px;"</td><td>'. $Ajouter .'</td><tr>';
    }
    $bdd->commit();
    echo '</table>';
    echo '</div>';
}

?>

    
</body>
</html>