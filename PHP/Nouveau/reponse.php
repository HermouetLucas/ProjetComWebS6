<?php
//header nécessaire
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
//variables de connexion
$host = 'localhost';
$dbname = 'lhermouet'; //Changer avec le nom de notre base de données
$username = 'lhermouet'; //$username = 'root';
$password = 'GoldenPapapoufe1*'; //$password = '';
try {
    $bdd = new PDO(
        'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8',
        $username,
        $password
    );
} catch (Exception $e) {
    // si erreur, tout arrêter
    die('Erreur : ' . $e->getMessage());
}


//une fois que l'on est connecté à la bdd on vérifie l'url pour voir les paramètre
if (isset($_GET['prenom']) && isset($_GET['nom'])) {
    $prenom = htmlspecialchars($_GET['prenom']);
    $nom = htmlspecialchars($_GET['nom']);
    
    // requête SQL préparée
    $requeteId = $bdd->prepare("SELECT Id FROM eleves WHERE Prenom = :prenom AND Nom = :nom");
    $requeteId->execute([
        'prenom' => $prenom,
        'nom' => $nom
    ]);
    //on envoie la requête pour récupérer l'ID de l'élève
    $eleve = $requeteId->fetch(PDO::FETCH_ASSOC);

    if ($eleve) {
        $idEleve = $eleve['Id'];

        // récupération des notes + matières en une seule requête
        $requete = $bdd->prepare("
        SELECT notes.Note, matieres.Libelle
        FROM notes
        INNER JOIN matieres ON notes.idMatiere = matieres.Id
        WHERE notes.IdEleve = :id
        ");
        //on récupère les notes 
        $requete->execute([
            'id' => $idEleve
        ]);

        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

        $json = json_encode($donnees, JSON_UNESCAPED_UNICODE);
        echo '{"vals":' . $json . '}';
    }
}

?>