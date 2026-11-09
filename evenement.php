<?php

session_start();
require '../config/database.php';

if(!isset($_SESSION['nom']) && !isset($_SESSION['droit'])){
    header("location: ../auth/login.php");
}
$evenement =$pdo->query("SELECT* FROM evenement")->fetchall();
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="../css/admin_evenement.css">
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
        <li class="active">
            <a href="#">🪩Evenement</a>
        </li>
         <li>
            <a href="reservation.php">📅Réservation</a>
        </li>
        <li>
            <a href="paiement.php">💳Paiement</a>
        </li>
        <li>
            <a href="facture.php">🧾Facture</a>
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
            🪩 EVENEMENT
        </h1>
        <div class="date">
            <a href="dashboard.php">retour</a>
        </div>

    </header>

    <!-- RECHERCHES -->
<section class="recherche-client">
   <div >
    <h3>
        Recherche evenement
    </h3>

    <form action="" method="get" class="search-form">

        <input type="text" name="libelle_evenement" placeholder="Ecrivez le nom du l'evenement recherchez...">
         
        
         
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
                LISTE DES EVENEMENTS
            </h2>

            <table>

         <tr>
            <th>
               ID
            </th>
             <th>
                EVENEMENT 
            </th>
        </tr>
        <?php  foreach($evenement as $e): ?>
        <tr>
            <td>
                <?= $e['id_evenement']?>
            </td>
            <td>
                <?= $e['libelle_evenement'] ?>
            </td>
            <td>
                <a href="../gestionnaire/evenements/Esupprimer.php?id_evenement=<?= $e['id_evenement']?>" onclick="return confirm('Voulez-vous supprimer?')">SUPPRIMER</a>
            </td>
        </tr>
      <?php endforeach;?>
            </table>
        </section>


 </div>

 <br>

<div class="date">
            <a href="#">AJOUTER UN EVENEMENT</a>
        </div>
</main>

<!--FOOTER
<footer>
    
        2026 J'MEDIAS. Tous droits réservés
    
</footer>-->


</body>
</html>
















