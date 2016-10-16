<?php
require_once '../Template/TopTemplate.php';



if ($_SESSION['tipo'] == "2" || $_SESSION['tipo'] == "3") {
    header('location:../View/PaginaPrincipal.php?mensagem=acessonegado');
}
?>
<link rel="shortcut icon" type="image/x-icon" href="../Resources/Img/107_128x128.png">
<script type="text/javascript">
    $(document).ready(function() {
                if (screen.width <= 773) {
            $("#patrimonioo").html("Patr.:");
            $("#conff").html("Conf. Maq.:");
            $("#laboratorio2").html("Lab.:");
            $("#operacoes").html("Oper.:");
        }
        //------------------------------ cadastrar maquina ----------------------------------------//
        $("#formMaquinas").submit(function() {
            var id = $("#id_MAQ").val();
            var patrimonio = $("#patrimonio").val();
            var nome = $('#nome').val();
            var mac = $('#mac').val();
            var laboratorio = $('#laboratorio0').val();
            var conf = $('#conf').val();
            var url = "../Controller/MaquinaController.php";  

            var parametros = {
                patrimonio: patrimonio,
                nome: nome,
                mac: mac,
                laboratorio: laboratorio,
                conf: conf,
                acao: "cadastrar"
            };
            if (patrimonio !== '' && nome !== '' && mac !== '' && laboratorio !== '' && conf !== '' && id !== '') {
                $.post(url, parametros, function(data) {
                    $('#patrimonio').val('');
                    $('#nome').val('');
                    $('#mac').val('');
                    $('#laboratorio0').val('');
                    $('#conf').val('');
                    $('#id_MAQ').val('');
                    if (id === '0') {
                        $(this).mensagemBox("Cadastro de Maquina", "Maquina Cadastrada com Sucesso!");
                        $(this).Reload_Pagina();
                    } else {
                        $(this).mensagemBox("Edição de Maquina", "Maquina Editada com Sucesso!");
                        $(this).Reload_Pagina();
                    }
                });
                return false;
            }
            return false;
        });
        //------------------------------ editar maquina -----------------------------------------//
        $('#data_table_maquina').on('click', '.lk_editar_maquina', function() {
            var id = $(this).attr('rel');
            var url = '../Controller/MaquinaController.php';
            var parametros = {
                id: id,
                acao: "editar"
            };
            $.post(url, parametros, function(data) {
                $("#formMaquinas > .divGrande ").html(data);
                $("#btn_maq").val("Editar");
                $("#id_MAQ").val(id);
                $.getScript("../Resources/Js/scripts.js");
                $.getScript("../Resources/Js/plugins/jquery.maskedinput.min.js");
                $.getScript("../Resources/Js/jquery.dataTables.js");
                $.getScript("../Resources/Js/Script.js");
            });
        });
            });
</script>
<?php
require_once '../Dao/ConexaoMysql.php';
$conexao = new ConexaoMysql();
$conexao->Conecta(); 
@$idmaqu = $_REQUEST['idmaqu'];
if ($idmaqu > 0) {
    $conexao->Consultar('SELECT Maquinas_mac FROM `manutencao` WHERE Maquinas_mac = "' . $idmaqu. '"');
        if ($conexao->total <= 0) {
?><script type="text/javascript">
    $(document).ready(function() {
        //------------------------------ excluir maquina -----------------------------------------//
            var id ="<?php echo $_REQUEST['idmaqu'] ?>";
            var url = '../Controller/MaquinaController.php';
            var parametros = {
                id: id,
                acao: "deletar"
            };
                $.post(url, parametros, function(data) {
                        $(this).mensagemBox("Exclusão de Maquina", "Maquina Excluída com Sucesso!!!");
                        location.href="Maquinas.php";
                });
        });
</script>
    <?php
        } else if ($conexao->total > 0) {
?><script type="text/javascript">

    $(document).ready(function() {
        //------------------------------erro ao excluir maquina -----------------------------------------//
                        $(this).mensagemBoxAlert("Erro de Exclusão", "Maquina Não Pode Excluída !!!");
                             location.href="Maquinas.php";
    });
</script>
    <?php
        }
}
?>
<title>.:: Cadastro de Maquinas ::.</title>
<div class="formulario-modal">
    <div class="logo">
        <img class="imgPage" src="../Resources/Img/107_128x128.png"/>
    </div>
    <form method="post" action="" id="formMaquinas">
        <div class="divPequena">
            <label for="patrimonio" id="patrimonioo" class="quebralinha">Patrimonio:</label>
            <label for="nome" id="nomee" class="quebralinha">Nome:</label>
            <label for="mac" id="macc" class="quebralinha">MAC:</label>
            <label for="conf" id="conff" class="quebralinha">Configuração maquina:</label>
            <label for="laboratorio" id="laboratorio2" class="quebralinha">Laboratório:</label>
        </div>
        <div class="divGrande">
            <input type="text" autofocus name="patrimonio" id="patrimonio" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="nome" id="nome" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="mac" id="mac" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <textarea id="conf" name="conf" placeholder="Digite a configuração da maquina"  maxlength="1000" class="quebralinha text ui-widget-content ui-corner-all"></textarea>
            <select name="laboratorio" id="laboratorio0" class="quebralinha text ui-widget-content ui-corner-all">
                <option value="">Escolha um laboratório</option>
                <?php
                require_once '../Model/Laboratorio.php';
                $laboratorio = new Laboratorio();
                $laboratorio->CarregarLaboratorio();
                ?>
            </select>
        </div>
        <div class="contem_btns">
            <input type="submit" name="Cadastrar" value="Cadastrar" class="btn" id="btn_maq"/>
            <input type="reset" name="limpar" value="Limpar" class="btn"  />
            <input type="hidden" name="id" value="0" id="id_MAQ"/>
        </div>
    </form>
</div>
<div class="data_table" id="data_table_maquina">
    <?php
    require_once '../Model/Maquina.php';
    $maquina = new Maquina();
    $maquina->CarregarTabela();
    ?>
</div>
<?php
require_once '../Template/BottomTemplate.php';
?>