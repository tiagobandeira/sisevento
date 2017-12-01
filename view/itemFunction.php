<?php  
#Retorna uma mensagem de acordo com o item selecionado
function getItem(){
	if (isset($_GET['item']) && !empty($_GET['item'])) {
		$item = $_GET['item'] =! null?$_GET['item']:'';
      if($item == "add"){
        $msm = "Adicinar Participantes";
      }else if($item == "addE"){
      	$msm = "Adicinar Eventos";
      }else if($item == "list"){
      	$msm = "Lista de Participantes";
      }else if($item == "listC"){
        $msm = "Lista de Certificados";
      }
      return $msm;
	}
}

?>