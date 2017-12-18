<?php
require '../control/EventoController.php';
require '../control/OrganizadorController.php';
require_once '../model/OrganizadorModel.php';
require_once '../model/CodigoUsuarioModel.php';
require_once '../view/code.php';
if($_POST){
   
    $_POST['status'] = "A";
    $_POST['usuario'] = 1;
    if($Evento->add($_POST)){
        $evento = $Evento->get();
        if(!empty($_POST['org1'])){
            $_POST['evento'] = $evento->getLastId();
            print_r($Organizador->add($_POST));
            $codigoModel = new CodigoUsuarioModel();
            #$codigoModel->setCodigo(cod($organizador1->getUsuario()));
            #$codigoModel->setUsuario($organizador1->getUsuario());
            #$codigoModel->setEvento($evento->getLastId());
            #$codigoModel->setStatus("D");
            #$codigoModel->save();

            
        }
    }
    
}
?>