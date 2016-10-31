<?php
require_once 'model/vehiculo.php';

class VehiculoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Vehiculo();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/vehiculo/vehiculo.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $veh = new Vehiculo();
        
        if(isset($_REQUEST['id_placa'])){
            $veh = $this->model->Obtener($_REQUEST['id_placa']);
        }
        
        require_once 'view/header.php';
        require_once 'view/vehiculo/vehiculo-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $veh = new Vehiculo();
        
        $veh->id_placa = $_REQUEST['id_placa'];
        $veh->modelo = $_REQUEST['modelo'];
        $veh->ano = $_REQUEST['ano'];
        $veh->id_cedulapro = $_REQUEST['id_cedulapro'];
        
        $veh2 = new Vehiculo();
        $veh2 = $this->model->Obtener($_REQUEST['id_placa']);

        $bandera = false;
        foreach($this->model->Listar() as $r){
            if($r->id_placa == $_REQUEST['id_placa']){
                $bandera = true;
            }
        }
        
        $bandera == true
            ? $this->model->Actualizar($veh)
            : $this->model->Registrar($veh);

        header('Location: ./?c=vehiculo');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_placa']);
        header('Location: ./?c=vehiculo');
    }
}