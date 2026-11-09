<?php

include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/facture_auto.php');
    exit;
}

$id_reservation = isset($_POST['id_reservation']) ? trim($_POST['id_reservation']) : '';

if ($id_reservation === '') {
    header('Location: ../../admin/facture_auto.php?error=missing');
    exit;
}

if (!ctype_digit($id_reservation)) {
    header('Location: ../../admin/facture_auto.php?error=invalid');
    exit;
}

$reservationStmt = $pdo->prepare(
    'SELECT r.id_reservation, o.prix, c.nom, c.prenom, o.description
     FROM reservation r
     JOIN offre o ON o.id_offre = r.id_offre
     JOIN client c ON c.id_client = r.id_client
     WHERE r.id_reservation = :id_reservation'
);
$reservationStmt->execute([':id_reservation' => $id_reservation]);
$reservation = $reservationStmt->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    header('Location: ../../admin/facture_auto.php?error=reservation_not_found');
    exit;
}

$existingFactureStmt = $pdo->prepare('SELECT COUNT(*) FROM facture WHERE id_reservation = :id_reservation');
$existingFactureStmt->execute([':id_reservation' => $id_reservation]);
if ($existingFactureStmt->fetchColumn() > 0) {
    header('Location: ../../admin/facture_auto.php?error=already_invoiced');
    exit;
}

$paymentSumStmt = $pdo->prepare('SELECT COALESCE(SUM(montant), 0) AS total_paid FROM paiement WHERE id_reservation = :id_reservation');
$paymentSumStmt->execute([':id_reservation' => $id_reservation]);
$paymentInfo = $paymentSumStmt->fetch(PDO::FETCH_ASSOC);
$totalPaid = floatval($paymentInfo['total_paid']);
$price = floatval($reservation['prix']);

if ($totalPaid < $price) {
    header('Location: ../../admin/facture_auto.php?error=not_fully_paid');
    exit;
}

$montant_total = round($totalPaid);
$reste = max(0, round($price - $totalPaid));
$statut_facture = 'SOLDER';

try {
    $insertStmt = $pdo->prepare(
        'INSERT INTO facture (montant_total, reste, statut_facture, id_reservation) VALUES (:montant_total, :reste, :statut_facture, :id_reservation)'
    );
    $insertStmt->execute([
        ':montant_total' => $montant_total,
        ':reste' => $reste,
        ':statut_facture' => $statut_facture,
        ':id_reservation' => $id_reservation,
    ]);

    header('Location: ../../admin/facture_auto.php?success=1');
    exit;
} catch (PDOException $e) {
    header('Location: ../../admin/facture_auto.php?error=database');
    exit;
}

?>
