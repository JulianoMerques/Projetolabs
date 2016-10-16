<?php

require_once './fpdf17/fpdf.php';

if ($_REQUEST) {
    $tipo = $_REQUEST['tipo'];

    if ($tipo == 'Por Data') {
        $de = $_REQUEST['de'];
        $ate = $_REQUEST['ate'];
        require_once '../Dao/ConexaoMysql.php';
        //Instanciar a classe
        $conexao = new ConexaoMysql();
        //Abrir conexão
        $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `manutencao` where data>="' . $de . '" and data<="' . $ate . '"');
        require_once '../Model/Manutencao.php';

        $Manutencao = new Manutencao();
        $resultado = $Manutencao->Carregarpdf_pordata($de, $ate);
        $resultado2 = $Manutencao->Carregarpdf_pordata($de, $ate);
        $pdf = new FPDF('L', 'mm');
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Por Data');

        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_decode('Tipo Manutenção'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Laboratório'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Maquina'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Data', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['manutencao']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['laboratorio']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['maquina']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $conexao->ConveteDataBrasil($row['data']), 1, 0, 'C', 1);
            }
            $pdf->Ln();
            $pdf->SetFillColor(256, 245, 0);
            $pdf->SetX(13);
            $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
            $pdf->SetX(43);
            $pdf->Cell(60, 7, 'Problema', 1, 0, 'C', 1);
            $pdf->SetX(103);
            $pdf->Cell(60, 7, utf8_decode('Solução'), 1, 0, 'C', 1);
            $pdf->SetX(163);
            $pdf->Cell(60, 7, 'Monitor', 1, 0, 'C', 1);
            $pdf->SetX(223);
            $pdf->Cell(60, 7, 'Turno', 1, 0, 'C', 1);

            while ($row = mysql_fetch_array($resultado2)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, utf8_decode($row['problema']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, utf8_decode($row['solucao']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['usuario']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $row['turno'], 1, 0, 'C', 1);
            }
        } else {
            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
        }
    } 
    
    else if ($tipo == 'Manutencao') {
        $tipomanutencao = $_REQUEST['manutencao'];
        require_once '../Dao/ConexaoMysql.php';
        //Instanciar a classe
        $conexao = new ConexaoMysql();
        //Abrir conexão
        $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `manutencao` where TipoManutencao_id = ' . $tipomanutencao);
        require_once '../Model/Manutencao.php';

        $Manutencao = new Manutencao();
        $resultado1 = $Manutencao->Carregarpdf_manutencao($tipomanutencao);
        $resultado2 = $Manutencao->Carregarpdf_manutencao($tipomanutencao);
                $pdf = new FPDF('L', 'mm');
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Por Manutenção');
        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_decode('Tipo Manutenção'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Laboratório'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Maquina'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Data', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado1)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['manutencao']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['laboratorio']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['maquina']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $conexao->ConveteDataBrasil($row['data']), 1, 0, 'C', 1);
            }
            $pdf->Ln();
            $pdf->SetFillColor(256, 245, 0);
            $pdf->SetX(13);
            $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
            $pdf->SetX(43);
            $pdf->Cell(60, 7, 'Problema', 1, 0, 'C', 1);
            $pdf->SetX(103);
            $pdf->Cell(60, 7, utf8_decode('Solução'), 1, 0, 'C', 1);
            $pdf->SetX(163);
            $pdf->Cell(60, 7, 'Monitor', 1, 0, 'C', 1);
            $pdf->SetX(223);
            $pdf->Cell(60, 7, 'Turno', 1, 0, 'C', 1);

            while ($row = mysql_fetch_array($resultado2)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, utf8_decode($row['problema']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, utf8_decode($row['solucao']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['usuario']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $row['turno'], 1, 0, 'C', 1);
            }
        } else {
            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
        }
    }
    
    else if ($tipo == 'Maquina') {
        $laboratorio = $_REQUEST['laboratorio'];
        $maquina = $_REQUEST['maquina'];
        require_once '../Dao/ConexaoMysql.php';
        //Instanciar a classe
        $conexao = new ConexaoMysql();
        //Abrir conexão
        $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `manutencao` where  	Laboratorio_id = ' . $laboratorio.' and Maquinas_mac = "'.$maquina.'"');
        require_once '../Model/Manutencao.php';

        $Manutencao = new Manutencao();
        $resultado1 = $Manutencao->Carregarpdf_maquina($laboratorio, $maquina);
        $resultado2 = $Manutencao->Carregarpdf_maquina($laboratorio, $maquina);
    
                $pdf = new FPDF('L', 'mm');
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Por Maquina');
        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_decode('Tipo Manutenção'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Laboratório'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Maquina'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Data', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado1)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['manutencao']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['laboratorio']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['maquina']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $conexao->ConveteDataBrasil($row['data']), 1, 0, 'C', 1);
            }
            $pdf->Ln();
            $pdf->SetFillColor(256, 245, 0);
            $pdf->SetX(13);
            $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
            $pdf->SetX(43);
            $pdf->Cell(60, 7, 'Problema', 1, 0, 'C', 1);
            $pdf->SetX(103);
            $pdf->Cell(60, 7, utf8_decode('Solução'), 1, 0, 'C', 1);
            $pdf->SetX(163);
            $pdf->Cell(60, 7, 'Monitor', 1, 0, 'C', 1);
            $pdf->SetX(223);
            $pdf->Cell(60, 7, 'Turno', 1, 0, 'C', 1);

            while ($row = mysql_fetch_array($resultado2)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, utf8_decode($row['problema']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, utf8_decode($row['solucao']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['usuario']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $row['turno'], 1, 0, 'C', 1);
            }
        } else {
            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
        }
    }
    
    else if ($tipo == 'Problema') {
        $problema = $_REQUEST['problema'];

        require_once '../Dao/ConexaoMysql.php';
        //Instanciar a classe
        $conexao = new ConexaoMysql();
        //Abrir conexão
        $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `manutencao` where  problema  like "%'.$problema.'%"');
        require_once '../Model/Manutencao.php';

        $Manutencao = new Manutencao();
        $resultado1 = $Manutencao->Carregarpdf_problema($problema);
        $resultado2 = $Manutencao->Carregarpdf_problema($problema);
  
    
                $pdf = new FPDF('L', 'mm');
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Por Problema');
        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_decode('Tipo Manutenção'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Laboratório'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Maquina'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Data', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado1)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['manutencao']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['laboratorio']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['maquina']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $conexao->ConveteDataBrasil($row['data']), 1, 0, 'C', 1);
            }
            $pdf->Ln();
            $pdf->SetFillColor(256, 245, 0);
            $pdf->SetX(13);
            $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
            $pdf->SetX(43);
            $pdf->Cell(60, 7, 'Problema', 1, 0, 'C', 1);
            $pdf->SetX(103);
            $pdf->Cell(60, 7, utf8_decode('Solução'), 1, 0, 'C', 1);
            $pdf->SetX(163);
            $pdf->Cell(60, 7, 'Monitor', 1, 0, 'C', 1);
            $pdf->SetX(223);
            $pdf->Cell(60, 7, 'Turno', 1, 0, 'C', 1);

            while ($row = mysql_fetch_array($resultado2)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, utf8_decode($row['problema']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, utf8_decode($row['solucao']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['usuario']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $row['turno'], 1, 0, 'C', 1);
            }
        } else {
            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
        }
    }
    
    else if ($tipo == 'Completo') {
        require_once '../Dao/ConexaoMysql.php';
        //Instanciar a classe
        $conexao = new ConexaoMysql();
        //Abrir conexão
        $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `manutencao` ');
        require_once '../Model/Manutencao.php';

        $Manutencao = new Manutencao();
        $resultado1 = $Manutencao->Carregarpdf();
        $resultado2 = $Manutencao->Carregarpdf();
     
  
    
                $pdf = new FPDF('L', 'mm');
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Completo');
        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_decode('Tipo Manutenção'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Laboratório'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Maquina'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Data', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado1)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['manutencao']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['laboratorio']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['maquina']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $conexao->ConveteDataBrasil($row['data']), 1, 0, 'C', 1);
            }
            $pdf->Ln();
            $pdf->SetFillColor(256, 245, 0);
            $pdf->SetX(13);
            $pdf->Cell(30, 7, 'ID', 1, 0, 'C', 1);
            $pdf->SetX(43);
            $pdf->Cell(60, 7, 'Problema', 1, 0, 'C', 1);
            $pdf->SetX(103);
            $pdf->Cell(60, 7, utf8_decode('Solução'), 1, 0, 'C', 1);
            $pdf->SetX(163);
            $pdf->Cell(60, 7, 'Monitor', 1, 0, 'C', 1);
            $pdf->SetX(223);
            $pdf->Cell(60, 7, 'Turno', 1, 0, 'C', 1);

            while ($row = mysql_fetch_array($resultado2)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['id'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, utf8_decode($row['problema']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, utf8_decode($row['solucao']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['usuario']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, $row['turno'], 1, 0, 'C', 1);
            }
        } else {
            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
        }
    }
}

$pdf->Output('Relatório', 'I');
?>