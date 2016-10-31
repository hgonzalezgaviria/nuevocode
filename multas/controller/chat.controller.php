<?php
//require_once 'model/Chat.php';

class ChatController{
    
    //private $model;
    
    public function __CONSTRUCT(){
        //$this->model = new Chat();
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/chat/chat.php';
        require_once 'view/footer.php';
    }

    public function Send(){
        $msg = $_REQUEST['msg'];

        echo $msg ;
        //header('Location: index.php');
    }
}