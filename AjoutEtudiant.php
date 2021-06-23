<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout etudiant</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<!-- fichier de connection au bd -->
<?php
require "conn.php";
?>
<body>
    <!-- header de la page -->
    <?php include_once "header.php" ?>
    <h1>Ajout d'un nouveau étudiant</h1>
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

        <table>
            <tr>
                <td> NCIN </td>
                <td> <input type="text" name="ncin" value=""></td>
            </tr>
            <tr>
                <td> NOM </td>
                <td> <input type="text" name="nom" value=""></td>
            </tr>
            <tr>
                <td> PRENOM </td>
                <td> <input type="text" name="prenom" value=""></td>
            </tr>
            <tr>
                <td> SEXE </td>
                <td> <select name="sexe" class="select-css">
                    <option value="homme" selected>Homme</option>
                    <option value="femme">Femme</option>
                </select></td>
            </tr>
        </table>
    <br>
<?php
require "conn.php"; 


try {
    $conn;
// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// preparer sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO Etudiant (NCIN, NOM, 
PRENOM, SEXE) 
VALUES (:ncin, :nom, :prenom, :sexe)");
    $stmt->bindParam(':ncin', $ncin);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':sexe', $sexe);

// inserer colonne
    @$ncin = $_POST["ncin"];
    @$nom = $_POST["nom"];
    @$prenom = $_POST["prenom"];
    @$sexe = $_POST["sexe"];
// vérifier l'existence
    $verif = $conn->prepare("SELECT * FROM Etudiant WHERE NCIN=?");
    $verif->execute([$ncin]); 
    $v = $verif->fetch();
    if ($v) {
        // user existe
        echo "<h2 style='color: red; text-decoration: none; font-family: \"Pacifico\", cursive;'>Etudiant déja existant avec cin = $ncin   !</h2>";
    }  
    else { 

    if (!empty($ncin) && !empty($nom) && !empty($prenom) && !empty($sexe)) {    
        $stmt->execute();
        echo "<h2 style='color: purple; text-decoration: none; font-family: \"Pacifico\", cursive;'>Données enregistrées avec CIN = $ncin</h2>";
}
}
}
catch(PDOException $e)
{
    // echo "Error: " . $e->getMessage();
}

$conn = null;
?>
        <br> 
        <input type="submit" value="valider">
        <input type="reset" value="annuler">
    </form>
    
<?php include_once "footer.php"; ?>
</body>
</html>