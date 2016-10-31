<?php
require_once 'model/propietario.php';

class PropietarioController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Propietario();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/propietario/propietario.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $pro = new Propietario();
        
        if(isset($_REQUEST['id_cedulapro'])){
            $pro = $this->model->Obtener($_REQUEST['id_cedulapro']);
        }
        
        require_once 'view/header.php';
        require_once 'view/propietario/propietario-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $pro = new Propietario();
        
        $pro->id_cedulapro = $_REQUEST['id_cedulapro'];
        $pro->nombre = $_REQUEST['nombre'];
        $pro->apellido = $_REQUEST['apellido'];
        
        $pro2 = new Propietario();
        $pro2 = $this->model->Obtener($_REQUEST['id_cedulapro']);

        $bandera = false;
        foreach($this->model->Listar() as $r){
            if($r->id_cedulapro == $_REQUEST['id_cedulapro']){
                $bandera = true;
            }
        }
        
        $bandera == true
            ? $this->model->Actualizar($pro)
            : $this->model->Registrar($pro);

        header('Location: ./?c=propietario');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_cedulapro']);
        header('Location: ./?c=propietario');
    }
}