<?php
class BDDHelper
{
    private $host = 'localhost';
    private $dbname = 'ProjetWebS6';
    private $username = 'root';
    private $password = '';
    private $bdd;

    function __construct($Host, $DbName, $Username, $Password)
    {
        $this->host = $Host;
        $this->dbname = $DbName;
        $this->username = $Username;
        $this->password = $Password;
        $this->bdd = new PDO(
            'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8',
            $this->username,
            $this->password
        );


    }

    public function getBdd()
    {
        return $this->bdd;
    }
}


?>