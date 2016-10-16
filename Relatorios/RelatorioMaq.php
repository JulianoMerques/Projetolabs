<?php

require_once './fpdf17/fpdf.php';
if ($_REQUEST) {
    $tipo = $_REQUEST['tipo'];
    if ($tipo == '0') {
        require_once '../Dao/ConexaoMysql.php';
        //Instanciar a classe
        $conexao = new ConexaoMysql();
        //Abrir conexão
        $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `maquinas` ');
        require_once '../Model/Maquina.php';
        $maquina = new Maquina();
        $resultado = $maquina->CarregarPDF();
                $pdf = new FPDF('L', 'mm');
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Maquina Completo');
                $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(45);
        $pdf->Cell(50, 7, 'MAC', 1, 0, 'C', 1);
        $pdf->SetX(95);
        $pdf->Cell(50, 7, utf8_decode('Patrimonio'), 1, 0, 'C', 1);
        $pdf->SetX(145);
        $pdf->Cell(50, 7, utf8_decode('Nome'), 1, 0, 'C', 1);
        $pdf->SetX(195);
        $pdf->Cell(60, 7, utf8_decode('Laboratório'), 1, 0, 'C', 1);
        
                if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(45);
                $pdf->Cell(50, 7, $row['mac'], 1, 0, 'C', 1);
                $pdf->SetX(95);
                $pdf->Cell(50, 7, ($row['Patrimonio']), 1, 0, 'C', 1);
                $pdf->SetX(145);
                $pdf->Cell(50, 7, ($row['nome']), 1, 0, 'C', 1);
                $pdf->SetX(195);
                $pdf->Cell(60, 7, ($row['laboratorio']), 1, 0, 'C', 1);
            }
            }else{
                            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
            }
    }else{
                require_once '../Dao/ConexaoMysql.php';
        //Instanciar a classe
        $conexao = new ConexaoMysql();
        //Abrir conexão
        $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM maquinas where Laboratorio_id1 = '.$tipo);
        require_once '../Model/Maquina.php';
        $maquina = new Maquina();
        $resultado = $maquina->carregarPDF2($tipo);
                $pdf = new FPDF('L', 'mm');
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Maquina Completo');
                $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(45);
        $pdf->Cell(50, 7, 'MAC', 1, 0, 'C', 1);
        $pdf->SetX(95);
        $pdf->Cell(50, 7, utf8_decode('Patrimonio'), 1, 0, 'C', 1);
        $pdf->SetX(145);
        $pdf->Cell(50, 7, utf8_decode('Nome'), 1, 0, 'C', 1);
        $pdf->SetX(195);
        $pdf->Cell(60, 7, utf8_decode('Laboratório'), 1, 0, 'C', 1);
        
                if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(45);
                $pdf->Cell(50, 7, $row['mac'], 1, 0, 'C', 1);
                $pdf->SetX(95);
                $pdf->Cell(50, 7, ($row['Patrimonio']), 1, 0, 'C', 1);
                $pdf->SetX(145);
                $pdf->Cell(50, 7, ($row['nome']), 1, 0, 'C', 1);
                $pdf->SetX(195);
                $pdf->Cell(60, 7, ($row['laboratorio']), 1, 0, 'C', 1);
            }
            }else{
                            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(45);
            $pdf->Cell(210, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
            }
    }
}
$name = "Relatório";
$dest = "I";
$pdf->Output($name, $dest)
?>
