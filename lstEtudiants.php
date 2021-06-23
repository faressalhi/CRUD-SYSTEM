<?php
require "conn.php"; 
  // récupérer tous les utilisateurs
  $sql = "SELECT * FROM Etudiant ORDER BY NOM";
   
  try{
   $conn;
   $stmt = $conn->query($sql);
   
   if($stmt === false){
    die("Erreur");
   }
   
  }catch (PDOException $e){
    echo $e->getMessage();
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Afficher la table users</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<?php include_once "header.php" ?>
 <h1>Liste des étudiants</h1>
 <table id="affichage">
   <thead>
     <tr>
       <th>Cin | </th> <hr>
       <th>Nom | </th>
       <th>Prénom | </th>
       <th>Sexe | </th>
       <th>Modif/Suppr</th>
     </tr>
   </thead>
   <tbody>
     <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
     <tr>
       <td><?php echo htmlspecialchars($row['NCIN']); ?> | </td>
       <td><?php echo htmlspecialchars($row['NOM']); ?> | </td>
       <td><?php echo htmlspecialchars($row['PRENOM']); ?> | </td>
       <td><?php echo htmlspecialchars($row['SEXE']); ?>  | </td>
       <td><a href="modif_Etudiant.php?ref=<?php echo htmlspecialchars($row['NCIN'])?>";>Modifier</a>
          / <a href="suppr_Etudiant.php?ref=<?php echo htmlspecialchars($row['NCIN'])?>&nom=<?php echo htmlspecialchars($row['NOM'])?>&pre=<?php echo htmlspecialchars($row['PRENOM'])?>";>
            Supprimer</a></td>
     </tr>     
     <?php endwhile; ?>
   </tbody>
 </table>
<?php include_once "footer.php"; ?>
</body>
</html>