<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout etudiant</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<?php
require "conn.php";
$ncin = @$_GET["ref"];

?>
<body>
<?php include_once "header.php" ?>
    <h1>Modification d'un étudiant</h1>
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <table>
            <tr>
                <td> NCIN </td>
                <td> <input type="text" name="ncin" value="<?php echo htmlspecialchars($ncin); ?>" readonly></td>
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
    
// prepare sql and bind parameters
    $sql = "UPDATE Etudiant SET NOM=?, PRENOM=?, SEXE=? WHERE NCIN=?";
    $stmt = $conn->prepare($sql);
// upadte

    @$c = $_POST["ncin"];
    @$nom = $_POST["nom"];
    @$prenom = $_POST["prenom"];
    @$sexe = $_POST["sexe"];

if (!empty($nom) && !empty($prenom) && isset($sexe)) {    
    
    $stmt->execute([$nom, $prenom, $sexe, $c]);

    echo "<h2 style='color: purple; text-decoration: none; font-family: \"Pacifico\", cursive;'>Données modifiées de $nom $prenom </h2> <br>";
   
}
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
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