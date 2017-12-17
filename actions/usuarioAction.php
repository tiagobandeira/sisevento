<?php 
require '../control/UsuarioController.php';

if(isset($_POST)){
    $usuario = $Usuario->get();
    echo $Usuario->add($_POST);
    print_r($usuario->getLastId());
}
?>