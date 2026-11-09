<?php
include '../../config/database.php';

$id_evenement = $_POST['id_evenement'];
$libelle_evenement = $_POST['libelle_evenement'];

$req= "INSERT INTO evenement VALUES(?,?)";

$stmt = $pdo->prepare($req);
$stmt->execute([
        $id_evenement,
        $libelle_evenement
]);

header("location: ../../admin/evenement.php");
?>
            