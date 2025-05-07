<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php
    //variables de connexion
    $host = 'localhost';
    $dbname = 'Gestion_de_note'; //Changer avec le nom de notre base de données 
    $username = 'root'; //$username = 'root';
    $password = ''; //$password = '';
    
    try {
        $bdd = new PDO(
            'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8',
            $username,
            $password
        );
    } catch (Exception $e) {
        // Si erreur, tout arrêter
        die('Erreur : ' . $e->getMessage());
    }
    ?>

    <h2>Connexion</h2>
    <form action="reponse.php" method="get">

        <label for="prenom">Entrez votre prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>


        <label for="nom">Entrez votre nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>


        <button type="submit">Envoyer</button>
    </form>
</body>

</html>