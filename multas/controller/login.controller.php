<?php
require_once 'model/login.php';

class LoginController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Login();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/login/login.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $usu = new Login();
        
        if(isset($_REQUEST['id_usuario'])){
            $usu = $this->model->Obtener($_REQUEST['id_usuario']);
        }
        
        require_once 'view/header.php';
        require_once 'view/login/login.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $usu = new Login();
        

        $usu->id_Login = $_REQUEST['id_usuario2'];
        $usu->nombre = $_REQUEST['nombre'];
        $usu->password = $_REQUEST['password'];
        $usu->tipo_Login = $_REQUEST['tipo_Login'];
        $usu->id_propietario = $_REQUEST['id_propietario'];
        
        $usu2 = new Login();
        $usu2 = $this->model->Obtener($_REQUEST['id_usuario2']);

        $bandera = false;
        foreach($this->model->Listar() as $r){
            if($r->id_Login == $_REQUEST['id_usuario2']){
                $bandera = true;
            }
        }
            
        $bandera == true
            ? $this->model->Actualizar($usu)
            : $this->model->Registrar($usu);

        //echo $_REQUEST['id_Login2'];

        header('Location: index.php');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_Login']);
        header('Location: index.php');
    }
}