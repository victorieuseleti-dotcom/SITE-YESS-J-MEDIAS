<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/client_style.css">
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
                Information Client
            </h2>
             
            <p>
                Veuillez remplir le formulaire ci-dessous pour effectuer votre reservation.
            </p>
         </div>
    
<section class="formulaire">
    
 <form action="" method="POST">
    <div class="champ">
        <label>NOM *</label>

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="nom" placeholder="entrez votre Nom" required>
        </div>
    </div>


    <div class="champ">
        <label>PRENOM *</label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="prenom" placeholder="entrez votre Prenom" required>
        </div>
    </div>
            


    <div class="champ">
        <label>TELEPHONE *</label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="telephone" placeholder="entrez votre Telephone" required>
        </div>
    </div>


    <div class="champ">
        <label>EMAIL *</label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="email" placeholder="entrez votre E-mail" required>
        </div>
    </div>
            

    <div class="champ">
        <label>TYPE CLIENT *</label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <select name="type_client" required>
                  <option >SELECTIONNE TON TYPE</option> 
                     <option>
                            PARTICULIER(E)
                     </option>
                     <option>
                            EGLISE
                     </option>
                     <option>
                            ENTREPRISE
                     </option>
             </select>
            
        </div>
    </div>
              
       <button type="submit" formaction="client_ajouter.php" class="btn-reservation">
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