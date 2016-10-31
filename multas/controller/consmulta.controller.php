<?php
require_once 'model/multa.php';

class ConsmultaController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Multa();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/multa/consmulta.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $mul = new Multa();
        
        if(isset($_REQUEST['id_multa'])){
            $mul = $this->model->Obtener($_REQUEST['id_multa']);
        }
        
        require_once 'view/header.php';        
        require_once 'view/footer.php';
    }
    

    
  
}