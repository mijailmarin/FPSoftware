<?php
namespace classes;
use PDO;
class DatabaseClass{
    public static function connectDB()
    {
        try{
            $cn = new PDO("mysql:host=localhost;dbname=sorteos_app", "root", "");
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $cn;
        } 
        catch (PDOException $ex){
            die($ex->getMessage());
        }
    }
}
?>