<?php
require_once '../Template/TopTemplate.php';
?>
<body>
    <div class="formulario-modal">
        <div class="logo">
            <img class="imglogo" src="../Resources/Img/RelatorioProblema.png"/>
        </div>
        <form method="post" action="RelatoriosManutencao.php">
            <div class="divPequena">
                <label for="problema" class="quebralinha">Problema:</label>

            </div>
            <div class="divGrande">
<!--                <select name="problema" id="problema" class="quebralinha text ui-widget-content ui-corner-all">
                    <?php
                    ?>
                </select>-->
                <input type="text"name="problema" id="problema" class="quebralinha text ui-widget-content ui-corner-all">

            </div>
            <div class="contem_btns">
                <input type="submit" name="logar" value="Gerar Relatório" class="btn"/>
                <input type="reset" name="limpar" value="Limpar" class="btn"  />
                <input type="hidden" name="tipo" value="Problema"/>
            </div>

        </form>
    </div>
    <?php
    require_once '../Template/BottomTemplate.php';
    ?>