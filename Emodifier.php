<?php
session_start();

require '../../config/database.php';

if(!isset($_SESSION['nom']) && !isset($_SESSION['droit'])){
    header("location: ../auth/login.php");
}

$evenement = $pdo->query("SELECT * FROM evenement")->fetchall();

$id_evenement = $_GET['id_evenement'];

$req = "
SELECT * 
FROM evenement
WHERE id_evenement=?";

$stmt = $pdo->prepare($req);
$stmt ->execute([
    $id_evenement
]);

$e = $stmt->fetch();

if(empty($e)){
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
                <input type="hidden" name="id_evenement"  value="<?= $e['id_evenement'] ?>">
            </td>
        </tr>

        <tr>
            <td>
                <label>
                    EVENEMENT:
                </label>
            </td>
            <td>
                <input type="text" name="libelle_evenement" value="<?= $e['libelle_evenement'] ?>">
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
            <input type="submit" value="ANNULER" formaction="../../admin/evenement.php">
        </td>

      </tr>
     </table>

    </form>
</body>
</html>


