<?php

session_start();
require 'config/database.php';


$evenement =$pdo->query("SELECT* FROM evenement")->fetchall();

$offre =$pdo->query("SELECT* FROM offre")->fetchall();


$id_client = $_SESSION['id_client'];
 

/*$req = "
SELECT o.prix as prix, COALESCE(SUM(p.montant),0) as montant, r.id_client
FROM reservation as r
JOIN offre as o
ON o.id_offre = r.id_offre
JOIN paiement AS p
ON p.id_reservation = r.id_reservation
WHERE r.id_client = '$id_client'";



$reservation = $stmt->fetch();


$prix = $reservation['prix'];


$montant = $reservation['montant'];

    if($montant == 0)
    {
        $statut ='reservation en cours';
        
    }
    elseif($montant == $prix)
    {
          $statut ='reservation soldée';}
    elseif($prix > 0 && $montant<$prix)
    {
         $statut ='reservation confirmée';}
   else {
        exit("Erreur table introuvez");
    }

*/

/*recuperer le dernier numero de réservation

$sql = "SELECT num_reservation
        FROM reservation 
        ORDER BY id_reservation DESC LIMIT 1";

$stmt = $pdo->query($sql);

$dernier = $stmt->fetch(PDO::FETCH_ASSOC);

if($dernier){
    $numero = intval(substr($dernier['num_reservation'],3));
    $numero++;
}else{
    $numero = 1;
}

//Générer AAA01 ,AAA02

$num_reservation = "AAA".str_pad($numero, 2, "0", STR_PAD_LEFT);
*/

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/reservation_style.css">
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
                FORMULAIRE DE RESERVATION
            </span>

            <h2>
                Detail reservation
            </h2>
             
            <p>
                Veuillez remplir le formulaire ci-dessous pour effectuer votre reservation.
            </p>
      </div>


<?php if (isset($_GET['error']) && $_GET['error'] === 'date_taken'): ?>
    <p style="color:red;font-weight:bold;">Cette date est déjà réservée. Choisissez une autre date.</p>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'missing'): ?>
    <p style="color:red;font-weight:bold;">Veuillez remplir tous les champs du formulaire.</p>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>
    <p style="color:red;font-weight:bold;">Les identifiants sélectionnés sont invalides.</p>
<?php elseif (isset($_GET['success']) && $_GET['success'] === '1'): ?>
    <p style="color:green;font-weight:bold;">Réservation ajoutée avec succès.</p>
<?php endif; ?>
 <br>
 <section class="formulaire">
    
   <form action="" method="POST">

    <div class="champ">
        <label>DATE DE L'EVENEMENT *</label>

        <!--<input type="hidden" name="num_reservation" value="<?= $num_reservation ?> ">-->

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="date" name="date_reservation" placeholder="entrez la date votre reservation" required>
        </div>
     </div>

     <div class="champ">
        <label>LIEU DE L'EVENEMENT *</label>

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="lieu_reservation" placeholder="entrez le nom du lieu de l'evenement" required>
        </div>
    </div>

   
          <!--<input type="hidden" name="statut" VALUE="<?= $statut ?>">-->
      

     <div class="champ">
        <label>HEUER DE L'EVENEMENT *</label>

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="time" name="heure" placeholder="entrez la date votre reservation" required>
        </div>
    </div>

    <div class="champ">
        <label>STATUT *</label>

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="statut" placeholder="" required>
        </div>
    </div>


    


    
       <input type="hidden" name="id_client" value="<?= $id_client ?> ">
    


    <div class="champ">
        <label>EVENEMENTS *</label>

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <select name="id_evenement" required>
                  <option value="">Sélectionnez l'evenement correspondant</option>
                  <?php foreach($evenement as $e): ?>
                     <option value="<?= $e['id_evenement'] ?>">
                           <?= $e['libelle_evenement'] ?>
                     </option>
                  <?php endforeach; ?>
             </select>
         </div>
    </div>


    <div class="champ">
        <label>OFFRES *</label>

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <select name="id_offre" required>
                  <option value="">Sélectionnez l'offre qui vous convient</option>
                  <?php foreach($offre as $o): ?>
                     <option value="<?= $o['id_offre'] ?>">
                           <?= $o['description']." (".$o['prix'].")" ?>
                     </option>
                  <?php endforeach; ?>
             </select>
         </div>
    </div>
         
      <button type="submit" formaction="reservation_ajouter.php" class="btn-reservation">
            CONTINUER LA RESERVATION
        </button> 
   </form>
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

<?php


?>