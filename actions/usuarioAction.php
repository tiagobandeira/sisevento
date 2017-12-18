<?php 
require '../control/UsuarioController.php';
require '../control/CodigoUsuarioController.php';
require_once '../view/code.php';

if(isset($_POST)){
    $tab = $_POST['tab'] != null ? $_POST['tab'] : 1;
    $usuario = $Usuario->get();
   
    if($Usuario->add($_POST)){
      if($_POST['btn'] == 'event'){
        header("Location: http://localhost/projetos/IPW/SiseventoGit/view/administrador.php?view=event&sub=event&message=1");
      }
      header("Location: http://localhost/projetos/IPW/SiseventoGit/view/administrador.php?view=users&sub=users&message=1&tab=". $tab ."");
    }
    print_r($usuario->getLastId());

    $_POST['codigo'] = cod($_POST['evento'], $usuario->getLastId());
    $_POST['usuario'] = $usuario->getLastId();
    //$_POST['status'] = "B"; para desativar bloquear o evento
    print_r($_POST);
    echo $Codigo->add($_POST);
}
?>