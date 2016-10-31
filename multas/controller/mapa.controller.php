<?php
//require_once 'model/Mapa.php';

class MapaController{
    
    //private $model;
    
    public function __CONSTRUCT(){
        //$this->model = new Mapa();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/mapa/mapa.php';
        require_once 'view/footer.php';
    }
}