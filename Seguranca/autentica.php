<?php
if (($_POST['login'] != '') && ($_POST['senha'] != '')) {
    require_once '../Dao/ConexaoMysql.php';
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = 'select * from usuario where login="' . ($_POST['login']) . '" 
        and senha ="' . md5(($_POST['senha'])) . '"';

    $conexao->Consultar($sql);
    session_start();

    if ($conexao->total > 0) {
        $resultado = $conexao->Consultar('SELECT `id` FROM `usuario` WHERE login = "' . $_POST['login'] . '"');
        while ($row = mysql_fetch_array($resultado)) {
            $htmll .= $row['id'];
        }
        $_SESSION['id'] = $htmll;

        $resultado1 = $conexao->Consultar('SELECT `nome` FROM `usuario`WHERE login = "' . $_POST['login'] . '"');
        while ($row = mysql_fetch_array($resultado1)) {
            $html .= $row['nome'];
        }

        $_SESSION['admin'] = $html;
        
        $resultado2 = $conexao->Consultar('SELECT `sobrenome` FROM `usuario` WHERE login = "' . $_POST['login'] . '"');
        while ($row = mysql_fetch_array($resultado2)) {
            $html2 .= $row['sobrenome'];
        }

        $_SESSION['sobrenome'] = $html2;

        $resultado3 = $conexao->Consultar('SELECT `TipoUsuario_id` FROM `usuario`WHERE login = "' . $_POST['login'] . '"');
        while ($row = mysql_fetch_array($resultado3)) {
            $html3 .= $row['TipoUsuario_id'];
        }
        $_SESSION['tipo'] = $html3;

        if ($_SESSION['tipo'] == '1') {
            header('location:../View/PaginaPrincipal.php');
        } else {
            header('location:../View/PaginaPrincipal.php');
        }
    } else {
                  header('location:../index.php?mensagem=erro');
      
    }
} else {
 header('location:../index.php?mensagem=erro2');

}

?>
