<?php
session_start();

require_once '../Dao/ConexaoMysql.php';
$conexao = new ConexaoMysql();
$conexao->Conecta();

require_once '../Model/Maquina.php';
$maquina = new Maquina();

$acao = $_POST['acao'];

switch ($acao) {
    case 'cadastrar':
        $maquina->setMac($_POST['mac']);
        $maquina->setPatrimonio($_POST['patrimonio']);
        $maquina->setNome($_POST['nome']);
        $maquina->setLaboratorio($_POST['laboratorio']);
        $maquina->setConf($_POST['conf']);
        $sql = 'SELECT * FROM `maquinas` WHERE mac = "' . $_POST['mac'] . '" and Patrimonio = ' . $_POST['patrimonio'];
        $conexao->Consultar($sql);
        if ($conexao->total == 0) {
            $maquina->Inserir();
//            header('location:../View/Maquina.php');
        } else {
            $maquina->Editar();
//                        header('location:../View/Maquina.php');
        }

        break;

    case 'editar':
        $maquina->setMac($_POST['id']);
        $maquina->CarregarPorID();
        echo'
            <input type="text" name="patrimonio" value="' . $maquina->getPatrimonio() . '" id="patrimonio" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="nome" id="nome" value="' . $maquina->getNome() . '" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="mac" id="mac" value="' . $maquina->getMac() . '" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" disabled="true" />   
                  <textarea id="conf" name="conf" placeholder="Digite a configuração da maquina"  maxlength="1000" class="quebralinha text ui-widget-content ui-corner-all">' . $maquina->getConf() . '</textarea>
            <select name="laboratorio" id="laboratorio0" class="quebralinha text ui-widget-content ui-corner-all">';


        $resultado = $maquina->Carregar_laboratorio_selecionada();
        while ($linha = mysql_fetch_array($resultado)) {
            if ($maquina->getLaboratorio() == $linha['id']) {
                ?>
                <option value="<?php echo $linha['id'] ?>" selected="selected"><?php echo utf8_encode($linha['nome']) ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $linha['id'] ?>"><?php echo utf8_encode($linha['nome']) ?></option>
                <?php
            }
        }

        echo '
            </select>
          
            <input type="hidden" name="id" value="' . $maquina->getMac() . '" id="id"/>
            ';

        break;

    case 'deletar':
        $maquina->setMac($_POST['id']);
        $maquina->Deletar();

        break;

    case 'Laboratorio':
        $Laboratorio = $_POST['Laboratorio'];
        $maquina->CarregarSelect_Maquina($Laboratorio);
        break;
    default:
        break;
}
?>
