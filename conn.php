<?php 
    $user = "root";
    $pass = "";
        try {
            $conn = new PDO('mysql:host=localhost;dbname=base', $user, $pass);
            // echo "connection succeeded ";
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
?>