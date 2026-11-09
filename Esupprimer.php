<?php


require '../../config/database.php';

$req = "DELETE FROM evenement WHERE id_evenement=? ";

$stmt = $pdo->prepare($req);
$stmt->execute([
    $_GET['id_evenement']
]);


header("location: ../../admin/evenement.php");
?>