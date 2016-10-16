<?php
require_once '../Model/Usuario.php';
$usuario = new Usuario;
$acao = $_POST['acao'];

switch ($acao) {
    case 'cadastrar':
        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setSobrenome($_POST['sobrenome']);
        $usuario->setTurno($_POST['turno']);
        $usuario->setTipousuario($_POST['tipousuario']);
        $usuario->setEmail($_POST['email']);
        $usuario->setTel($_POST['tel']);
        $usuario->setLogin($_POST['login']);
        $usuario->setSenha($_POST['senha']);
        
         if ($_POST['id'] == 0) {
            $usuario->Inserir();
            header('location:../View/Usuarios.php');
        } else {
            $usuario->Alterar();
            header('location:../View/Usuarios.php');
        }

        break;
    case 'editar':
        $usuario ->setId($_POST['id']);
        $usuario->CarregarPorID();
        
        echo '
            <input type="text" name="nome" id="nome" value="'.utf8_encode($usuario->getNome()).'" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="sobrenome" id="sobrenome" value="'.utf8_encode($usuario->getSobrenome()).'" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <select name="turno" id="turno" class="quebralinha text ui-widget-content ui-corner-all">';

        $resultado = $usuario->Carregar_Turno_selecionado();
        while ($linha = mysql_fetch_array($resultado)) {
            if ($usuario->getTurno() == $linha['id']) {
                ?>
                <option value="<?php echo $linha['id'] ?>" selected="selected"><?php echo utf8_encode($linha['turno']) ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $linha['id'] ?>"><?php echo utf8_encode($linha['turno']) ?></option>
                <?php
            }
        }
                echo'
            </select>
            <select name="tipousuario" id="tipousuario" class="quebralinha text ui-widget-content ui-corner-all">';

        $resultados = $usuario->Carregar_TipoUsuario_selecionado();
        while ($linha = mysql_fetch_array($resultados)) {
            if ($usuario->getTipousuario() == $linha['id']) {
                ?>
                <option value="<?php echo $linha['id'] ?>" selected="selected"><?php echo utf8_encode($linha['tipo']) ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $linha['id'] ?>"><?php echo utf8_encode($linha['tipo']) ?></option>
                <?php
            }
        }
                echo'
            </select>
            <input type="email" name="email" id="emaill" value="'.$usuario->getEmail().'" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="tel" name="tel" id="tel" value="'.$usuario->getTel().'" maxlength="45"class="celular quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="login" id="login" value="'.$usuario->getLogin().'" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="hidden" name="senha" id="senha" value="'.$usuario->getSenha().'" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="hidden" name="con-senha" id="consenha" value="'.$usuario->getSenha().'" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />                
';


        break;
    case 'deletar':
        $usuario->setId($_POST['id']);
        $usuario->Deletar();


        break;

    default:
        break;
}
?>
