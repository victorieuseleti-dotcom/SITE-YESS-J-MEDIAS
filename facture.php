<?php

session_start();
require '../config/database.php';

if(!isset($_SESSION['nom']) && !isset($_SESSION['droit'])){
    header("location: ../auth/login.php");
}
$res = "
SELECT*
FROM reservation AS r
JOIN client AS c 
ON r.id_client = c.id_client
JOIN offre AS o
ON o.id_offre = r.id_offre";

$reservation =$pdo->query($res)->fetchall();

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

$sql2 = "
SELECT *,COALESCE(SUM(p.montant), 0) AS MONTANT_TOTAL, o.prix-SUM(p.montant) AS RESTE
FROM reservation AS r
JOIN paiement AS p
ON p.id_reservation = r.id_reservation
JOIN offre AS o
ON o.id_offre = r.id_offre
GROUP BY r.id_reservation";


?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="../css/admin_reservation.css">
<body>

<div class="container">
    <!-- sidebar -->
     <aside class="sidebar">
     <div class="logo">
        <img src="../images/logo.png" alt="logo J'MEDIAS" >
     </div>

    
    <ul class="menu">
        <li >
            <a href="dashboard.php">Dashboard</a>
        </li>
       
        <li>
            <a href="client.php">👤Client</a>
        </li>
        <li>
            <a href="offre.php"> 🎁Offre</a>
        </li>
        <li >
            <a href="evenement.php">🪩Evenement</a>
        </li>
         <li >
            <a href="reservation.php">📅Réservation</a>
        </li>
        <li>
            <a href="paiement.php">💳Paiement</a>
        </li>
        <li class="active">
            <a href="#">🧾Facture</a>
        </li>
        
    </ul>


    <div class="admin">
        <h3>
          <?= $_SESSION['droit']?>
        </h3>
        <p>
            <?= $_SESSION['nom']?>
        </p>
    </div>
   </aside>

<!-- mains -->

<main class="main-content">
    <header class="header">
        <h1>
           🧾 FACTURE
        </h1>
        <div class="date">
            <a href="dashboard.php">retour</a>
        </div>

    </header>

    <!-- RECHERCHES -->
<section class="recherche-client">
   <div >
    <h3>
        Recherche  la facture d'un client
    </h3>

    <form action="" method="get" class="search-form">

        <input type="text" name="" placeholder="Ecrivez le nom du client recherchez...">

        <input type="text" name="" placeholder="Ecrivez le statut du client recherchez...">
         
        
         
        <button type="sbmit"class="btn-rechercher">
            Rechercher
        </button>

        <button type="reset"class="btn-reset">
            Reinitialiser
        </button>
    </form>
   </div>

  </section>     

    <!-- TABLES -->

    <div class="tables">
        <section class="table-box">
            <h2>
                LISTE DES FACTURES
            </h2>

            <table>

       <tr>
            <th>
              ID
            </th>
             <th>
                NOM & PRENOMS
            </th>
             <th>
                OFFRE
            </th>
            <th>
                EVENEMENT
            </th>
            <th>
                MONTANT TOTAL 
            </th>
            <th>
                RESTE 
            </th>
            <th>
                STATUT 
            </th>
        </tr>
        <?php  foreach($facture as $f): ?>
        <tr>
            <td>
                <?= $f['id_facture']?>
            </td>
            <td>
                <?= $f['nom'] ?>  <?= $f['prenom'] ?>
            </td>
            <td>
                <?= $f['description'] ?> <?= $f['prix'] ?>
            </td>
            <td>
                <?= $f['libelle_evenement'] ?>
            </td>
            <td>
                <?= $f['montant_total'] ?>
            </td>
            <td>
                <?= $f['reste'] ?>
            </td>
            <td>
                <?= $f['statut_facture'] ?>
            </td>
            <td>
                <a href="../gestionnaire/facture/Fsupprimer.php?id_facture=<?= $f['id_facture']?>" onclick="return confirm('Voulez-vous supprimer?')">SUPPRIMER</a>
            </td>
            <td>
                <a href="../gestionnaire/facture/Facture.php?id_facture=<?= $f['id_facture']?>" >FACTURE</a>
            </td>
        </tr>
      <?php endforeach;?>
    </table>

        </section>


 </div>
</main>

<!--FOOTER
<footer>
    
        2026 J'MEDIAS. Tous droits réservés
    
</footer>-->


</body>
</html>


















































