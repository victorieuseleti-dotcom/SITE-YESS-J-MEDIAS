<?php
session_start();

require '../../config/database.php';

if(!isset($_SESSION['nom']) && !isset($_SESSION['droit'])){
    header("location: ../auth/login.php");
}
$client = $pdo->query("SELECT * FROM client")->fetchall();

$offre = $pdo->query("SELECT * FROM offre")->fetchall();

$evenement = $pdo->query("SELECT * FROM evenement")->fetchall();

$id_reservation = $_GET['id_reservation'];

$req = "
SELECT * 
FROM reservation
WHERE id_reservation=?";

$stmt = $pdo->prepare($req);
$stmt ->execute([
    $id_reservation
]);

$r = $stmt->fetch();

if(empty($r)){
    die("IDANTIFIANT INTROUVER");
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="../../css/client_modifier.css">
<body>

<div class="container">
    <!-- sidebar -->
    <!-- sidebar -->
    

    
    

    
<!-- mains -->

<main class="main-content">
    <header class="header">
        <h1>
            📅RESERVATION
        </h1>
        <div class="date">
            <a href="../../admin/reservation.php">retour</a>
        </div>

    </header>

   
  

<div class="titre" >
           

            <h2>
                Modifier les Informations
            </h2>
             
            
         </div>
    
<section class="formulaire">
    
 <form action="tmodifier.php" method="POST">

  <input type="hidden" name="id_reservation"  value="<?= $r['id_reservation'] ?>">
    <div class="champ">
        <label>DATE </label>

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="date_reservation"  value="<?= $r['date_reservation']?>" >
        </div>
    </div>


    <div class="champ">
        <label>LIEU </label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="lieu_reservation"  value="<?= $r['lieu_reservation']?>">
        </div>
    </div>
            


    <div class="champ">
        <label>HEURE </label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="heure" value="<?= $r['heure']?>">
        </div>
    </div>


    <div class="champ">
        <label>STATUT</label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="statut" value="<?= $r['statut']?>">
        </div>
    </div>
            

    <div class="champ">
        <label>OFFRE</label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <select name="id_offre">
                  <option >TOUS LES OFFRES</option> 
                  <?php foreach($offre as $o):?>
                     <option value="<?= $o['id_offre'] ?>">
                           <?= $o['description']?>
                     </option>
                  <?php endforeach;?>
             </select>
            
        </div>
    </div>



    <div class="champ">
        <label>NOM & PRENOM </label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <select name="id_client">
                  <option >TOUS LES NOM & PRENOMS DES CLIENTS</option> 
                  <?php foreach($client as $c):?>
                     <option value="<?= $c['id_client'] ?>">
                           <?= $c['nom']."  ".$c['prenom'] ?>
                     </option>
                  <?php endforeach;?>
             </select>
        </div>
    </div>



    <div class="champ">
        <label>EVENEMENT</label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <select name="id_evenement">
                  <option >TOUS LES EVENEMENTS</option> 
                  <?php foreach($evenement as $e):?>
                     <option value="<?= $e['id_evenement'] ?>">
                           <?= $e['libelle_evenement'] ?>
                     </option>
                  <?php endforeach;?>
             </select>
            
        </div>
    </div>
              
       <button type="submit"  class="btn-reservation">
            SAUVEGARDER
        </button>
 </form>    
</section>
    


 </div>
</main>


    
</body>
</html>
