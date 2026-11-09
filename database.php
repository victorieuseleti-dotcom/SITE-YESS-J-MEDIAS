<?php
$host= "localhost";
$dbname= "j_medias_ange";
$user= "root";
$pass= "";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    $pdo->SetAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
     die("eurreur:" . $e->getMessage());
}
?>