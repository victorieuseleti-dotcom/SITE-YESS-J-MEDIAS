<?php
include '../../config/database.php';

$id_offre = $_POST['id_offre'];
$description = $_POST['description'];
$prix = $_POST['prix'];

$req= "INSERT INTO offre VALUES(?,?,?)";

$stmt = $pdo->prepare($req);
$stmt->execute([
        $id_offre,
        $description,
        $prix
]);

header("location: ../../admin/offre.php");
?>
            