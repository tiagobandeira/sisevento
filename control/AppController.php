<?php
	/**
  * Autor: Tiago Bandeira
	* class AppController
	*@
  */
  require_once '../model/UsuarioModel.php';
  require_once '../model/EventoModel.php';
  require_once '../model/CertificadoModel.php';
  require_once '../model/TipoCertificadoModel.php';
  require_once '../model/CodigoUsuarioModel.php';
  class AppController
  {
    private $usuarioModel;
    private $eventoModel;
    private $certificadoModel;
    private $codigoUsuarioModel;
    private $tipoCertificadoModel;

    function __construct()
    {
      $this->usuarioModel = new UsuarioModel();
      $this->eventoModel = new EventoModel();
      $this->certificadoModel = new CertificadoModel();
      $this->tipoCertificadoModel = new TipoCertificadoModel();
      $this->codigoUsuarioModel = new CodigoUsuarioModel();
    }
    public function getObgs($codigo = null)
    {
      $objCodigo = $this->codigoUsuarioModel->readById($codigo);
      $objUsuario = $this->usuarioModel->readById($objCodigo->getUsuario());
      $objEvento = $this->eventoModel->readById($objCodigo->getEvento());
      $objCertificado = $this->certificadoModel->readByEvento($objEvento->getId());
      $objTipoCertificado = $this->tipoCertificadoModel->readById($objCertificado->getTipo());
      $objs = [
        "usuario" => $objUsuario,
        "codigo" => $objCodigo,
        "evento" => $objEvento,
        "certificado" => $objCertificado,
        "tipoCertificado" => $objTipoCertificado
      ];
      return $objs;
    }
  }

  $Aplication = new AppController();

?>
