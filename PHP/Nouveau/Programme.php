

<?php
//variables de connexion
$host = 'localhost'; 
$dbname = 'Gestion_de_note'; //Changer avec le nom de notre base de données 
$username = 'root'; //$username = 'root';
$password = ''; //$password = '';

try {
    $bdd = new PDO('mysql:host='. $host .';dbname='. $dbname .';charset=utf8',
    $username, $password);
} catch(Exception $e) {
    // Si erreur, tout arrêter
    die('Erreur : '. $e->getMessage());
}
?>

