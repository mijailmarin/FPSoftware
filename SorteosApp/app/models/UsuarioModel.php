<?php
namespace models;
use \classes\UsuarioClass as UsuarioClass;
use \classes\SorteoClass as SorteoClass;
use \classes\DatabaseClass as DatabaseClass;

class UsuarioModel{
    protected static $dbh;

    private static function getDatabaseClass(){
        self::$dbh = DatabaseClass::connectDB();
    }

    private static function desconectar(){
        self::$dbh = null;
    }

    public static function login($user){
        $query = "SELECT * FROM usuarios WHERE correo = :email AND password = :password";
        self::getDatabaseClass();
        $queryResult = self::$dbh->prepare($query);
        $queryResult->bindValue(":email", $user->getEmail());
        $queryResult->bindValue(":password", $user->getPassword());
        $queryResult->execute();
        if ($queryResult->rowCount() > 0) {
            $queryRows = $queryResult->fetch();
            if ($queryRows["correo"] == $user->getEmail()
                && $queryRows["password"] == $user->getPassword()){
                return true;
            }
        }
        return false;
    }
   
    public static function getUsuario($user){
        $query = "SELECT * FROM usuarios WHERE correo = :email AND password = :password";
        self::getDatabaseClass();
        $queryResult = self::$dbh->prepare($query);
        $queryResult->bindValue(":email", $user->getEmail());
        $queryResult->bindValue(":password", $user->getPassword());
        $queryResult->execute();
        $queryRows = $queryResult->fetch();
        $user = new UsuarioClass();
        $user->setId($queryRows["id"]);
        $user->setNombre($queryRows["nombre"]);
        $user->setApellido($queryRows["apellido"]);
        $user->setEmail($queryRows["correo"]);
        $user->setPrivilegio($queryRows["privilegio"]);
        $user->setFecha_registro($queryRows["fecha_registro"]);
        $user->setToken($queryRows["token"]);
        return $user;
    }

    public static function registrar($user){
        $query = "INSERT INTO usuarios (nombre,apellido,correo,password,privilegio,token) VALUES (:nombre,:apellido,:email,:password,2,:token)";
        self::getDatabaseClass();
        $queryResult = self::$dbh->prepare($query);
        $queryResult->bindValue(":nombre", $user->getNombre());
        $queryResult->bindValue(":apellido", $user->getApellido());
        $queryResult->bindValue(":email", $user->getEmail());        
        $queryResult->bindValue(":password", $user->getPassword());
        $queryResult->bindValue(":token", $user->setToken());
        if ($queryResult->execute()) {
            return true;
        }
        return false;
    }

    public static function getSorteos($obj_sorteo){
        $query = "SELECT * FROM sorteos INNER JOIN usuarios ON sorteos.uid = usuarios.id WHERE uid = :id";
        self::getDatabaseClass();
        $queryResult = self::$dbh->prepare($query);
        $queryResult->bindValue(":id", $obj_sorteo->getId());
        $queryResult->execute();
        $sorteos = $queryResult->fetchAll();
        return $sorteos;
    }

    public static function setSorteo($obj_sorteo){
        $query = "INSERT INTO sorteos (uid,titulo,participantes,ganador) VALUES (:uid,:titulo,:participantes,:ganador)";
        self::getDatabaseClass();
        $queryResult = self::$dbh->prepare($query);
        $queryResult->bindValue(":uid", $obj_sorteo->getUserID());
        $queryResult->bindValue(":titulo", $obj_sorteo->getTitulo());
        $queryResult->bindValue(":participantes", $obj_sorteo->getParticipantes());
        $queryResult->bindValue(":ganador", $obj_sorteo->getGanador());
        if ($queryResult->execute()) {
            return true;
        }
        return false;
    }

    public static function deleteSorteo($obj_sorteo){
        $query = "DELETE FROM sorteos WHERE id = :id";
        self::getDatabaseClass();
        $queryResult = self::$dbh->prepare($query);
        $queryResult->bindValue(":id", $obj_sorteo->getId());
        if ($queryResult->execute()) {
            return true;
        }
        return false;
    }

}
