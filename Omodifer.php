<?php
session_start();

require '../../config/database.php';

if(!isset($_SESSION['nom']) && !isset($_SESSION['droit'])){
    header("location: ../auth/login.php");
}

$offres = $pdo->query("SELECT * FROM offre")->fetchall();

$id_offre = $_GET['id_offre'];

$req = "
SELECT * 
FROM offre
WHERE id_offre=?";

$stmt = $pdo->prepare($req);
$stmt ->execute([
    $id_offre
]);

$o = $stmt->fetch();

if(empty($o)){
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
<body>
    <h1>
        MODIFICATION DES CHAMPS
    </h1>

    <form action="tmodifier.php" method="post">

       <table>

       <tr>
            <td>
                <input type="hidden" name="id_offre"  value="<?= $o['id_offre'] ?>">
            </td>
        </tr>

        <tr>
            <td>
                <label>
                    DESCRIPTION:
                </label>
            </td>
            <td>
                <input type="text" name="description" value="<?= $o['description'] ?>">
            </td>
        </tr>  

        <tr>
            <td>
                <label>
                    PRIX:
                </label>
            </td>
            <td>
                <input type="text" name="prix" value="<?= $o['prix'] ?>">
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
            <input type="submit" value="ANNULER" formaction="../../admin/offre.php">
        </td>

      </tr>
     </table>

    </form>
</body>
</html>


