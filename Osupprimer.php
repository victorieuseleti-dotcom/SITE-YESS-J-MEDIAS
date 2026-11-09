<?php


require '../../config/database.php';

$req = "DELETE FROM offre WHERE id_offre=? ";

$stmt = $pdo->prepare($req);
$stmt->execute([
    $_GET['id_offre']
]);


header("location: ../../admin/offre.php");
?>