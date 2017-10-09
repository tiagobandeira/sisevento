<?php  
/*
Autor: Tiago Bandeira
Caminho arquivo: SisEvento/database/
Nome do arquivo: executeQuery.php
Arquivo pai: database
Finalidade arquivo: Exucutar querys recevento uma string
*/

/*
	@função para executar as querys
*/
	/**
	* Query
	*/
	class Query 
	{
		var $con ;
		var $str_query;
		function __construct($con)
		{
			$this->con = $con;
		}
		function execute($str_query){
			if(!empty($str_query)){
				try{
					$query = $this->con->prepare($str_query);
					$query->execute();
					$this->str_query = $str_query;//para guardar a query
					return TRUE;
				}catch(PDOException $e){
					echo "Não foir possível executar a query" . $e;
				}
				return FALSE;
			}
		}
		function getPrepare(){
			return $this->con->prepare($this->$str_query);
		}
	}

?>