<?php

include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/reservation.php');
    exit;
}

$date = isset($_POST['date_reservation']) ? trim($_POST['date_reservation']) : '';
$lieu = isset($_POST['lieu_reservation']) ? trim($_POST['lieu_reservation']) : '';
$statut = isset($_POST['statut']) ? trim($_POST['statut']) : '';
$heure = isset($_POST['heure']) ? trim($_POST['heure']) : '';
$id_offre = isset($_POST['id_offre']) ? trim($_POST['id_offre']) : '';
$id_client = isset($_POST['id_client']) ? trim($_POST['id_client']) : '';
$id_evenement = isset($_POST['id_evenement']) ? trim($_POST['id_evenement']) : '';

if ($date === '' || $lieu === '' || $statut === '' || $heure === '' || $id_offre === '' || $id_client === '' || $id_evenement === '') {
    header('Location: ../../admin/reservation.php?error=missing');
    exit;
}

if (!ctype_digit($id_offre) || !ctype_digit($id_client) || !ctype_digit($id_evenement)) {
    header('Location: ../../admin/reservation.php?error=invalid');
    exit;
}

// Vérifier si la date est déjà réservée
$check = $pdo->prepare('SELECT COUNT(*) FROM reservation WHERE date_reservation = :date_reservation');
$check->execute([':date_reservation' => $date]);
if ($check->fetchColumn() > 0) {
    header('Location: ../../admin/reservation.php?error=date_taken');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO reservation (date_reservation, lieu_reservation, statut, heure, id_offre, id_client, id_evenement) VALUES (:date_reservation, :lieu_reservation, :statut, :heure, :id_offre, :id_client, :id_evenement)'
    );
    $stmt->execute([
        ':date_reservation' => $date,
        ':lieu_reservation' => $lieu,
        ':statut' => $statut,
        ':heure' => $heure,
        ':id_offre' => $id_offre,
        ':id_client' => $id_client,
        ':id_evenement' => $id_evenement,
    ]);

    header('Location: ../../admin/reservation.php?success=1');
    exit;
} catch (PDOException $e) {
    header('Location: ../../admin/reservation.php?error=database');
    exit;
}

?>
