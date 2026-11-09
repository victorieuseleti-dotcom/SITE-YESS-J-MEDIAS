<?php
session_start();
include 'config/database.php';


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$type_client = $_POST['type_client'];

$req= "INSERT INTO client(nom,prenom,telephone,email,type_client) VALUES(?,?,?,?,?)";

$stmt = $pdo->prepare($req);

$stmt->execute([
       $nom,
$prenom,
$telephone,
$email,
$type_client
]);

//recuper l'id_client de  la derniere ligne dans la tabele client
$id_client = $pdo->lastInsertId();

//recuperation de la id_client
$_SESSION['id_client'] = $id_client;
$_SESSION['nom'] = $nom;
$_SESSION['prenom'] = $prenom;
$_SESSION['telephone'] = $telephone;
$_SESSION['email'] = $email;
$_SESSION['type'] = $type_client;


 header("location: reservation.php");
exit();



?>
            