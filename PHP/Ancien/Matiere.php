<?php
class Matiere
{
    private $id;
    private $idProf;
    private $libelle;

    private $bdd;

    function __construct($Id, $IdProf, $Libelle)
    {
        $this->id = $Id;
        $this->idProf = $IdProf;
        $this->libelle = $Libelle;
        $bddHelper = new BDDHelper(Host: 'localhost', DbName: 'ProjetWebS6', Username: 'root', Password: '');
        $this->bdd = $bddHelper->getBdd();

    }

    public function GetIdMatiere()
    {
        $requete = 'SELECT Id FROM `Matiere` WHERE IdProf LIKE ' . $this->idProf . ' AND Libelle LIKE ' . $this->libelle . ';';
        $resultat = $this->bdd->query($requete);
        $tab = $resultat->fetchall(PDO::FETCH_ASSOC);
    }
}


?>