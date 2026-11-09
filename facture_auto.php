<?php

session_start();
require '../config/database.php';

if(!isset($_SESSION['nom']) && !isset($_SESSION['droit'])){
    header('location: ../auth/login.php');
}

$reservation = $pdo->query(
    "SELECT r.id_reservation, c.nom, c.prenom, o.description, o.prix, COALESCE(SUM(p.montant), 0) AS total_paid
    FROM reservation AS r
    JOIN client AS c ON r.id_client = c.id_client
    JOIN offre AS o ON o.id_offre = r.id_offre
    LEFT JOIN paiement AS p ON p.id_reservation = r.id_reservation
    LEFT JOIN facture AS f ON f.id_reservation = r.id_reservation
    WHERE f.id_facture IS NULL
    GROUP BY r.id_reservation
    HAVING total_paid >= o.prix"
)->fetchall();

$sql = "
SELECT*
FROM facture AS f
JOIN reservation AS r 
ON r.id_reservation = f.id_reservation
JOIN client AS c
ON r.id_client = c.id_client
JOIN offre AS o
ON o.id_offre = r.id_offre
JOIN evenement AS e
ON e.id_evenement = r.id_evenement";

$facture =$pdo->query($sql)->fetchall();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
</head>
<body>
<?php if (isset($_GET['error'])): ?>
    <p style="color:red;font-weight:bold;">
        <?php
            if ($_GET['error'] === 'missing') {
                echo 'Veuillez choisir une réservation pour générer la facture.';
            } elseif ($_GET['error'] === 'invalid') {
                echo 'Réservation invalide.';
            } elseif ($_GET['error'] === 'already_invoiced') {
                echo 'Cette réservation a déjà une facture.';
            } elseif ($_GET['error'] === 'not_fully_paid') {
                echo 'La réservation n\'est pas encore totalement payée. La facture ne peut pas être générée.';
            } elseif ($_GET['error'] === 'reservation_not_found') {
                echo 'Réservation introuvable.';
            } elseif ($_GET['error'] === 'database') {
                echo 'Erreur de base de données. Veuillez réessayer.';
            }
        ?>
    </p>
<?php elseif (isset($_GET['success']) && $_GET['success'] === '1'): ?>
    <p style="color:green;font-weight:bold;">Facture générée avec succès.</p>
<?php endif; ?>

<form action="../gestionnaire/facture/Fajouter_auto.php" method="POST">
         <h1>
            AJOUTEZ LA FACTURE ICI!!!
         </h1>
       <table>
        <tr>
            <td>
                <label>RESERVATION ENTIÈREMENT PAYÉE:</label>
            </td>
            <td>
              <select name="id_reservation">
                  <option value="">choisissez la réservation</option>
                    <?php foreach($reservation as $r): ?>
                     <option value="<?= $r['id_reservation'] ?>">
                        <?= $r['id_reservation'] ?> - <?= $r['nom'] . ' ' . $r['prenom'] ?> - <?= $r['description'] ?> (<?= $r['prix'] ?> FCFA)
                     </option>
                    <?php endforeach; ?>
              </select>
            </td>
        </tr>
       </table>

       <input type="submit" value="AJOUTER">
    </form>

    <br>
    <h1>
        LISTE DES RÉSERVATIONS SOLDÉES AVEC FACTURE
    </h1>

    <table border=1>
        <tr>
            <th>IDENTIFIANT DE LA FACTURE</th>
            <th>NOM & PRENOM</th>
            <th>OFFRE</th>
            <th>EVENEMENT</th>
            <th>MONTANT TOTAL</th>
            <th>RESTE A PAYER</th>
            <th>STATUT DE LA FACTURE</th>
        </tr>
        <?php foreach($facture as $f): ?>
        <tr>
            <td><?= $f['id_facture'] ?></td>
            <td><?= $f['nom'] ?> <?= $f['prenom'] ?></td>
            <td><?= $f['description'] ?> <?= $f['prix'] ?> FCFA</td>
            <td><?= $f['libelle_evenement'] ?></td>
            <td><?= $f['montant_total'] ?></td>
            <td><?= $f['reste'] ?></td>
            <td><?= $f['statut_facture'] ?></td>
            <td><a href="../gestionnaire/facture/Fsupprimer.php?id_facture=<?= $f['id_facture'] ?>" onclick="return confirm('Voulez-vous supprimer?')">SUPPRIMER</a></td>
        </tr>
      <?php endforeach; ?>
    </table>

<br>
<a href="dashboard.php">retour</a>
</body>
</html>
