<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<?php


$user_id=null;
if (isset($_GET["idCompte"])) {
    $user_id = $_GET['idCompte'];
}


   if(!empty($_POST)){

        $login = $_POST['login'];
        $password = $_POST['password'];
        $user_id = $_POST['idCompte'];
        
  
           try {
            $bdd = new PDO('mysql:host=localhost;dbname=gestion_compte', 'root', '');
    
            $stmt = $bdd->prepare('UPDATE Compte SET idCompte=:idCompte,login=:login, password=:password WHERE idCompte=:idCompte');
           
            $stmt->execute(array(
            'idCompte'=> $user_id,
            'login'=> $login,
            'password'=> $password
        ));
           } catch (Exception $ex) {
               echo $ex;
           }
    
    }
    
if (isset($user_id)) {
  
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_compte', 'root', '');
    
    $sql = 'SELECT * FROM Compte WHERE idCompte='.$user_id;
    

    $result = $bdd->query($sql);
    $row = $result->fetch();

    $login = $row['login'];
    $password = $row['password'];
}
    
if(isset($_POST["update"])){
    //header('location: affichage.php');
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_compte', 'root', '');
    
    $sql = "SELECT * FROM Compte WHERE idCompte=".$_POST["idCompte"];
    
    
    $result = $bdd->query($sql);
    while ($row = $result->fetch()) {

        $login = $row['login'];
        $password = $row['password'];
        $user_id = $row['idCompte'];
    }
}

   ?>
        <h3>update Compte</h3>
        <form method="post"  >
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="login">login</label>
                    <input type="text" name="login" class="form-control" value="<?php echo $login ;?>" placeholder="login" required>

                    <input type="hidden" name="idCompte" class="form-control" value="<?php echo $user_id ;?>" >
                </div>
            
                <div class="form-group col-md-6">
                    <label for="password">password</label>
                    <input type="text" name="password" class="form-control" value="<?php echo $password ;?>" placeholder="password" required>
                </div>
            </div>
                <br>
            <button type="reset" name="annuler" class="btn btn-secondary" >Annuler</button>

			<button type="submit" name="update" class="btn btn-primary">Modifier</button>
        </form>

       


