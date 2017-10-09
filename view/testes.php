<?php  

$str = "Certificamos que --u participou da --e de tecnologia - SEIFPI, realizado na data de --d e d-- , no IFPI Campus Parnaíba.";
$nome = "Tiago Bandeira";
$data = "2017";
$list = explode("#", $str);
foreach ($list as $value) {

  echo $value . "<br>";
}
echo "<br><br><br>";

function formataCert($str){
    $texto = $str;
    $nome = "Tiago Bandeira"; # u-- - nome do participante
    $dataInicio = "2017-10-11";  #  - d--
    $dataFim = "2017-10-11"; #  - --d
    $nomeEvento = "V semana";   # - e--

    $itens = ["--u", "--d", "d--", "--e"];
    $dados = [$nome, $dataInicio, $dataFim, $nomeEvento];
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
    /*
    $temp = "";
    if (stristr($str, "--u")) {
        $lista = explode("--u", $texto);
        foreach ($lista as $value) {
          $temp  .= " " . $value . $nome . " ";
         
        }
         $texto = $temp;
         $temp = "";
    }
    if(stristr($str, "--e")){
        $lista = explode("--e", $texto);
        foreach ($lista as $value) {
          $temp  .= " " . $value . $nomeEvento . " ";
         
        }
         $texto = $temp;
         $temp = "";
    }
    if(stristr($str, "--d")){
        $lista = explode("--d", $texto);
        foreach ($lista as $value) {
          $temp  .= " " . $value . $dataInicio . " ";
         
        }
         $texto = $temp;
         $temp = "";
    }
    if(stristr($str, "d--")){
        $lista = explode("d--", $texto);
        foreach ($lista as $value) {
          $temp  .= " " . $value . $dataFim . " ";
         
        }
         $texto = $temp;
         $temp = "";
    }*/
    return $texto;
}
echo formataCert($str);

?>