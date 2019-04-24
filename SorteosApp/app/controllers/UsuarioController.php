<?php
namespace controllers;
use \models\UsuarioModel as UsuarioModel;
use \classes\UsuarioClass as UsuarioClass;
use \classes\SorteoClass as SorteoClass;

class UsuarioController{

    public static function login($email, $password){
        $obj_usuario = new UsuarioClass();
        $obj_usuario->setEmail($email);
        $obj_usuario->setPassword($password);
        return UsuarioModel::login($obj_usuario);
    }

    public function getUsuario($email, $password){
        $obj_usuario = new UsuarioClass();
        $obj_usuario->setEmail($email);
        $obj_usuario->setPassword($password);
        return UsuarioModel::getUsuario($obj_usuario);
    }  

    public function registrar($nombre, $apellido, $email, $password){
        $obj_usuario = new UsuarioClass();
        $obj_usuario->setNombre($nombre);
        $obj_usuario->setApellido($apellido);
        $obj_usuario->setEmail($email);
        $obj_usuario->setPassword($password);
        return UsuarioModel::registrar($obj_usuario);
    }

    public static function getSorteos($id){
        $obj_sorteo = new SorteoClass();
        $obj_sorteo->setId($id);
        return UsuarioModel::getSorteos($obj_sorteo);
    }

    public function setSorteo($titulo, $participantes, $id){
        $obj_sorteo = new SorteoClass();
        $obj_sorteo->setUserID($id);
        $obj_sorteo->setTitulo($titulo);
        $obj_sorteo->setParticipantes($participantes);
        $obj_sorteo->setGanador($participantes);
        return UsuarioModel::setSorteo($obj_sorteo);
    }

    public static function deleteSorteo($id){
        $obj_sorteo = new SorteoClass();
        $obj_sorteo->setId($id);
        return UsuarioModel::deleteSorteo($obj_sorteo);
    }
}
