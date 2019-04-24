<?php
namespace classes;

class SorteoClass{

    private $id, $uid, $titulo, $participantes, $ganador, $fecha_registro;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUserID(){
        return $this->uid;
    }

    public function setUserID($uid){
        $this->uid = $uid;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getParticipantes(){
        return $this->participantes;
    }

    public function setParticipantes($participantes){
        $this->participantes = $participantes;
    }

    public function getGanador(){
        return $this->ganador;
    }

    public function setGanador($participantes){  
        $this->ganador = rand(2,$participantes);
    }

    public function getFecha_registro(){
        return $this->fecha_registro;
    }

    public function setFecha_registro($fecha_registro){
        $this->fecha_registro = $fecha_registro;
    }

}
