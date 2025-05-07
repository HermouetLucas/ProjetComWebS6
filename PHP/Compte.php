<?php
class Compte
{
    private $id;
    private $identifiant;
    private $mdp;

    private $bdd;

    function __construct($Id, $Identifiant, $Mdp)
    {
        $this->id = $Id;
        $this->identifiant = $Identifiant;
        $this->mdp = $Mdp;
        $bddHelper = new BDDHelper(Host: 'localhost', DbName: 'ProjetWebS6', Username: 'root', Password: '');
        $this->bdd = $bddHelper->getBdd();

    }

    public function Connect()
    {
        $requete = 'SELECT Id FROM `Compte` WHERE Identifiant LIKE ' . $this->identifiant . ' AND Mdp LIKE ' . $this->mdp . ';';
        $resultat = $this->bdd->query($requete);
        $tab = $resultat->fetchall(PDO::FETCH_ASSOC);
    }
}


?>