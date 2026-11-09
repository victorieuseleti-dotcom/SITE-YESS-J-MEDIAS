<?php


require '../../config/database.php';

$req = "DELETE FROM facture WHERE id_facture=? ";

$stmt = $pdo->prepare($req);
$stmt->execute([
    $_GET['id_facture']
]);


header("location: ../../admin/facture.php");
?>