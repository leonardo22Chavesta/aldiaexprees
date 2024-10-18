<?php

class Conexion {

    private $usuario = "g4leonardodb";
    private $password = "Grupo456";
    private $servidor = "g4-leonardo-db.mysql.database.azure.com";
    private $base = "aldiaexpressdb";

    private $opciones = [ 
        PDO::MYSQL_ATTR_SSL_CA => '/dev/null',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,

    ];

    public function Conectar(){

        try{
            $cnx = new PDO("mysql:host=$this->servidor; dbname=$this->base;",
                             $this->usuario, $this->password, $this->opciones);
            
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $cnx;
        }catch ( PDOException $ex) {
            echo "Hubo un error: ".$ex->getMessage();
        }
    }
}