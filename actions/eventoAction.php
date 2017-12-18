<?php
require '../control/EventoController.php';
require_once '../model/OrganizadorModel.php';
require_once '../model/CodigoUsuarioModel.php';
require_once '../view/code.php';
if($_POST){
   
    $_POST['status'] = "A";
    $_POST['usuario'] = 1;
    if($Evento->add($_POST)){
        $evento = $Evento->get();
        if(!empty($_POST['org1'])){
            $organizador1 = new OrganizadorModel();
            $organizador1->setUsuario($_POST['org1']);
            $organizador1->setEvento($evento->getLastId());
            $organizador1->save();
            $codigoModel = new CodigoUsuarioModel();
            $codigoModel->setCodigo(cod($organizador1->getUsuario()));
            $codigoModel->setUsuario($organizador1->getUsuario());
            $codigoModel->setEvento($evento->getLastId());
            $codigoModel->setStatus("D");
            $codigoModel->save();
        }
    }
    
}
?>