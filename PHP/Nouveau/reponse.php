<?php
//variables de connexion
include('bdd.php');
$host = 'localhost';
$dbname = 'gestion_de_notes_v2'; //Changer avec le nom de notre base de données
$username = 'root'; //$username = 'root';
$password = ''; //$password = '';
try {
    $bdd = new PDO('mysql:host='. $host .';dbname='. $dbname .';charset=utf8',
    $username, $password);
    echo 'connexion établie <br>' ; //vérifie la connexion
} catch(Exception $e) {
    // Si erreur, tout arrêter
    die('Erreur : '. $e->getMessage());
}



if (isset($_GET['prenom']) && isset($_GET['nom'])) {
    $prenom = htmlspecialchars($_GET['prenom']);
    $nom = htmlspecialchars($_GET['nom']);

    // Requête SQL préparée
    $requete = $bdd->prepare("SELECT Id FROM eleves WHERE Prenom = :prenom AND Nom = :nom");
    $requete->execute([
        'prenom' => $prenom,
        'nom' => $nom
    ]);

    $ligne = $requete->fetch(PDO::FETCH_ASSOC);

    if ($ligne) {
        echo "ID trouvé : " . $ligne['Id'];
    } else {
        echo "Aucun élève trouvé avec ce prénom et ce nom.";
    }

    // Au lieu d'utiliser une bdd, on met directement dans le code les identifiants
    // On a trois étudiants
    /*if (($prenom == "Alban") &&($nom == "Campioni"))
    {
        echo "Salut Alban !";
    }

    else if (($prenom == "Lucas") &&($nom == "Hermouet"))
    {
        echo "Salut Lucas!";
    }

    else if (($prenom == "Lucia") &&($nom == "Dufond"))
    {
        echo "Salut Lucia !";
    }

    else
    {
        echo "L'identifiant ne correspond pas.";
    }

    $bddHelper = new BDDHelper(Host: 'localhost', DbName: 'ProjetWebS6', Username: 'root', Password: '');
    

    $requete = 'SELECT Id FROM `eleves` WHERE Prenom LIKE ' . $prenom . ' AND Nom LIKE ' . $nom . ';';
    $resultat = $bdd->query($requete);
    $ligne = $resultat->fetch();  // On récupère la première ligne
    echo $ligne;*/
    

} else {
    echo "Erreur : données manquantes.";
}


?>