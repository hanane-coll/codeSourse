<?php
require_once('includes/functions.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id=null;
if (isset($_GET["idUtilisateur"])) {
    $user_id = $_GET['idUtilisateur'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</head>


<body class="bg-gradient-primary">

<div class="container">
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <div class="row">
        <img class="col-lg-5 d-none d-lg-block" src="https://images.pexels.com/photos/2102850/pexels-photo-2102850.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"></img>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Créer un compte</h1>
              </div>
<form method="post" enctype=”multipart/form-data” action="connection.php">
  
  <input type="hidden" id="idUtilisateur" name="idUtilisateur" value="<?php echo $user_id ?>">
  <form class="user">
  <div class="form-group ">

    <label for="role">Role</label>
    <select type="text"  class="form-control" name="role"  placeholder="Enter role">
          <?php
          
          try{
            $bdd = new PDO('mysql:host=localhost;dbname=gestion_compte','root','');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt=$bdd->prepare('SELECT * FROM Role');
            $stmt->execute();
            while($data=$stmt->fetch()){
              echo '<option value='.$data['idRole'].'>'.$data['nomRole'].'</option>';

            }

          }catch(Exception $e){
            echo $e->getMessage();
          }
          ?>
    </select>
  </div>


  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" name="login" placeholder="Entrer login" value="<?php 
    try{
      $bdd = new PDO('mysql:host=localhost;dbname=gestion_compte','root','');
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt=$bdd->prepare('SELECT * FROM Utilisateur WHERE idUtilisateur = '.$user_id.'');
      $stmt->execute();
      while($data=$stmt->fetch()){
        echo $data['nom'].$data['prenom'];
      }

    }catch(Exception $e){
      echo $e->getMessage();
    }
    ?>">

  </div>



  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" placeholder="Entrer mot de passe"class="form-control" id="password" name="password" value="<?php 
    echo hashPassword(generatePassword(10));
    ?>">
    
    <input type="checkbox" onclick="myFunction()">Afficher mot de passe
        <script>
        function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
        </script>
    </div>

  <button type="submit" class="btn btn-primary btn-user btn-block" href="connection.php>">Submit</button>
</form>

</body>

</html>