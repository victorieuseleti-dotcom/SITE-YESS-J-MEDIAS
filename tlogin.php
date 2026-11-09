<?php
session_start();

include '../config/database.Php';

$nom_user = $_POST['nom_user'];
$email_user = $_POST['email_user'];
$pass_user = $_POST['pass_user'];

$sql="
SELECT *
FROM utilisateur
WHERE nom_user=? AND email_user=? AND pass_user=?";

$stmt= $pdo->prepare($sql);
$stmt->execute([
    $nom_user,
    $email_user,
    $pass_user
]);


$utilisateur = $stmt->fetch();

if(!empty($utilisateur)){

    $_SESSION['nom'] = $utilisateur['nom_user'];
    $_SESSION['droit'] = $utilisateur['role'];

    if($utilisateur['role']=='administrateur')
    {
        header("location: ../admin/dashboard.php");
    }
    elseif($utilisateur['role']=='responsable_projet')
    {
    header("location: ../responsable/dashboard.php");}
    elseif($utilisateur['role']=='comptable')
    {
    header("location: ../comptable/dashboard.php");}
    }
    else{
        header("location: login.php");
         
    }
?>

