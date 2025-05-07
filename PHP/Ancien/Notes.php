<?php
class Notes
{
    private $note;

    private $bdd;

    function __construct()
    {
        
        $bddHelper = new BDDHelper(Host: 'localhost', DbName: 'ProjetWebS6', Username: 'root', Password: '');
        $this->bdd = $bddHelper->getBdd();

    }

    public function GetIdNotes($Note)
    {
        $this->note = $Note;
        $requete = 'SELECT Id FROM `Notes` WHERE Note LIKE ' . $this->Note .';';
        $resultat = $this->bdd->query($requete);
        $tab = $resultat->fetchall(PDO::FETCH_ASSOC);
    }
}


?>