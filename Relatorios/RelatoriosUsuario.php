<?php

require_once './fpdf17/fpdf.php';

if ($_REQUEST) {
    $tipo = $_REQUEST['tipo'];


//    $res = $conexao->Consultar('SELECT * FROM `tipousuario` WHERE tipo = "' . $tipo . '"');
//    while ($row = mysql_fetch_array($res)) {
//        $id = $row['id'];
//    }
    if ($tipo == '0') {
$id = $tipo;
    require_once '../Dao/ConexaoMysql.php';
    //Instanciar a classe
    $conexao = new ConexaoMysql();
    //Abrir conexão
    $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `usuario`');
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $resultado = $usuario->Carregarpdf1();
        $pdf = new FPDF('L', 'mm');
        $pdf->Open();
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Professores');

        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'Nome', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_encode('Sobrenome'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Turno'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Tipo'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'E-mail', 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Telefone', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['nome'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['sobrenome']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['turno']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['tipo']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, ($row['email']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, ($row['telefone']), 1, 0, 'C', 1);
            }
        } else {
            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
        }
    }
    else
    if ($tipo == '1') {
$id = $tipo;
    require_once '../Dao/ConexaoMysql.php';
    //Instanciar a classe
    $conexao = new ConexaoMysql();
    //Abrir conexão
    $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `usuario`WHERE TipoUsuario_id = ' . $tipo . '');
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $resultado = $usuario->Carregarpdf($id);
        $pdf = new FPDF('L', 'mm');
        $pdf->Open();
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Professores');

        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'Nome', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_decode('Sobrenome'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Turno'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Tipo'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'E-mail', 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Telefone', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['nome'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['sobrenome']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['turno']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['tipo']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, ($row['email']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, ($row['telefone']), 1, 0, 'C', 1);
            }
        } else {
            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
        }
    }
    else
        
    if ($tipo == '2') {
$id = $tipo;
    require_once '../Dao/ConexaoMysql.php';
    //Instanciar a classe
    $conexao = new ConexaoMysql();
    //Abrir conexão
    $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `usuario`WHERE TipoUsuario_id = ' . $tipo . '');
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $resultado = $usuario->Carregarpdf($id);
        $pdf = new FPDF('L', 'mm');
        $pdf->Open();
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Professores');

        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'Nome', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_decode('Sobrenome'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Turno'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Tipo'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'E-mail', 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Telefone', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['nome'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['sobrenome']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['turno']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['tipo']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, ($row['email']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, ($row['telefone']), 1, 0, 'C', 1);
            }
        } else {
            $pdf->SetFont('Arial', '', 30);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(13);
            $pdf->Cell(270, 10, utf8_decode('Não há dados a serem mostrados'), 1, 0, 'C', 1);
        }
    }
    else
    if ($tipo == '3') {
$id = $tipo;
    require_once '../Dao/ConexaoMysql.php';
    //Instanciar a classe
    $conexao = new ConexaoMysql();
    //Abrir conexão
    $conexao->Conecta();
        $conexao->Consultar('SELECT * FROM `usuario`WHERE TipoUsuario_id = ' . $tipo . '');
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $resultado = $usuario->Carregarpdf($id);
        $pdf = new FPDF('L', 'mm');
        $pdf->Open();
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage();
        $pdf->SetTitle('Relatorio Professores');

        $pdf->Ln();
        $pdf->SetFillColor(256, 245, 0);
        $pdf->SetX(13);
        $pdf->Cell(30, 7, 'Nome', 1, 0, 'C', 1);
        $pdf->SetX(43);
        $pdf->Cell(60, 7, utf8_decode('Sobrenome'), 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(60, 7, utf8_decode('Turno'), 1, 0, 'C', 1);
        $pdf->SetX(163);
        $pdf->Cell(60, 7, utf8_decode('Tipo'), 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'E-mail', 1, 0, 'C', 1);
        $pdf->SetX(223);
        $pdf->Cell(60, 7, 'Telefone', 1, 0, 'C', 1);

        if ($conexao->total > 0) {
            while ($row = mysql_fetch_array($resultado)) {
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(13);
                $pdf->Cell(30, 7, $row['nome'], 1, 0, 'C', 1);
                $pdf->SetX(43);
                $pdf->Cell(60, 7, ($row['sobrenome']), 1, 0, 'C', 1);
                $pdf->SetX(103);
                $pdf->Cell(60, 7, ($row['turno']), 1, 0, 'C', 1);
                $pdf->SetX(163);
                $pdf->Cell(60, 7, utf8_decode($row['tipo']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, ($row['email']), 1, 0, 'C', 1);
                $pdf->SetX(223);
                $pdf->Cell(60, 7, ($row['telefone']), 1, 0, 'C', 1);
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
$name="Relatório";
$dest = "I";
$pdf->Output($name, $dest)
?>
