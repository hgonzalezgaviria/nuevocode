<?php
require_once 'model/usuario.php';

class UsuarioController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Usuario();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $usu = new Usuario();
        
        if(isset($_REQUEST['id_usuario'])){
            $usu = $this->model->Obtener($_REQUEST['id_usuario']);
        }
        
        require_once 'view/header.php';
        require_once 'view/usuario/usuario-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $usu = new Usuario();
        

        $usu->id_usuario = $_REQUEST['id_usuario2'];
        $usu->nombre = $_REQUEST['nombre'];
        $usu->password = $_REQUEST['password'];
        $usu->tipo_usuario = $_REQUEST['tipo_usuario'];
        $usu->id_propietario = $_REQUEST['id_propietario'];
        
        $usu2 = new Usuario();
        $usu2 = $this->model->Obtener($_REQUEST['id_usuario2']);

        $bandera = false;
        foreach($this->model->Listar() as $r){
            if($r->id_usuario == $_REQUEST['id_usuario2']){
                $bandera = true;
            }
        }
            
        $bandera == true
            ? $this->model->Actualizar($usu)
            : $this->model->Registrar($usu);

        //echo $_REQUEST['id_usuario2'];

        header('Location: ./?c=usuario');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_usuario']);
        header('Location: ./?c=usuario');
    }
}