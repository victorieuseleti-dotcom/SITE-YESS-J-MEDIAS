<?php


require '../../config/database.php';

$req = "DELETE FROM client WHERE id_client=? ";

$stmt = $pdo->prepare($req);
$stmt->execute([
    $_GET['id_client']
]);


header("location: ../../admin/client.php");
?>