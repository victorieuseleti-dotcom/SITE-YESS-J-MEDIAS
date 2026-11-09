<?php
session_start();
require 'config/database.php';


$id_reservation = $_GET['id_reservation'];


 $req = "
 SELECT r.id_reservation as id_reservation, c.nom AS nom, c.prenom AS prenom, c.telephone As telephone, c.email AS email, c.type_client as type, e.libelle_evenement as evenement, o.prix as prix, o.description as offre, r.date_reservation as date, r.lieu_reservation as lieu 
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

$res= $pdo->lastInsertId();

$reservation = $stmt->fetch(PDO::FETCH_ASSOC);   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/affiche_style.css">
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
<main>


   <div class="titre" >
            <span>
                INFORMATION
            </span>

            <h2>
                Verifiez vos informations
            </h2>
             
            <p>
                Veuillez confirmer votre reservation
            </p>
      </div>

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
            E-MAIL:</span>
            <b>
                <?= $reservation['email']?>
            </b>
        
     </div>


     <div class="row">
        <span>
            TYPE CLIENT:</span>
            <b>
                <?= $reservation['type']?>
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
            PRIX DE L'OFFRE:</span>
            <b>
                <?= $reservation['prix']?>
            </b>
        
     </div>

     <div class="row">
        <span>
            LIEU:</span>
            <b>
                <?= $reservation['lieu']?>
            </b>
        
     </div>

     


     
    
   <div class="actions">
      <button type="submit" formaction="index.php" class="cancel">
        <a href="index.php">ANNULER</a>
      </button>

      <button type="submit" formaction="paiement.php" class="confirm">
           <a href="paiement.php?id_reservation=<?= $reservation['id_reservation']?>">CONFIRMER LA RESERVATION</a> 
        </button>
   </div>
 </section>
</main>


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
