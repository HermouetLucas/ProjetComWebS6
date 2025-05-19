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
    
    // Requête SQL préparée pour récupérer l'ID de l'élève
    $requeteId = $bdd->prepare("SELECT Id FROM eleves WHERE Prenom = :prenom AND Nom = :nom");
    $requeteId->execute([
        'prenom' => $prenom,
        'nom' => $nom
    ]);

    // Récupération de l'élève
    $eleve = $requeteId->fetch(PDO::FETCH_ASSOC);

    // Si l'élève est trouvé
    if ($eleve) {
        $idEleve = $eleve['Id'];

        // Récupération des notes et matières
        $requete = $bdd->prepare("
            SELECT notes.Note, matieres.Libelle
            FROM notes
            INNER JOIN matieres ON notes.idMatiere = matieres.Id
            WHERE notes.IdEleve = :id
        ");
        $requete->execute([
            'id' => $idEleve
        ]);

        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

        // Retourner les résultats sous format JSON
        $json = json_encode($donnees, JSON_UNESCAPED_UNICODE);
        echo '{"vals":' . $json . '}';
    } else {
        // Si aucun élève n'est trouvé, envoyer une réponse de type "not found"
        echo '{"vals":[]}';
    }
}




?>