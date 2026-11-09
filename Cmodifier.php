<?php
session_start();

require '../../config/database.php';

if(!isset($_SESSION['nom']) && !isset($_SESSION['droit'])){
    header("location: ../auth/login.php");
}

$client = $pdo->query("SELECT * FROM client")->fetchall();

$id_client = $_GET['id_client'];

$req = "
SELECT * 
FROM client
WHERE id_client=?";

$stmt = $pdo->prepare($req);
$stmt ->execute([
    $id_client
]);

$c = $stmt->fetch();

if(empty($c)){
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
            👤CLIENT
        </h1>
        <div class="date">
            <a href="../../admin/client.php">retour</a>
        </div>

    </header>

   
  

<div class="titre" >
           

            <h2>
                Modifier les Informations
            </h2>
             
            
         </div>
    
<section class="formulaire">
    
 <form action="tmodifier.php" method="POST">

  <input type="hidden" name="id_client"  value="<?= $c['id_client'] ?>" >
    <div class="champ">
        <label>NOM </label>

        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="nom"  value="<?= $c['nom'] ?>" >
        </div>
    </div>


    <div class="champ">
        <label>PRENOM </label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="prenom"  value="<?= $c['prenom'] ?>">
        </div>
    </div>
            


    <div class="champ">
        <label>TELEPHONE </label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="telephone"  value="<?= $c['telephone'] ?>">
        </div>
    </div>


    <div class="champ">
        <label>EMAIL </label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <input type="text" name="email"  value="<?= $c['email'] ?>">
        </div>
    </div>
            

    <div class="champ">
        <label>TYPE CLIENT </label>
          
        <div class="input-box">
            <i class="fa-solid fa-user">
                
            </i>
           <select name="type_client">
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
              
       <button type="submit"  class="btn-reservation">
            SAUVEGARDER
        </button>
 </form>    
</section>
    


 </div>
</main>

<!--FOOTER
<footer>
    
        2026 J'MEDIAS. Tous droits réservés
    
</footer>


</body>
</html>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        MODIFICATION DES CHAMPS
    </h1>

    <form action="tmodifier.php" method="post">

       <table>

       <tr>
            <td>
                <input type="hidden" name="id_client"  >
            </td>
        </tr>

        <tr>
            <td>
                <label>
                    NOM:
                </label>
            </td>
            <td>
                <input type="text" name="nom" value="<?= $c['nom'] ?>">
            </td>
        </tr>

        <tr>
            <td>
                <label >PRENOMS:</label>
            </td>
            <td>
                <input type="text" name="prenom"  ">
            </td>
        </tr>

        <tr>
            <td>TELEPHONE:</td>
            <td><input type="text" name="telephone"  ></td>
        </tr>

        <tr>
            <td>
                <label>EMAIL:</label>
            </td>
            <td>
                <input type="text" name="email"  >
            </td>
        </tr>

      <tr>
        <td>
            <LAbel>TYPE CLIENT:</LAbel>
        </td>
        <td>
              <select >
                  <option >faire ton choix</option> 
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
            </td>
      </tr>
<br>
      <tr>
         <td>
            <input type="submit" value="ENREGISTER"> 
         </td>

         <td>
         </td>
        
         <td> 
            <input type="submit" value="ANNULER" formaction="../../admin/client.php">
        </td>

      </tr>
     </table>

    </form>-->
</body>
</html>


