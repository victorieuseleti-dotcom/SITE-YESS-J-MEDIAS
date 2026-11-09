<?php
 require '../../config/database.php';



 $sql2 = "
SELECT *,COALESCE(SUM(p.montant), 0) AS MONTANT_TOTAL, o.prix-SUM(p.montant) AS RESTE
FROM reservation AS r
JOIN paiement AS p
ON p.id_reservation = r.id_reservation
JOIN offre AS o
ON o.id_offre = r.id_offre
WHERE id_reservation = ?";

$stmt = $pdo->prepare($sql2);
$stmt -> execute([
   $_GET['id_reservation']
]);

$facture = $stmt->fetch();
?>

<?php if(isset($facture)):?>

<table>
    <tr>
        <th>MONTANT TOTAL</th>
    </tr>
    <tr>
        <th>
            RESTE
        </th>
    </tr>
    <tr>
        <th>STATUT FACTURE</th>
    </tr>
    <tr>
        <td>
            <?=  $facture['MONTANT_TOTAL']?>
        </td>
    </tr>
</table>
  <?php endif; ?>