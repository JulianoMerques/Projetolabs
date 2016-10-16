<?php
require_once '../Template/TopTemplate.php';
?>

<body>
    <div class="formulario-modal">
        <div class="logo">
            <img class="imglogo" src="../Resources/Img/107_128x128.png"/>
        </div>
        <form method="post" action="RelatorioMaq.php">
            <div class="divPequena">
                <label for="tipoPDF" class="quebralinha">Escolha o tipo de PDF:</label>

            </div>
            <div class="divGrande">


                <select name="tipo" id="maquinas" class="quebralinha text ui-widget-content ui-corner-all">
                    <option>Selecione um Relátorio</option>
                    <option value="0">Completo</option>
<?php 
                    require_once '../Model/Laboratorio.php';
                    $laboratorio = new Laboratorio();
                    $laboratorio->CarregarLaboratorio();
?>

                </select>
            </div>
            <div class="contem_btns">
                <input type="submit" name="Relatorio" value="Gerar Relatório" class="btn"/>
                <input type="reset" name="limpar" value="Limpar" class="btn"  />
            </div>

        </form>
    </div>
    <?php
    require_once '../Template/BottomTemplate.php';
    ?>