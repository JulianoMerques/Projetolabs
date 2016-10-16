<?php
require_once '../Template/TopTemplate.php';
?>
<script type="text/javascript">
    $(document).ready(function() {
        //------------------------------ script para carregar select maquinas -----------------------------------------//
        $('#laboratorio0').change(function() {
            var id_laboratorio = $('#laboratorio0').val();
            var url = '../Controller/MaquinaController.php';
            var parametros = {
                Laboratorio: id_laboratorio,
                acao: "Laboratorio"
            };
            $.post(url, parametros, function(data) {
                $('#maquina').html(data);
            });
        });
            });
</script>
<body>
    <div class="formulario-modal">
        <div class="logo">
            <img class="imglogo" src="../Resources/Img/RelatorioMaquina.png"/>
        </div>
        <form method="post" action="RelatoriosManutencao.php">
            <div class="divPequena">
                <label for="laboratorio" class="quebralinha">Laboratório:</label>
                <label for="maquina" class="quebralinha">Maquina:</label>
            </div>
            <div class="divGrande">
                <?php
                require_once '../Model/Laboratorio.php';
                $laboratorio = new Laboratorio();
                $laboratorio->CarregarSelect_Laboratorio();
                ?>

                <select name="maquina" id="maquina" class="quebralinha text ui-widget-content ui-corner-all">
                    <option>Selecione um laboratório</option>
                </select>
            </div>
            <div class="contem_btns">
                <input type="submit" name="logar" value="Gerar Relatório" class="btn"/>
                <input type="reset" name="limpar" value="Limpar" class="btn"  />
                <input type="hidden" name="tipo" value="Maquina"/>
            </div>

        </form>
    </div>
    <?php
    require_once '../Template/BottomTemplate.php';
    ?>