<?php

class Crud {
    public static function connect() {
        try {
            $con = new PDO('mysql:host=localhost;dbname=user', 'root', '');
            return $con;
        } catch (PDOException $error) {
            echo 'Something went wrong: ' . $error->getMessage(); // Show error message for debugging
            return null; // Return null on error
        }
    } // Fixed: Added closing brace for the connect method

    public static function selectData() {
        $data = array();
        $p = Crud::connect()->prepare('SELECT * FROM users'); // Changed crud to Crud (case-sensitive)
        $p->execute(); // Removed unnecessary semicolon here
        $data = $p->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
}

?>
