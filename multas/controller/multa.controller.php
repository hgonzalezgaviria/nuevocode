<?php
require_once 'model/multa.php';

class MultaController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Multa();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/multa/multa.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $mul = new Multa();
        
        if(isset($_REQUEST['id_multa'])){
            $mul = $this->model->Obtener($_REQUEST['id_multa']);
        }
        
        require_once 'view/header.php';
        require_once 'view/multa/multa-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $mul = new Multa();
        
        $mul->id_multa = $_REQUEST['id_multa2'];
        $mul->fecha_multa = $_REQUEST['fecha_multa'];
        $mul->id_placa = $_REQUEST['id_placa'];
        $mul->descripcion_multa = $_REQUEST['descripcion_multa'];
        $mul->estado_multa = $_REQUEST['estado_multa'];
        $mul->valor_multa = $_REQUEST['valor_multa'];
        
        $mul2 = new Multa();
        $mul2 = $this->model->Obtener($_REQUEST['id_multa2']);

        $bandera = false;
        foreach($this->model->Listar() as $r){
            if($r->id_multa == $_REQUEST['id_multa2']){
                $bandera = true;
            }
        }
        
        $bandera == true
            ? $this->model->Actualizar($mul)
            : $this->model->Registrar($mul);

        header('Location: ./?c=multa');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_multa']);
        header('Location: ./?c=multa');
    }
}