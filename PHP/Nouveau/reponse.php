<?php
if (isset($_GET['prenom']) && isset($_GET['nom'])) {
    $prenom = htmlspecialchars($_GET['prenom']);
    $nom = $_GET['nom'];

    // Au lieu d'utiliser une bdd, on met directement dans le code les identifiants
    // On a trois étudiants
    if (($prenom == "Alban") &&($nom == "Campioni"))
    {
        echo "Salut Alban!";
    }

    else if (($prenom == "Lucas") &&($nom == "Hermouet"))
    {
        echo "Salut Lucas!";
    }

    else if (($prenom == "Lucia") &&($nom == "Dufond"))
    {
        echo "Salut Lucia!";
    }

    else
    {
        echo "L'identifiant ne correspond pas.";
    }
    

} else {
    echo "Erreur : données manquantes.";
}
?>