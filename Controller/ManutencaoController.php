<?php
require_once '../Dao/ConexaoMysql.php';
$conexao = new ConexaoMysql();

require_once '../Model/Manutencao.php';
$manutecao = new Manutencao();
$acao = $_POST['acao'];
switch ($acao) {
    case 'cadastrar':
        $manutecao->setId($_POST['id']);
        $manutecao->setTipo($_POST['tipo']);
        $manutecao->setLaboratorio($_POST['laboratorio']);
        $manutecao->setMaquina($_POST['maquina']);
        $manutecao->setData($_POST['data']);
        $manutecao->setProblema($_POST['problema']);
        $manutecao->setSolucao($_POST['solucao']);
        $manutecao->setMonitor($_POST['monitor']);
        $manutecao->setTurno($_POST['turno']);
        if ($_POST['id'] == 0) {
            $manutecao->Inserir();
            header('location:../View/Manutencao.php');
        } else {
            $manutecao->Editar();
            header('location:../View/Manutencao.php');
        }
        break;
    case 'editar':
        $manutecao->setId($_POST['id']);
        $manutecao->CarregarPorID();
        session_start();
        echo '
        <select name="tipo" id="tipo" class="quebralinha text ui-widget-content ui-corner-all">';
        $resultado = $manutecao->Carregar_TipoManutencao_selecionada();
        while ($linha = mysql_fetch_array($resultado)) {
            if ($manutecao->getTipo() == $linha['id']) {
                ?>
                <option value="<?php echo $linha['id'] ?>" selected="selected"><?php echo utf8_encode($linha['tipo']) ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $linha['id'] ?>"><?php echo utf8_encode($linha['tipo']) ?></option>
                <?php
            }
        }
        echo' </select>
            <select name="laboratorio" id="laboratorio0" class="quebralinha text ui-widget-content ui-corner-all">
                ';
        $resultadolab = $manutecao->Carregar_laboratorio_selecionada();
        while ($linha = mysql_fetch_array($resultadolab)) {
            if ($manutecao->getLaboratorio() == $linha['id']) {
                if ($manutecao->getLaboratorio() == $linha['id']) {
                    $idlab = $linha['id'];
                }
                ?>
                <option value="<?php echo $linha['id'] ?>" selected="selected"><?php echo utf8_encode($linha['nome']) ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $linha['id'] ?>"><?php echo utf8_encode($linha['nome']) ?></option>
                <?php
            }
        }
        echo' </select>
            <select name="maquina" id="maquina" class="quebralinha text ui-widget-content ui-corner-all">';
        $resultadomac = $manutecao->Carregar_maquina_selecionada($idlab);
        while ($linha = mysql_fetch_array($resultadomac)) {
            if ($manutecao->getMaquina() == $linha['mac']) {
                ?>
                <option value="<?php echo $linha['mac'] ?>" selected="selected"><?php echo utf8_encode($linha['nome']) ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $linha['mac'] ?>"><?php echo utf8_encode($linha['nome']) ?></option>
                <?php
            }
        }
        echo'
            </select>
            <input type="text" name="data" value="' . $conexao->ConveteDataBrasil($manutecao->getData()) . '" id="datepicker" maxlength="45"class="data quebralinha text ui-widget-content ui-corner-all" />
            <textarea id="problema" name="problema" placeholder="Digite o problema da maquina"  maxlength="1000" class="quebralinha text ui-widget-content ui-corner-all">' . $manutecao->getProblema() . '</textarea>
            <textarea id="solucao" name="solucao" placeholder="Digite a soluçao da maquina"  maxlength="1000" class="quebralinha text ui-widget-content ui-corner-all">' . $manutecao->getSolucao() . '</textarea>
            <label  value="';
        echo $_SESSION["id"];
        echo'">';
        echo $_SESSION["admin"]
        . ' </label>
            <input type="hidden" name="usuario" id="usuario12"  value="' .
        $_SESSION["id"]
        . ' " />
            <select name="turno" id="turno" class="quebralinha text ui-widget-content ui-corner-all"> ';
        $resultadoturno = $manutecao->Carregar_turno_selecionado();
        while ($linha = mysql_fetch_array($resultadoturno)) {
            if ($manutecao->getMaquina() == $linha['id']) {
                ?>
                <option value="<?php echo $linha['id'] ?>" selected="selected"><?php echo utf8_encode($linha['turno']) ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $linha['id'] ?>"><?php echo utf8_encode($linha['turno']) ?></option>
                <?php
            }
        }
        echo'</select>';
        break;
    case 'deletar':
        $manutecao->setId($_POST['id']);
        $manutecao->Deletar();
        break;
    case 'Laboratorio':
        $Laboratorio = $_POST['Laboratorio'];
        $manutecao->CarregarSelect_Maquina($Laboratorio);
        break;
    default:
        break;
}
?>