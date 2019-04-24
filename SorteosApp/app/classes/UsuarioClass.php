<?php
namespace classes;

class UsuarioClass{

    private $id, $nombre, $apellido, $email, $password, $privilegio, $fecha_registro, $token;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
   
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        //$this->password = md5($password);
        $this->password = $password;
    }

    public function getPrivilegio(){
        return $this->privilegio;
    }

    public function setPrivilegio($privilegio){
        $this->privilegio = privilegio;
    }

    public function getFecha_registro(){
        return $this->fecha_registro;
    }

    public function setFecha_registro($fecha_registro){
        $this->fecha_registro = $fecha_registro;
    }

    public function getToken(){return $this->token;} 

    public function setToken(){
        $token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789';
        $token = str_shuffle($token);
        $token = substr($token,0,10);
        return $token;
    }

    public function unsetToken($token){
        $token = "";
        return $token;
    }

}
