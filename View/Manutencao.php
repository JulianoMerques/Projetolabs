<?php
require_once '../Template/TopTemplate.php';
require_once '../Seguranca/seguranca.php';
if ($_SESSION['tipo'] == "3") {
    header('location:../View/PaginaPrincipal.php?mensagem=acessonegado');
}
?>
<script type="text/javascript">
    $(document).ready(function() {
            if (screen.width <= 773) {
            $("#tipoman").html("T. Man.:");
            $("#laboratorio4").html("Lab.:");

        }
        //------------------------------ script para carregar select maquinas -----------------------------------------//
        $('#laboratorio0').change(function() {
            var id_laboratorio = $('#laboratorio0').val();
            var url = '../Controller/ManutencaoController.php';
            var parametros = {
                Laboratorio: id_laboratorio,
                acao: "Laboratorio"
            };
            $.post(url, parametros, function(data) {
                $('#maquina').html(data);
            });
        }),
        //------------------------------ cadastrar manutenção -----------------------------------------//
        $("#form_Manutencao").submit(function() {
            var id = $("#Manutencao_id").val();
            var tipo = $('#tipo').val();
            var laboratorio = $('#laboratorio0').val();
            var maquina = $('#maquina').val();
            var data = $('#datepicker').val();
            var problema = $('#problema').val();
            var solucao = $('#solucao').val();
            var monitor = $('#usuario12').val();
            var turno = $('#turno').val();


            var url = "../Controller/ManutencaoController.php";

            var parametros = {
                id: id,
                tipo: tipo,
                laboratorio: laboratorio,
                maquina: maquina,
                data: data,
                problema: problema,
                solucao: solucao,
                monitor: monitor,
                turno: turno,
                acao: "cadastrar"
            };
            if (id !== '' && tipo !== '' && laboratorio !== '' && maquina !== '' && 
                    data !== '' && problema !== '' && solucao !== '' && monitor !== '' && turno !== '') {
                $.post(url, parametros, function(data) {
                    $('#Manutencao_id').val('0');
                    $('#tipo').val('');
                    $('#laboratorio0').val('');
                    $('#maquina').val('');
                    $('#datepicker').val('');
                    $('#problema').val('');
                    $('#solucao').val('');
                    $('#usuario').val('');
                    $('#turno').val('');

                    if (id === '0') {
                        $(this).mensagemBox("cadastro de Manutenção", "Manutenção cadastrado com sucesso!");
                    } else {
                        $(this).mensagemBox("edição de Manutenção", "Manutenção editado com sucesso!");
                    }
                    $(this).Reload_Pagina();
                });
                return false;
            }
            return false;

        });
        //------------------------------ excluir manutenção -----------------------------------------//
        $('#data_table_manutencao').on('click', '.lk_excluir_manutencao', function() {

            var id = $(this).attr('man');
            var url = '../Controller/ManutencaoController.php';
            var parametros = {
                id: id,
                acao: "deletar"
            };
            $.post(url, parametros, function(data) {

                $(this).mensagemBox("Exclusão de Manutenção", "Manutenção Excluída com Sucesso!!!");
                $(this).Reload_Pagina();
            });
        });
        //------------------------------ editar manutenção -----------------------------------------//
        $('#data_table_manutencao').on('click', '.lk_editar_manutencao', function() {

            var id = $(this).attr('man');
            var url = '../Controller/ManutencaoController.php';
            var parametros = {
                id: id,
                acao: "editar"
            };
            $.post(url, parametros, function(data) {

                $("#form_Manutencao > .divGrande ").html(data);
                $("#btn_man").val("Editar");
                $("#Manutencao_id").val(id);
                $.getScript("../Resources/Js/scripts.js");
                $.getScript("../Resources/Js/plugins/jquery.maskedinput.min.js");
                $.getScript("../Resources/Js/jquery.dataTables.js");
                $.getScript("../Resources/Js/Script.js");

            });
        });
    });
</script>

<title>.:: Cadastro de Manutenção ::.</title>

<div class="formulario-modal">
    <div class="logo">
        <img class="imglogo" src="../Resources/Img/Manutençao.png"/>
    </div>
    <form method="post" action="" id="form_Manutencao">
        <div class="divPequena">
            <label for="tipo" id="tipoman" class="quebralinha">Tipo Manutenção:</label>
            <label for="laboratorio" id="laboratorio4" class="quebralinha">Laboratorio:</label>
            <label for="maquina" class="quebralinha">Maquina:</label>
            <label for="datepicker" class="quebralinha">Data:</label>
            <label for="problema" class="quebralinha">Problema:</label>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <label for="solucao" class="quebralinha">Solução:</label>
            <br>
            <br>
            <br>
            <br>
            <label for="usuario" class="quebralinha">Monitor:</label>
            <label for="turno" class="quebralinha">Turno:</label>
        </div>
        <div class="divGrande">
            <select name="tipo" id="tipo" class="quebralinha text ui-widget-content ui-corner-all">
                <option value="">Escolha o tipo de manutenção</option>
                <?php
                require_once '../Model/Manutencao.php';
                @$tipo = new Manutencao();
                @$tipo->CarregarTipoManutencao();
                ?>
            </select>

            <?php
            require_once '../Model/Laboratorio.php';
            @$laboratorio = new Laboratorio();
            @$laboratorio->CarregarSelect_Laboratorio();
            ?>

            <select name="maquina" id="maquina" autofocus class="quebralinha text ui-widget-content ui-corner-all">
                <option value="">Escolha um Maquina</option>
            </select>

            <input type="date" name="data" id="datepicker" maxlength="45"class="data quebralinha text ui-widget-content ui-corner-all" />
            <textarea id="problema" name="problema" placeholder="Digite o problema da maquina"  maxlength="1000" class="quebralinha text ui-widget-content ui-corner-all"></textarea>
            <textarea id="solucao" name="solucao" placeholder="Digite a soluçao da maquina"  maxlength="1000" class="quebralinha text ui-widget-content ui-corner-all"></textarea>

            <label  value='<?php echo $_SESSION['id'] ?>'><?php echo $_SESSION['admin'] ?></label>
            <input type="hidden" name="usuario" id="usuario"  value="<?php echo $_SESSION['id'] ?>" />

            <select name="turno" id="turno" class="quebralinha text ui-widget-content ui-corner-all">
                <option value="">Escolha um Turno</option>
                <?php
                require_once '../Model/Manutencao.php';
                $turno = new Manutencao();
                $turno->CarregarTurno();
                ?>
            </select>
        </div>
        <div class="contem_btns">
            <input type="submit" name="acao" value="Cadastrar" class="btn" id="btn_man"/>
            <input type="reset" name="limpar" value="Limpar" class="btn"  />
            <input type="hidden" name="id" value="0" id="Manutencao_id"/>
        </div>

    </form>
</div>
<div class="data_table" id="data_table_manutencao">
    <?php
    require_once '../Model/Manutencao.php';
    $manutencao = new Manutencao();
    $manutencao->Carregar();
    ?>
</div>
<?php
require_once '../Template/BottomTemplate.php';
?>