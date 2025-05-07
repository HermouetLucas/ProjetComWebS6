<?php
class Profs
{
    private $prenom;
    private $nom;

    private $bdd;

    function __construct()
    {
        
        $bddHelper = new BDDHelper(Host: 'localhost', DbName: 'ProjetWebS6', Username: 'root', Password: '');
        $this->bdd = $bddHelper->getBdd();

    }

    public function ConnectProfs($Prenom, $Nom)
    {
        $this->prenom = $Prenom;
        $this->nom = $Nom;
        $requete = 'SELECT Id FROM `Profs` WHERE Prenom LIKE ' . $this->prenom . ' AND Nom LIKE ' . $this->nom . ';';
        $resultat = $this->bdd->query($requete);
        $tab = $resultat->fetchall(PDO::FETCH_ASSOC);
    }
}


?>