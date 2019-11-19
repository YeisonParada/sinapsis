<?php

class Conexion{


	
    public static function conectar()
    {
        try {

            $link = new PDO("mysql:host=localhost;dbname=sinapsis",
                "root",
                "");

            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $link->exec("set names utf8");

            return $link;

        } catch (PDOException $e) {

            die("ERROR: " . $e->getMessage());

        }

    }
	

}