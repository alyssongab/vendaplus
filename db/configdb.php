<?php

function conectar(){
    try{
        $conn = new PDO("mysql:host=localhost;dbname=vplus", "root", "");
    }
    catch(PDOException $e){
        echo "Erro ao conectar " . $e->getMessage();
        $e->getCode();
    }

    return $conn;
}

?>