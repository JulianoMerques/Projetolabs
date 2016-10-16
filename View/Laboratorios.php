<?php
require_once '../Template/TopTemplate.php';
require_once '../Seguranca/seguranca.php';
if ($_SESSION['tipo'] == "2" || $_SESSION['tipo'] == "3") {
    header('location:../View/PaginaPrincipal.php?mensagem=acessonegado');
}
?>
<script type="text/javascript">

    $(document).ready(function() {
        if (screen.width <= 773) {
            $("#capac").html("Cap.:");
            $(".capacidade").html("Cap.:");
        }
        //------------------------------ cadastrar laboratorio -----------------------------------------//
        $("#form_laboratorios").submit(function() {

            var id = $("#Laboratorio_id").val();
            var nome = $('#nome').val();
            var capacidade = $('#capacidade').val();


            var url = "../Controller/LaboratorioController.php";

            var parametros = {
                id: id,
                nome: nome,
                capacidade: capacidade,
                acao: "cadastrar"

            };

            if (id !== '' && nome !== '' && capacidade !== '') {
               
                $.post(url, parametros, function(data) {
         
                    $('#Laboratorio_id').val('0');
                    $('#nome').val('');
                    $('#capacidade').val('');

                    if (id === '0') {
                        $(this).mensagemBox("Cadastro de Laboratório", "Laboratório Cadastrado com Sucesso!");
                    } else {
                        $(this).mensagemBox("Edição de Laboratório", "Laboratório Editado com Sucesso!");
                    }
                    $(this).Reload_Pagina();
                });
                return false;
            }
            return false;

        });

        //Script para editar laboratorio
        $('#data_table_laboratorios').on('click', '.lk_editar_laboratorio', function() {

            var id = $(this).attr('rel');
            var url = '../Controller/LaboratorioController.php';
            var parametros = {
                id: id,
                acao: "editar"
            };
            $.post(url, parametros, function(data) {

                $("#form_laboratorios > .divGrande ").html(data);
                $("#btn_lab").val("Editar");
                $("#Laboratorio_id").val(id);
            });
        });
    });
</script>
<?php
require_once '../Dao/ConexaoMysql.php';
$conexao = new ConexaoMysql();
$conexao->Conecta();
@$idLab = $_REQUEST['idLab'];
if ($idLab > 0) {
    $conexao->Consultar('SELECT `Laboratorio_id1` FROM `maquinas` WHERE `Laboratorio_id1` =  "' . $idLab . '"');
    if ($conexao->total <= 0) {
        $conexao->Consultar('SELECT `Laboratorio_id` FROM `manutencao` WHERE `Laboratorio_id` =  "' . $idLab . '"');
        if ($conexao->total <= 0) {
            ?><script type="text/javascript">
                            $(document).ready(function() {
                                //------------------------------ excluir maquina -----------------------------------------//
                                var id = "<?php echo $_REQUEST['idLab'] ?>";
                                var url = '../Controller/LaboratorioController.php';
                                var parametros = {
                                    id: id,
                                    acao: "deletar"
                                };
                                $.post(url, parametros, function(data) {
                                    $(this).mensagemBox("Exclusão de Laboratório", "Laboratório Excluído com Sucesso!!!");
                                    location.href = "Laboratorios.php";
                                });
                            });
            </script>
            <?php
        } else {
            ?><script type="text/javascript">

                            $(document).ready(function() {
            //------------------------------erro ao excluir maquina -----------------------------------------//
                                $(this).mensagemBoxAlert("Erro de Exclusão", "Laboratório Não Pode Excluído !!!");
                                location.href = "Laboratorios.php";
                            });
            </script>
            <?php
        }
    } else if ($conexao->total > 0) {
        ?><script type="text/javascript">

                    $(document).ready(function() {
                        //------------------------------erro ao excluir maquina -----------------------------------------//
                        $(this).mensagemBoxAlert("Erro de Exclusão", "Laboratório Não Pode Excluído !!!");
                        location.href = "Laboratorios.php";
                    });
        </script>
        <?php
    }
}
?>
<title>.:: Cadastro de Laboratórios ::.</title>

<div class="formulario-modal">
    <div class="logo">
        <img class="imgPage" src="../Resources/Img/Laboratório.png"/>
    </div>
    <form method="post" id="form_laboratorios" >
        <div class="divPequena">
            <label for="nome" class="quebralinha">Nome:</label>
            <label for="capacidade" id="capac" class="quebralinha">Capacidade:</label>
        </div>
        <div class="divGrande">
            <input type="text" name="nome"  id="nome" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="capacidade" id="capacidade" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
        </div>
        <div class="contem_btns">
            <input type="submit" name="acao" value="Cadastrar" class="btn" id="btn_lab"/>
            <input type="reset" name="limpar" value="Limpar" class="btn"/>
            <input type="hidden" name="id" value="0" id="Laboratorio_id"/>
        </div>

    </form>
</div>
<div class="data_table" id="data_table_laboratorios">
    <?php
    require_once '../Model/Laboratorio.php';
    $laboratorio = new Laboratorio();
    $laboratorio->CarregarTabela();
    ?>
</div>
<?php
require_once '../Template/BottomTemplate.php';
?>