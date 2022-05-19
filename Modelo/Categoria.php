<?php
class Categoria{
    //Definición de atributos
    private $idCategoria; //El atributo idCategoria
    private $nombre; //El atributo nombre

    //Definir el constructor de la clase
    //Es estándar para cualquier proyecto php
    public function __construct(){

    }
    /*
    public function __construct($e_id,$e_nombre){//Constructor lleno
        $this->id = $e_id;
        $this->nombre = $e_nombre;
    }*/
    
    //Definir los métodos set: Asignar valores a los atributos
    public function setidCategoria($e_idCategoria){
        $this->idCategoria = $e_idCategoria; //Asigna al atributo id la variable $id
    }

    public function setnombre($e_nombre){
        $this->nombre = $e_nombre; //$e_nombre:entrada nombre
    }

    //Definir los métodos get: Obtener los valores de los atributos.

    public function getidCategoria(){
        return $this->idCategoria; //Retornar el valor del atributo id
    }

    public function getnombre(){
        return $this->nombre; //Retornar el valor del atributo nombre
    }
}

?>