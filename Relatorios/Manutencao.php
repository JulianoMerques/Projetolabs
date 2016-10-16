<?php
require_once '../Template/TopTemplate.php';
?>
<body>
    <div class="formulario-modal">
        <div class="logo">
            <img class="imglogo" src="../Resources/Img/RelatorioManutencao.png"/>
        </div>
        <form method="post" action="RelatoriosManutencao.php">
            <div class="divPequena">
                <label for="manutencao" class="quebralinha">Manutenção:</label>

            </div>
            <div class="divGrande">
                <select name="manutencao" id="manutencao" class="quebralinha text ui-widget-content ui-corner-all">
                    <option value="">Selecione o tipo de manutenção</option>
                    <?php
                    require_once '../Model/Manutencao.php';
                    $manutencao = new Manutencao();
                    $manutencao->CarregarTipoManutencao();
                    
                    ?>
                </select>
            </div>
            <div class="contem_btns">
                <input type="submit" name="logar" value="Gerar Relatório" class="btn"/>
                <input type="reset" name="limpar" value="Limpar" class="btn"  />
                <input type="hidden" name="tipo" value="Manutencao"/>
            </div>

        </form>
    </div>
    <?php
    require_once '../Template/BottomTemplate.php';