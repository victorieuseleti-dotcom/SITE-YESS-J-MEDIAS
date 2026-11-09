<?php

include '../../config/database.php';

$id_reservation = $_POST['id_reservation'];
$date = $_POST['date_reservation'];
$lieu = $_POST['lieu_reservation'];
$statut = $_POST['statut'];
$heure = $_POST['heure'];
$id_offre = $_POST['id_offre'];
$id_client = $_POST['id_client'];
$id_evenement = $_POST['id_evenement'];

$req = "UPDATE reservation 
SET  date_reservation =?, lieu_reservation=?, statut=?, heure=?,id_offre=?, id_client=?, id_evenement=?
WHERE id_reservation=?";

$stmt = $pdo->prepare($req);

$stmt->execute([
       $date,
       $lieu,
       $statut,
       $heure,
       $id_offre,
       $id_client,
       $id_evenement,
       $id_reservation   
]);

header("location: ../../admin/reservation.php");

?>
            