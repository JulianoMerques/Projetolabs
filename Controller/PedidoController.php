<?php
require_once '../Dao/ConexaoMysql.php';
$conexao = new ConexaoMysql();
$conexao->Conecta();

require_once '../Model/Pedido.php';
$pedido = new Pedido();

$acao = $_POST['acao'];

switch ($acao) {
    case 'cadastrar':
        session_start();
        $data = date('Y-m-d');
        $hora = date('H:i:s');

        $pedido->setTipoManutencao_id($_POST['tipoManutencao']);
        $pedido->setLaboratorio_id($_POST['laboratorio']);
        $pedido->setMaquinas($_POST['camposMarcados']);
        $pedido->setProblema($_POST['problema']);
        $pedido->setData($data);
        $pedido->setHora($hora);
        $pedido->setUsuario_id($_SESSION['id']);
        $pedido->setSobrenome($_SESSION['sobrenome']);

        $pedido->Inserir();
        break;
    case 'editarSit':
            $pedido->setSituacao($_POST['sitNova']);
            $pedido->setId($_POST['id']);
            $pedido->EditarSit();

        break;
    case '':


        break;
    case 'Laboratorio':
        $Laboratorio = $_POST['Laboratorio'];
        $pedido-> CarregarCheckBox_Maquina($Laboratorio);
        break;

    default:
        break;
}
?>
