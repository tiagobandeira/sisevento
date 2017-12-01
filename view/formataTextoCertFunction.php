<?php  


function formataCert($str, $dados){
    $texto = $str;
    $nome = "Tiago Bandeira"; # --u - nome do participante
    $dataInicio = "2017-10-11";  #  - d--
    $dataFim = "2017-10-11"; #  - --d
    $nomeEvento = "V semana";   # - --e

    $itens = ["--u", "--d", "d--", "--e"];
    #$dados = [$nome, $dataInicio, $dataFim, $nomeEvento];
    for ($i=0; $i < count($dados) ; $i++) { 
        $temp = "";
        if (stristr($texto, $itens[$i])) {
            $lista = explode($itens[$i], $texto);
             $j = 0;
            foreach ($lista as $value) {
                if($j < count($lista) - 1){
                    $temp  .= " " . $value . $dados[$i] . " ";
                    $j++;
                }else{
                  $temp  .= " " . $value . " ";
                }
                
               
            }
            $texto = $temp;
          
          
        }


    }
   
    return $texto;
}
function formataData($str_data){
    $data = explode("-", $str_data);
    return $data;#dia - mes - ano
}


?>