<?php
class Compte
{
    private $identifiant;
    private $mdp;

    private $bdd;

    function __construct()
    {
        
        $bddHelper = new BDDHelper(Host: 'localhost', DbName: 'ProjetWebS6', Username: 'root', Password: '');
        $this->bdd = $bddHelper->getBdd();

    }

    public function Connect($Identifiant, $Mdp)
    {
        $this->identifiant = $Identifiant;
        $this->mdp = $Mdp;
        $requete = 'SELECT Id FROM `Compte` WHERE Identifiant LIKE ' . $this->identifiant . ' AND Mdp LIKE ' . $this->mdp . ';';
        $resultat = $this->bdd->query($requete);
        $tab = $resultat->fetchall(PDO::FETCH_ASSOC);
    }
}


?>