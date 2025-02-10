<?php

include('config.php');

function conectar(){

    try{
        
        $user = DB_USER;
        $password = DB_PASSWORD;

        $conn = new PDO("mysql:host=localhost;dbname=vplus", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch(PDOException $e){
        echo "Erro ao conectar " . $e->getMessage();
        $e->getCode();

        return null;
    }

}

?>