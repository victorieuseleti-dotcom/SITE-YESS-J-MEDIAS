<?php
session_start();
require 'config/database.php';


$id_reservation = $_GET['id_reservation'];


 $req = "
  SELECT r.id_reservation as id_reservation, c.nom AS nom, c.prenom AS prenom, c.telephone As telephone, c.email AS email, c.type_client as type, e.libelle_evenement as evenement, o.prix as prix, o.description as offre, r.date_reservation as date, r.lieu_reservation as lieu , o.prix * 0.5 as MONTANT
 FROM reservation as r
 JOIN client AS c
 ON c.id_client = r.id_client
 JOIN evenement as e
 ON e.id_evenement = r.id_evenement
 JOIN offre as o
 ON o.id_offre = r.id_offre
 WHERE id_reservation = ? ";

$stmt = $pdo->prepare($req);

$stmt->execute([
$id_reservation
]);


$reservation = $stmt->fetch(PDO::FETCH_ASSOC);   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/paiement_style.css">
</head>
<body>


<!-- ENTETE -->
<header>
    <div class="logo">
                <i class="fa- regular fa-calendar-days">
                     
                </i>
                <div class="ligne">
                   <h1>
                    RESERVATION 
                   </h1>
                   <p>
                     Reservez en tout simplicité
                   </p>
                </div> 
            
    </div>
      <nav>
         <ul>
             <li>
                 <a href="#">ACCUEIL</a>
             </li>
             <li>
                <a href="#">A PROPOS</a>
             </li>
             <li>
                <a href="#">SERVICE</a>
             </li>
             <li class="active">
                 <a href="#">📝 RESERVATION</a>
             </li>
             <li>
                <a href="#">📞 CONCTAT</a>
             </li>
         </ul>
      </nav>
             <button type="submit" class="btn-login" >
                  <a href="index.php">RETOUR</a>
                </button>   
   
</header>
<!-- CORPS -->



<section class="container">


   <div class="titre" >
            <h4>
                RESERVER AVEC SUCCES
            </h4>

            <h1>
                Reservation Confirmez
            </h1>
             
            <p>
                Veuillez confirmer votre reservation
            </p>
      </div>
</section>
 <!-- INFOS CLIENT -->
<section class="card">
     <h3>
        <i></i>
        LISTE
     </h3>
     <div class="row">
        <span>
            NOM & PRENOM:</span>
            <b>
                <?= $reservation['nom']." ".$reservation['prenom'] ?>
            </b>
     </div>

     <div class="row">
        <span>
            TELEPHONE: </span>
            <b>
                <?= $reservation['telephone']?>
            </b>
     </div>


     <div class="row">
        <span>
            EVENEMENT:</span>
            <b>
                <?= $reservation['evenement']?>
            </b>   
     </div>


     <div class="row">
        <span>
            OFFRE:</span>
            <b>
                <?= $reservation['offre']?>
            </b>
     </div>

     <div class="row">
        <span>
            PRIX DE L'OFFRE:</span>
            <b>
                <?= $reservation['prix']."FCFA"?>    </b>
     </div>

     <div class="row">
        <span>
            PREMIER ACCOMPTE:</span>
            <b>
                <?= $reservation['MONTANT']."FCFA"?>    </b>
     </div>

   <div class="actions">
      <button type="submit" formaction="index.php" class="btn-payer">
        <a href="index.php">retour a l'Accueil</a>
      </button>

   </div>
 </section>


            
     


<!-- PIED DE PAGE -->
<footer>
<div class="footer-container">
   <div class="footer-col">
    <h3>
       RESERVATION 
    </h3>
    <p>votre partenaire de confiance pour toutes vos reservations audiovuelles</p>
   </div>   


    <div class="footer-col">
        <h3>
            Liens Rapides
        </h3>
        <ul>
            <li>
                Accueil
            </li>
            <li>
                A propos
            </li>
            <li>
                Services
            </li>
            <li>
                Reservations
            </li>
            <li>
                Contact
            </li>
        </ul>
    </div>

    <div class="footer-col">
        <h3>
            Contact
        </h3>
        <p>
            contact: 015242476889
        </p>
        <p>
            contact@jmedias.com
        </p>
        <p>
            Abidjan, côte d'ivoire
        </p>
    </div>
</div>
    <div class="pieds">
        2026 STRUCTURE JMEDIAS - Tous droits réservés
    </div>
</footer>
</body>
</html>

