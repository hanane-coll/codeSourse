<?php

    $bdd = new PDO('mysql:host=localhost;dbname=gestion_compte','root','');
    $stmt = $bdd->prepare('SELECT * FROM Utilisateur');
    $stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>

<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<?php if(isset($_GET['m']) AND !empty($_GET['m'])){
    $recherche = htmlspecialchars($_GET['m']);
    $stmt = $bdd->query('SELECT * FROM Utilisateur WHERE cin
                                LIKE "%'.$recherche.'%" ');
}
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">   
                <div class="input-group">
                    <input class="form-control" name="m" type="text" placeholder="CIN" aria-label="Login" aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
</nav>
<hr>

<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                <th><span>Photo</span></th>
                                <th><span>nom</span></th>
                                <th><span>prenom</span></th>
                                <th ><span>cin</span></th>
                                <th><span>email</span></th>
                                <th><span>telephone</span></th>
                                <th><span>nomArabe</span></th>
                                <th><span>prenomArabe</span></th>
                                
                                <th><span>Operations</span></th>
                                <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = $stmt->fetch()) {?>
                                
                                <tr>
                                    <td>
                                        <img src="<?php echo $data["photo"]?>" alt="">
                                        
                                    </td>
                                    <td><?php echo $data["nom"]?></a></td>
                                    <td><?php echo $data["prenom"]?></a></td>
                                    
                                    <td><?php echo $data["cin"]?></td>
            
                                    <td>
                                        <a><?php echo $data["email"]?></a>
                                    </td>
                                    <td>
                                        <a><?php echo $data["telephone"]?></a>
                                    </td>
                                    <td>
                                        <a><?php echo $data["nomArabe"]?></a>
                                    </td>
                                    <td>
                                        <a><?php echo $data["prenomArabe"]?></a>
                                    </td>
                                    <td style="width: 20%;">
                                        
                                        <a href="formAjouter.php?idUtilisateur= <?php echo $data['idUtilisateur']?> " class="table-link text-info">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                        
                                    </td>
                                </tr>
                                
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

</body>
</html>