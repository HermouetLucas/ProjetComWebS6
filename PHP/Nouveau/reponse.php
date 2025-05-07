<?php
if (isset($_GET['prenom']) && isset($_GET['nom'])) {
    $prenom = htmlspecialchars($_GET['prenom']);
    $nom = $_GET['nom'];


    echo "Bonjour $prenom $nom";
} else {
    echo "Erreur : données manquantes.";
}
?>