<?php

session_start();

$cnx = new mysqli('localhost', 'root', '','IStocksDB') or die(mysqli_error($cnx));

$tbcodeSrv = ''; //Variable pour le readOnly du input codeSrv
$codeSrv = '';
$codeEntrFK= '';
$codeCDFK1 = '';
$codeCDFK2 = '';
$update = false; 

/* ------Add------ */ 

if(isset($_POST['Ajouter'])){
    $codeSrv = $_POST['codeSrv'];
    $codeEntrFK = $_POST['codeEntrFK'];
    $codeCDFK1 = null;
    $codeCDFK2 = null;

    $cnx->query("INSERT INTO Services (codeSrv, codeEntrFK, codeCDFK1, codeCDFK2) VALUES ('$codeSrv','$codeEntrFK','$codeCDFK1','$codeCDFK2')") 
                or die($cnx->error);
    
    $_SESSION['message'] = "Service ajouté avec succés !";
    $_SESSION['msg_type'] = "success";

    header("location : index.php");
}

/* ------Edit------ */

if(isset($_GET['edit'])){
    $codeSrv = $_GET['edit'];
    $update = true;
    $tbcodeSrv = "readonly";
    $result = $cnx->query("SELECT * FROM Services WHERE codeSrv = '$codeSrv'") or die($cnx->error);
    while($row = $result->fetch_assoc()){
        $codeEntrFK = $row['codeEntrFK'];
        $codeCDFK1 = $row['codeCDFK1'];
        $codeCDFK2 = $row['codeCDFK2'];
    }
}

/* ------Delete------ */

if(isset($_GET['delete'])){
    $codeSrv = $_GET['delete'];

    echo($codeSrv."<br>");
    $cnx->query("DELETE FROM Services WHERE codeSrv='$codeSrv'") or die(mysqli_error($cnx));

    $_SESSION['message'] = "Service supprimé avec succés !";
    $_SESSION['msg_type'] = "danger";

    header("location : index.php");
}

/* ------Update------ */

if(isset($_POST['codeS'])){
    $codeSrv = $_POST['codeS'];
    $codeEntrFK = $_POST['codeEntrFK'];
    $codeCDFK1 = $_POST['codeCDFK1'];
    $codeCDFK2 = $_POST['codeCDFK2'];
    $cnx->query("UPDATE Services SET codeEntrFK = '$codeEntrFK', codeCDFK1 = '$codeCDFK1', codeCDFK2 = '$codeCDFK2' WHERE codeSrv='$codeSrv'") 
                or die(mysqli_error($cnx));
    
    $_SESSION['message'] = "Service mis à jour avec succés !";
    $_SESSION['msg_type'] = "warning";
}
?>