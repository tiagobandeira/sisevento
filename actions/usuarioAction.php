<?php 
require '../control/UsuarioController.php';
require '../control/CodigoUsuarioController.php';
require_once '../view/code.php';

if(isset($_POST)){
    $usuario = $Usuario->get();
    echo $Usuario->add($_POST);
    print_r($usuario->getLastId());

    $_POST['codigo'] = cod($_POST['evento'], $usuario->getLastId());
    $_POST['usuario'] = $usuario->getLastId();
    //$_POST['status'] = "B"; para desativar bloquear o evento
    print_r($_POST);
    echo $Codigo->add($_POST);
}
?>