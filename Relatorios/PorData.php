<?php
require_once '../Template/TopTemplate.php';
?>
    <body>
 <div class="formulario-modal">
                 <div class="logo">
                     <img class="imglogo" src="../Resources/Img/calendario.png"/>
            </div>
     <form method="post" action="RelatoriosManutencao.php">
                    <div class="divPequena">
                        <label for="de" class="quebralinha">De:</label>
                        <label for="ate" class="quebralinha">Até:</label>
                    </div>
                    <div class="divGrande">
                        <input type="date" name="de" id="datepicker" class="quebralinha text ui-widget-content ui-corner-all data" />
                        <input type="date" name="ate" id="datepicker2" class="quebralinha text ui-widget-content ui-corner-all data" />
                    </div>
                    <div class="contem_btns">
                        <input type="submit" name="Relarorio" value="Gerar Relatório" class="btn"/>
                        <input type="reset" name="limpar" value="Limpar" class="btn"  />
                        <input type="hidden" name="tipo" value="Por Data"/>
                    </div>
                   
                </form>
            </div>
<?php
require_once '../Template/BottomTemplate.php';
?>