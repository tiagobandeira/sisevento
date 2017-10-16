
<?php 
   require_once( 'fpdf/fpdf.php' );
   require_once( 'fpdf/WriteHTML.php' );

   setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
   #date_default_timezone_set('America/Sao_Paulo');
   $dia = @date("d");
   $mes = @strftime('%B');
   $ano = @date('Y');
   $organizador = "Francisco de Assis Carvalho";
   $cargo = "Diretor de Ensino";

   $organizador2 = "Athanio de Souza Silveira";
   $cargo2 = "Coordenador do SEIFPI";

   #strftime('%A, %d de %B de %Y', strtotime('today')
   $nome  = @$_POST['nome']; // Sim, a supressão é perfeitamente válida neste contexto
   $horas = @$_POST['horas']; // pois os parâmetros serão checados logo em seguida.
   $data  = @$_POST['data'];
   $texto = @$_POST['texto'];
 
   if( empty( $nome  ) ) $nome = "Athânio de Souza Silveira";
   if( empty( $horas ) ) $horas = 20;
   if( empty( $data  ) ) $data = "17 de agosto de 2017";
   
   $antes = array('#nome', '#hora','#data');
   $depois = array($nome, $horas, $data);
   $frase = str_replace($antes, $depois, $texto);


   // Gerar arquivos com FPDF sem HTML 
   /*
   $pdf = new FPDF();
   $pdf->AddPage('L');
   $pdf->Image('img/certificado_seifpi.png',0,0,297);

   $pdf->SetFont('Arial','B', 13);
   $pdf->SetXY( 35, 96);
      $pdf->MultiCell(0, 7, 
      #$pdf->Text(20,30,
      "    Eu, declaro que adquiri de $nome um pacote de créditos para acesso à internet com duração de $horas horas, iniciando-se em $data. Declaro ainda que estas informações provavelmente são inverídicas e sem sentido, pois isto aqui é um mero teste."
      ,0, 'J', false);

    $pdf->SetFont('Arial','', 11);

    $pdf->Text(200,140, "Parnaiba, $dia de $mes de $ano.");

    

    $pdf->Text(47,160, "_________________________________ ");
    $pdf->Text(55,165, " $organizador");
    $pdf->Text(65,170, " $cargo");
    $pdf->Text(66,175, " SIAPE - 1580584");


    $pdf->Text(187,160, "_________________________________ ");
    $pdf->Text(199,165, " $organizador2");
    $pdf->Text(202,170, " $cargo2");
    $pdf->Text(207,175, " SIAPE - 1580582");
 
    $pdf->Output();
    */


   $pdf2=new PDF_HTML();
   $pdf2->AddPage('L');
   $pdf2->Image('img/certificado_seifpi.png',0,0,297);
   $pdf2->SetFont('courier','', 15);
   $pdf2->SetXY( 35, 98);
   $pdf2->WriteHTML("<p align='justify'> ".$frase."</p>");
   $normal= "<p align='justify'> Eu, declaro que adquiri de <b>$nome</b>um pacote de créditos para acesso à internet com duração de<b>$horas horas</b>, iniciando-se em  <b>$data</b>. Declaro ainda que estas informações provavelmente são inverídicas e sem sentido, pois isto aqui é um mero teste. </p>";

   $pdf2->SetFont('courier','', 11);
   $pdf2->Text(200,135, "Parnaiba, $dia de $mes de $ano.");
   $pdf2->Text(47,160, "_________________________________ ");
   $pdf2->Text(55,165, " $organizador");
   $pdf2->Text(65,170, " $cargo");
   $pdf2->Text(66,175, " SIAPE - 1580584");


   $pdf2->Text(187,160, "_________________________________ ");
   $pdf2->Text(199,165, " $organizador2");
   $pdf2->Text(202,170, " $cargo2");
   $pdf2->Text(207,175, " SIAPE - 1580582");

   $pdf2->Output();
?>

