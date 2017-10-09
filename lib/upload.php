<?php  
	function moveImage($file){
		$flag = FALSE;
		$uploaddir = '../view/midia/';
		$tipos = ['.png', '.jpg', '.gif'];
		$uploadfile = $uploaddir . basename($file['name']);
		for ($i=0; $i < count($tipos); $i++) { 
			$tipo_file = strpbrk($file['name'] , '.');
			if ($tipo_file == $tipos[$i]) {
				$flag = TRUE;
				break;
			}
		}
		if ($flag === TRUE) {
			if ($file['error'] == 2) {
				echo "Arquivo excede o tamanho solicitado<br/>";
			}else{	
				if (move_uploaded_file($file['tmp_name'], @$uploadfile)) {
					return TRUE;
				}else{
					echo "Arquivo não movido. De permissao de escrita para o diretorio midia/<br/>";
				}
			}
		}else{
			echo "<br/>Tipo de arquivo não especificado. ";
			return FALSE;
		}
	}
	function isImage($file){
		$flag = FALSE;
		$uploaddir = '../midia/';
		$tipos = ['/png', '/jpg', '/gif'];
		$uploadfile = $uploaddir . basename($file['name']);
		for ($i=0; $i < count($tipos); $i++) { 
			$tipo_file = strpbrk($file['type'] , '/');
			if ($tipo_file == $tipos[$i]) {
				$flag = TRUE;
				break;
			}
		}
		return $flag;
	}
	function imageIsEmpty($file){
		if (empty($file)) {
			return TRUE;
		}
		return FALSE;
	}
?>