<?php
include '../../config/database.php';

$id_client = $_POST['id_client'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$type_client = $_POST['type_client'];

$req= "INSERT INTO client VALUES(?,?,?,?,?,?)";

$stmt = $pdo->prepare($req);
$stmt->execute([
        $id_client,
        $nom,
        $prenom,
        $telephone,
        $email,
        $type_client
]);

header("location: ../../admin/client.php");

?>
            