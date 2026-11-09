<?php
session_start();
include 'config/database.php';

$date = isset($_POST['date_reservation']) ? trim($_POST['date_reservation']) : '';
$lieu = isset($_POST['lieu_reservation']) ? trim($_POST['lieu_reservation']) : '';
$heure = isset($_POST['heure']) ? trim($_POST['heure']) : '';
$statut = isset($_POST['statut']) ? trim($_POST['statut']) : '';
$id_client = isset($_POST['id_client']) ? trim($_POST['id_client']) : '';
$id_evenement = isset($_POST['id_evenement']) ? trim($_POST['id_evenement']) : '';
$id_offre = isset($_POST['id_offre']) ? trim($_POST['id_offre']) : '';




if ( $date === '' || $lieu === '' || $statut === '' || $heure === '' || $statut === '' || $id_client === '' || $id_evenement === '' || $id_offre ===''  ) {
    header('Location: reservation.php?error=missing');
    exit;
}

if (!ctype_digit($id_client) || !ctype_digit($id_evenement) || !ctype_digit($id_offre)) {
    header('Location: reservation.php?error=invalid');
    exit;
}

// Vérifier si la date est déjà réservée
$check = $pdo->prepare('SELECT COUNT(*) FROM reservation WHERE date_reservation = :date_reservation');
$check->execute([':date_reservation' => $date]);
if ($check->fetchColumn() > 0) {
    header('Location: reservation.php?error=date_taken');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO reservation (date_reservation, lieu_reservation, heure, statut, id_client, id_evenement, id_offre) VALUES (:date_reservation, :lieu_reservation, :heure, :statut,  :id_client, :id_evenement,:id_offre)'
    );
    $stmt->execute([
        ':date_reservation' => $date,
        ':lieu_reservation' => $lieu,
        ':heure' => $heure,
        ':statut' => $statut,
        ':id_client' => $id_client,
        ':id_evenement' => $id_evenement,
        ':id_offre' => $id_offre,
    ]);

     //recuper l'id_client de  la derniere ligne dans la tabele reservation
$id_reservation = $pdo->lastInsertId();

     
    header('Location: affichage.php?id_reservation='.$id_reservation);
    exit;
} catch (PDOException $e) {
    header('Location: reservation.php?error=database');
    exit;
}

?>
