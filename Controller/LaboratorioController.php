<?php

require_once '../Model/Laboratorio.php';
$laboratorio = new Laboratorio();
$acao = $_POST['acao'];

switch ($acao) {
    case 'cadastrar':
        $laboratorio->setId($_POST['id']);
        $laboratorio->setNome(utf8_decode($_POST['nome']));
        $laboratorio->setCapacidade($_POST['capacidade']);
        if ($_POST['id'] == 0) {
            $laboratorio->Inserir();
            header('location:../View/Manutencao.php');
        } else {
            $laboratorio->Editar();
            header('location:../View/Manutencao.php');
        }

        break;
    case 'editar':
            $laboratorio->setId($_POST['id']);
            $laboratorio->CarregarPorID();

echo'<input type="text" name="nome" id="nome" value="' . $laboratorio->getNome() . '"maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
     <input type="text" name="capacidade" id="capacidade"value="' . $laboratorio->getCapacidade() . '" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />';


        break;
    case 'deletar':
            $laboratorio->setId($_POST['id']);
            $laboratorio->Deletar();
            header('location:../View/laboratorios.php');

        break;

    default:
        break;
}
?>
