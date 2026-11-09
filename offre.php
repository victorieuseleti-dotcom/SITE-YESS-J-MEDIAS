<?php

session_start();
require '../config/database.php';

if(!isset($_SESSION['nom']) && !isset($_SESSION['droit'])){
    header("location: ../auth/login.php");
}
$offre =$pdo->query("SELECT* FROM offre")->fetchall();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="../css/admin_offre.css">
<body>

<div class="container">
    <!-- sidebar -->
     <aside class="sidebar">
     <div class="logo">
        <img src="../images/logo.png" alt="logo J'MEDIAS" >
     </div>

    
    <ul class="menu">
        <li >
            <a href="#">Dashboard</a>
        </li>
       
        <li>
            <a href="client.php">👤Client</a>
        </li>
        <li class="active">
            <a href="offre.php"> 🎁Offre</a>
        </li>
        <li >
            <a href="evenement.php">🪩Evenement</a>
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
             🎁 OFFRES
        </h1>
        <div class="date">
            <a href="dashboard.php">retour</a>
        </div>

    </header>

    <!-- RECHERCHES -->
<section class="recherche-client">
   <div >
    <h3>
        Recherche offre
    </h3>

    <form action="" method="get" class="search-form">

        <input type="text" name="description" placeholder="Ecrivez le nom de offre recherchez...">
         
        
         
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
                LISTE DES OFFRES
            </h2>

    <table>

         <tr>
            <th>
              IDENTIFIANT DES OFFRES
            </th>
             <th>
               DESCRIPTION
            </th>
             <th>
                PRIX
            </th>
        </tr>
        <?php  foreach($offre as $o): ?>
        <tr>
            <td>
                <?= $o['id_offre']?>
            </td>
            <td>
                <?= $o['description'] ?>
            </td>
            <td>
                <?= $o['prix'] ?>
            </td>
        
            <td>
                <a href="../gestionnaire/offres/Osupprimer.php?id_offre=<?= $o['id_offre']?>" onclick="return confirm('Voulez-vous supprimer?')">SUPPRIMER</a>
            </td>
        
           
        </tr>
      <?php endforeach;?>
    </table>
         
    
        </section>


 </div>
 <br>

<div class="date">
            <a href="#">AJOUTER UNE OFFRE</a>
        </div>

 
</main>

<!--FOOTER
<footer>
    
        2026 J'MEDIAS. Tous droits réservés
    
</footer>-->


</body>
</html>


























