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
?>
<body>
<?php include_once "header.php" ?>
<?php
    @$c = $_GET["ref"];
    @$n = $_GET["nom"];
    @$p = $_GET["pre"];
?>
    <h1>Suppression d'un étudiant</h1>
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

        <table>
            <tr>
                <td> NCIN </td>
                <td> <input type="text" name="ncin" value="<?php echo htmlspecialchars($c); ?>" readonly></td>
            </tr>
            <tr>
                <td> <input type="hidden" name="nom" value="<?php echo htmlspecialchars($n); ?>"></td>
            </tr>
            <tr>
                <td> <input type="hidden" name="prenom" value="<?php echo htmlspecialchars($p); ?>"></td>
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
    $sql = "DELETE FROM Etudiant WHERE NCIN=?";
    $stmt = $conn->prepare($sql);
// upadte 
    @$ncin = $_POST["ncin"];
    @$nom = $_POST["nom"];
    @$prenom = $_POST["prenom"];
if (!empty($ncin)) {    
    
    $stmt->execute([$ncin]);

    echo "<h2 style='color: purple; text-decoration: none; font-family: \"Pacifico\", cursive;'>Données supprimées de $nom $prenom </h2> <br>";
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