<?php
require_once './fpdf17/fpdf.php';
    require_once '../Dao/ConexaoMysql.php';
    //Instanciar a classe
    $conexao = new ConexaoMysql();
    //Abrir conexão
    $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `laboratorio`');
        require_once '../Model/Laboratorio.php';
        $laboratorio = new Laboratorio();
        $resultado = $laboratorio->Carregarpdf();
        $pdf = new FPDF('L', 'mm');
        $pdf->Open();
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Laboratorios');
                $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(50);
        $pdf->Cell(100, 7, 'Nome', 1, 0, 'C', 1);
        $pdf->SetX(150);
        $pdf->Cell(100, 7, utf8_encode('Capacidade'), 1, 0, 'C', 1);
        
        if ($conexao->total > 0) {
                while ($row = mysql_fetch_array($resultado)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(50);
                $pdf->Cell(100, 7, $row['nome'], 1, 0, 'C', 1);
                $pdf->SetX(150);
                $pdf->Cell(100, 7, ($row['capacidade']), 1, 0, 'C', 1);
            }
}else{
                $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(50);
            $pdf->Cell(200, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
}
$name="Relatório";
$dest = "I";
$pdf->Output($name, $dest)
?>
