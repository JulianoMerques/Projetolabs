<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require_once '../Seguranca/seguranca.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../Resources/Css/CssVerPedido.css"> 
        <link rel="stylesheet" href="../Resources/Css/msgBoxLight.css" type="text/css" media="screen" />
        <script type="text/javascript" src="../Resources/Js/jquery.js"></script>
        <script type="text/javascript" src="../Resources/Js/plugins/jquery.msgBox.js"></script>
        <title></title>
    </head>
    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.mensagemBox = function(titulo, mensagem) {
                return $.msgBox({
                    title: titulo,
                    content: mensagem,
                    type: "info",
                    showButtons: false,
                    opacity: 0.9,
                    autoClose: true,
                    timeOut: 1500
                });
            };
            var tipoUser = <?php echo $_SESSION['tipo']; ?>;
            if (tipoUser === 1) {
                var situacao = <?php echo $_REQUEST['situacao']; ?>;
                var id = <?php echo $_REQUEST['id']; ?>;
                if (situacao === 0) {
                    var sitNova = "1";
                    var url = "../Controller/PedidoController.php";
                    var parametros = {
                        sitNova: sitNova,
                        id: id,
                        acao: "editarSit"
                    };
                    $.post(url, parametros, function(data) {
                        $(this).mensagemBox("Visialização de Pedido", "Pedido Visualizado!");
                    });
                }
            } else if (tipoUser === 2) {
                var situacao = <?php echo $_REQUEST['situacao']; ?>;
                var id = <?php echo $_REQUEST['id']; ?>;
                if (situacao === 0) {
                    var sitNova = "1";
                    var url = "../Controller/PedidoController.php";
                    var parametros = {
                        sitNova: sitNova,
                        id: id,
                        acao: "editarSit"
                    };
                    $.post(url, parametros, function(data) {
                        $(this).mensagemBox("Visialização de Pedido", "Pedido Visualizado!");
                    });
                }
            }
            //------------------------------ cadastrar laboratorio -----------------------------------------//
            $("#form_Realizado").submit(function() {
                var id = <?php echo $_REQUEST['id']; ?>;
                var sitNova;
                var url = "../Controller/PedidoController.php";
                $('input:radio[name=realizado]').each(function() {
                    if ($(this).is(':checked'))
                        sitNova = $(this).val();
                });
                var parametros = {
                    sitNova: sitNova,
                    id: id,
                    acao: "editarSit"
                };
                if (sitNova !== '' && id !== '') {
                    $('#realizado').val('');
                    $.post(url, parametros, function(data) {
                        $(this).mensagemBox("Edição de Situação", "Situação Editada com Sucesso!");
                    });
                    return false;
                }
                return false;

            });
        });
    </script>
    <body>
        <?php
        $id = $_REQUEST['id'];
        require_once '../Model/Pedido.php';
        $pedido = new Pedido();
        $pedido->setId($id);
        $pedido->CarregarPorID();
        ?>
        <div class="pedido">
            <img src="../Resources/Img/logo.png"/><br>
            <label class="sistem">.:: Sistema de Controle de Manutenção ::.</label>
            <p>Eu Profesor <label><?php echo $pedido->getUsuario_id(); ?></label> venho por meio deste pedir a manutenção do tipo <label><?php echo $pedido->getTipoManutencao_id(); ?></label>
                no  <label><?php echo $pedido->getLaboratorio_id(); ?></label>  nas seguintes maquinas: (<label><?php echo $pedido->getMaquinas(); ?></label>)
                pois estas maquinas tem o seguinte problema: <label><?php echo $pedido->getProblema(); ?></label>,
                peço que minha solicitação seja atendiada o mais rapido possivel. desde ja agradeço pela colaboração.
            </p>
            <div class="ass">

                <?php
                echo '_________________________________________________________';

                echo '<br>';
                echo 'Professor ' . $pedido->getUsuario_id() . '
        ' . $pedido->getSobrenome();
                echo '<br>';
                echo '<Label id="Gerado">Gerado em: ' . $pedido->getData() . ' | ' . $pedido->getHora() . '</label>';
                ?>
            </div>
        </div>
        <?php
        @$imprimir = $_REQUEST['imprimir'];
        if ($_SESSION['tipo'] == "1" || $_SESSION['tipo'] == "2") {
            if ($imprimir == 1) {
                echo'
                    <form method="post" id="form_Imprimir">
                    <input type="button" name="imprimir"id="imprimir" class="imprimir" onClick="window.print();" value="imprimir"/>
                    </form>                    
                    ';
            } else {
                ?>
                <form method="post" class="realizado" id="form_Realizado">
                    <p>Este pedido foi executado?</p>
                    <p>  <input type="radio" name="realizado" id="realizado" value="2"/>Sim
                        <input type="radio" name="realizado" id="realizado" value="1" />Não</p>
                    <div class="contem_btns">
                        <input type="submit" name="Cadastrar" value="Ok" class="btn" id="btn_maq"/>
                        <input type="reset" name="limpar" value="Limpar" class="btn"  />
                    </div>
                </form>
                <?php
            }
        }
        ?>
    </body>
</html>
