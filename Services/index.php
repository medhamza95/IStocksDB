<?php
    $cnx = new mysqli("localhost","root","","IStocksDB") or die(mysqli_error($cnx));
    $tServices = $cnx->query("SELECT * FROM Services") or die(mysqli_error($cnx));
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<html>
    <head>
        <title></title>
    </head>
    <body>
    <?php 
        require_once("majServices.php");
    ?>
    
    <?php
    /* ------Affichage du message d'Alert------ */

        if(isset($_SESSION['message'])){?>
            <div class="alert alert-<?=$_SESSION['msg_type'] ?>" >
            <?php 
                echo($_SESSION['message']);
                unset($_SESSION['message']);
            ?>    
            </div>
    <?php }?>
    
    <!-- ------ Remplissage du tableau ------ -->
    <div class="container">
    <div class="row">
        <table class="table pt-80">
            <thead>
                <tr><th>Code Service</th><th>Code Entreprise</th><th>Code Collaborateur</th><th>Code Entreprise FK</th><th>Actions</th></tr>
            </thead>
            <?php
                while($row = $tServices->fetch_assoc()){?>
                    <tr>
                        <td><?php echo ($row["codeSrv"]) ?></td>
                        <td><?php echo ($row["codeEntrFK"]) ?></td>
                        <td><?php echo ($row["codeCDFK1"]) ?></td>
                        <td><?php echo ($row["codeCDFK2"]) ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo ($row['codeSrv']); ?>" class="btn btn-info">Edit</a>
                            <a href="majServices.php?delete=<?php echo ($row['codeSrv']); ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php }
            ?>
        </table>
    </div>

    <!-- ------ Les inputs ------ -->
    <div class="row">
        <form action="index.php" method="POST">
            <input type="hidden" name="codeS" value="<?php echo($codeSrv); ?>">
            <div class="form-group">
                <label>Code service :</label>
                <input type="text" name="codeSrv" class="form-control" value = "<?php echo ($codeSrv); ?>" <?php echo ($tbcodeSrv);?> placeholder="enter your server code!">
            </div>
            <div class="form-group"> 
                <label>Code entreprise :</label>
                <input type="text" name="codeEntrFK" class="form-control" value = "<?php echo ($codeEntrFK); ?>" placeholder="enter your entreprise code!">
            </div>
            <div class="form-group"> 
                <label>Code collaborateur :</label>
                <input type="text" name="codeCDFK1" class="form-control" value = "<?php echo ($codeCDFK1); ?>" placeholder="code collaborateur!">
            </div>
            <div class="form-group"> 
                <label>Code entreprise FK :</label>
                <input type="text" name="codeCDFK2" class="form-control" value = "<?php echo ($codeCDFK2); ?>" placeholder="code entreprise FK!">
            </div>
            <?php if($update == true){?>
                <div class="form-group"> 
                    <button type="submit" class="btn btn-info" name="Update">Update</button>
                </div>
            <?php }?>
            <?php if($update == false) {?>
                <div class="form-group"> 
                    <button type="submit" class="btn btn-primary" name="Ajouter">Ajouter</button>
                </div>
            <?php }?>
        </form>
        </div>
    </div>
    </body>
</html>