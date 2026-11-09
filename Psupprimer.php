<?php


require '../../config/database.php';

$req = "DELETE FROM paiement WHERE id_paiement=? ";

$stmt = $pdo->prepare($req);
$stmt->execute([
    $_GET['id_paiement']
]);


header("location: ../../admin/paiement.php");
?>