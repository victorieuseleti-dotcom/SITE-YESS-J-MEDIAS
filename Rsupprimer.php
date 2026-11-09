<?php


require '../../config/database.php';

$req = "DELETE FROM reservation WHERE id_reservation=? ";

$stmt = $pdo->prepare($req);
$stmt->execute([
    $_GET['id_reservation']
]);


header("location: ../../admin/reservation.php");
?>