<?php
//variables de connexion
$host = 'localhost';
$dbname = 'gestion_de_notes_v2'; //Changer avec le nom de notre base de données
$username = 'root'; //$username = 'root';
$password = ''; //$password = '';
try {
    $bdd = new PDO('mysql:host='. $host .';dbname='. $dbname .';charset=utf8',
    $username, $password);
} catch(Exception $e) {
    // Si erreur, tout arrêter
    die('Erreur : '. $e->getMessage());
}



if (isset($_GET['prenom']) && isset($_GET['nom'])) {
    $prenom = htmlspecialchars($_GET['prenom']);
    $nom = htmlspecialchars($_GET['nom']);

    // Requête SQL préparée
    $requeteId = $bdd->prepare("SELECT Id FROM eleves WHERE Prenom = :prenom AND Nom = :nom");
    $requeteId->execute([
        'prenom' => $prenom,
        'nom' => $nom
    ]);

    $eleve = $requeteId->fetch(PDO::FETCH_ASSOC);

    if ($eleve) {
        $idEleve = $eleve['Id'];
        echo "Bienvenue ".$prenom." ".$nom.' !</br>';
        echo "Identifiant : " . $idEleve."<br>";

       /* // Requête préparée pour les notes
        $requeteNotes = $bdd->prepare("SELECT Note FROM notes WHERE IdEleves = :idEleve");
        $requeteNotes->execute(['idEleve' => $eleve['Id']]);*/

        /*$requeteNotes = $bdd->prepare("SELECT Note FROM notes WHERE IdEleve LIKE (SELECT Id FROM eleves WHERE Prenom = :prenom AND Nom = :nom) ");
        $requeteNotes-> execute([
            'prenom' => $prenom,
            'nom' => $nom
        ]);

        $notes = $requeteNotes->fetchAll(PDO::FETCH_COLUMN); // récupère juste la colonne 'Note'

            echo "Notes de l'élève :<br>";
            foreach ($notes as $note) {
                $requeteMatiere = $bdd->prepare("SELECT Libelle FROM matieres WHERE Id LIKE (SELECT idMatiere FROM notes WHERE IdEleve LIKE (SELECT Id FROM eleves WHERE Prenom = :prenom AND Nom = :nom))");
                $requeteMatiere -> execute([ //ligne où l'erreur est annoncée
                    'prenom' => $prenom,
                    'nom' => $nom
                ]);
                $matiere = $requeteMatiere->fetchall(PDO::FETCH_COLUMN);
                echo "-".$matiere[0].": ".$note." <br>"; //Il n'y a qu'un seul élément dans le tableau matiere
            }
        }*/

        // Récupération des notes + matières en une seule requête
        $requete = $bdd->prepare("
        SELECT notes.Note, matieres.Libelle
        FROM notes
        INNER JOIN matieres ON notes.idMatiere = matieres.Id
        WHERE notes.IdEleve = (
            SELECT Id FROM eleves
            WHERE Prenom = :prenom AND Nom = :nom
            LIMIT 1)
        ");

        $requete->execute([
        'prenom' => $prenom,
        'nom' => $nom
        ]);

        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

        if ($donnees) {
            echo "Notes de l'élève :<br>";
            foreach ($donnees as $ligne) {
                echo "- " . $ligne['Libelle'] . " : " . $ligne['Note'] . "<br>";
            }
        }
    }

    else {
        echo "Erreur dans le nom ou le prénom.";
    }
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
    



?>