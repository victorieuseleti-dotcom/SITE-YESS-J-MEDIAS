<?php

include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/paiement.php');
    exit;
}

$id_reservation = isset($_POST['id_reservation']) ? trim($_POST['id_reservation']) : '';
$montant = isset($_POST['montant']) ? trim($_POST['montant']) : '';
$date_paiement = isset($_POST['date_paiement']) ? trim($_POST['date_paiement']) : '';
$type_paiement = isset($_POST['type_paiement']) ? trim($_POST['type_paiement']) : '';

if ($id_reservation === '' || $montant === '' || $date_paiement === '' || $type_paiement === '') {
    header('Location: ../../admin/paiement.php?error=missing');
    exit;
}

if (!ctype_digit($id_reservation)) {
    header('Location: ../../admin/paiement.php?error=invalid');
    exit;
}

$dateTime = DateTime::createFromFormat('Y-m-d', $date_paiement);
if (!$dateTime || $dateTime->format('Y-m-d') !== $date_paiement) {
    header('Location: ../../admin/paiement.php?error=date_invalid');
    exit;
}

$reservationStmt = $pdo->prepare(
    'SELECT r.id_reservation, o.prix, o.description FROM reservation r JOIN offre o ON o.id_offre = r.id_offre WHERE r.id_reservation = :id_reservation'
);
$reservationStmt->execute([':id_reservation' => $id_reservation]);
$reservation = $reservationStmt->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    header('Location: ../../admin/paiement.php?error=reservation_not_found');
    exit;
}

$price = floatval($reservation['prix']);

$paymentCountStmt = $pdo->prepare('SELECT COUNT(*) AS count FROM paiement WHERE id_reservation = :id_reservation');
$paymentCountStmt->execute([':id_reservation' => $id_reservation]);
$paymentInfo = $paymentCountStmt->fetch(PDO::FETCH_ASSOC);
$paymentCount = intval($paymentInfo['count']);

if ($paymentCount >= 3) {
    header('Location: ../../admin/paiement.php?error=already_paid');
    exit;
}

switch ($paymentCount) {
    case 0:
        $expected = $price * 0.50;
        $stepLabel = '1er acompte (50%)';
        break;
    case 1:
        $expected = $price * 0.30;
        $stepLabel = '2ème acompte (30%)';
        break;
    case 2:
        $expected = $price * 0.20;
        $stepLabel = '3ème acompte (20%)';
        break;
    default:
        $expected = 0;
        break;
}

$expected = round($expected);

if (!is_numeric($montant) || floatval($montant) != $expected) {
    header('Location: ../../admin/paiement.php?error=amount_mismatch&expected=' . urlencode($expected));
    exit;
}

try {
    $insertStmt = $pdo->prepare(
        'INSERT INTO paiement (montant, date_paiement, type_paiement, id_reservation) VALUES (:montant, :date_paiement, :type_paiement, :id_reservation)'
    );
    $insertStmt->execute([
        ':montant' => $expected,
        ':date_paiement' => $date_paiement,
        ':type_paiement' => $type_paiement,
        ':id_reservation' => $id_reservation,
    ]);

    header('Location: ../../admin/paiement.php?success=1');
    exit;
} catch (PDOException $e) {
    header('Location: ../../admin/paiement.php?error=database');
    exit;
}

?>
