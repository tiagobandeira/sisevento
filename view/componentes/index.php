<?php  
/*
  @About
  Autor: Tiago Bandeira
  SisEvento 
  Versão: 1.0
*/
  session_start();
  $id = 1; #$_SESSION['id'];
  
  $user = new UsuarioModel();
  $result = $user->readById();
  if($result != null){
      $user->setNome($result->getNome());
      $user->setEmail($result->getEmail());
      $user->setTipo($result->getTipo());

      if($user->getTipo() == 1){
          require_once 'administrador.php';
      }else if($user->getTipo() == 2){
          require_once 'participante.php';
      }else{
          require_once 'usuario.php';
      }
  }



?>
