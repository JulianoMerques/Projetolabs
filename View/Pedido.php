<?php
require_once '../Template/TopTemplate.php';
require_once '../Seguranca/seguranca.php';
if ($_SESSION['tipo'] == "2") {
    header('location:../View/PaginaPrincipal.php?mensagem=acessonegado');
} else if ($_SESSION['tipo'] == "1") {
    header('location:../View/PaginaPrincipal.php?mensagem=acessonegado');
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        //------------------------------ script para carregar select maquinas -----------------------------------------//
        $('#laboratorio').change(function() {
            var id_laboratorio = $('#laboratorio').val();
            var url = '../Controller/PedidoController.php';
            var parametros = {
                Laboratorio: id_laboratorio,
                acao: "Laboratorio"
            };
            $.post(url, parametros, function(data) {
                $('.maqPedido').html(data);
            });
        });
//--------------------------------------------------------------------------------------------------------//
        $("#FormPedido").submit(function() {
            var camposMarcados = new Array();
//            $("input[type=checkbox][name='Pedido[]']:checked").each(function() {
//                camposMarcados.push($(this).val());
//            });
//            

// iniciamos uma string com aspas indicando o vazio;
            var string = "";
// Pegamos o elemento pelo seu nome, no caso 'input'
            var inputs = document.getElementsByTagName('input');
// damos um loop na quantidade de elementos encontrados
            for (var x = 0; x < inputs.length; x++) {
// verificamos se o tipo do mesmo é "checkbox" e se o atributo name é igual à 'campo'
                if (inputs[x].type === "checkbox" && inputs[x].name === 'Pedido[]') {
// verificamos se o elemento está marcado
                    if (inputs[x].checked === true) {
// concatenamos o valor colocando uma virgula no final
                        string += inputs[x].value + ', ';
                    }
                }
            }
// verificamos se o ultimo caractere é uma virgula, e sempre será
            if (/,$/.test(string)) {
// substituimos o mesmo por um vazio
                string = string.replace(/,$/, ".");
            }
            var id = $("#id_pedido").val();
            var tipoManutencao = $("#tipoPedido").val();
            var laboratorio = $('#laboratorio').val();
            var problema = $('#problema').val();
            camposMarcados = string;
            var url = "../Controller/PedidoController.php";
            var parametros = {
                tipoManutencao: tipoManutencao,
                laboratorio: laboratorio,
                camposMarcados: camposMarcados,
                problema: problema,
                acao: "cadastrar"
            };
            if (tipoManutencao !== '' && laboratorio !== '' && camposMarcados !== '' && problema !== '' && id !== '') {
                $.post(url, parametros, function(data) {
                    $('#tipoPedido').val('');
                    $('#laboratorio').val('');
                    $('#Pedido').val('');
                    $('#problema').val('');
                    $('#id_pedido').val('');
                    if (id === '0') {
                        $(this).mensagemBox("Cadastro de Pedido", "Pedido Cadastrado com Sucesso!");
                        $(this).Reload_Pagina();
                    } else {
                        $(this).mensagemBox("Edição de Pedido", "Pedido Editado com Sucesso!");
                        $(this).Reload_Pagina();
                    }
                });
                return false;
            }
            return false;
        });
    });
</script>
<form method="post"  id="FormPedido">
    <div class="pedido">
        <div class="topo">
            <img src="../Resources/Img/logo.png"/>
            <label class="sistem">.:: Sistema de Controle de Manutenção ::.</label>

        </div>
        <div class="divPequena">
            <label for="tipoPedido"> tipo de Manutenção</label>
            <label for="laboratorio">Selecione o Laboratório</label>
           
        </div>
        <div class="divGrande">
            <!--tipo de pedido-->            
            <select name="tipoPedido" id="tipoPedido"  class="text ui-widget-content ui-corner-all">
                <option>Escolha o tipo de manutenção</option>
                <?php
                require_once '../Model/Manutencao.php';
                $manutecao = new Manutencao();
                $manutecao->CarregarTipoManutencao();
                ?>
         </select>
            <!--Laboratório-->
            <select name="labPedido" id="laboratorio" class="text ui-widget-content ui-corner-all">
                <option>Escolha o laboratorio</option>
                <?php
                require_once '../Model/Laboratorio.php';
                $laboratorio = new Laboratorio();
                $laboratorio->CarregarLaboratorio();
                ?>
         </select>
      
        </div>
        <div class="divPequena">
             <label for="Pedido">Selecione as maquinas</label>
             <label for="problema">Descrição do Problema</label>
        </div>
        <div class="divGrande">
                  <!--maquinas-->
            <div class="maqPedido">Selecione um laboratório</div><br>
             <input type="text" name="Problema" id="problema" placeholder="Descreva o problema"id="Problema">
        </div>

    </div>

    <div class="contem_btns">
        <input type="submit" name="Cadastrar" value="Cadastrar/Gerar" class="btn" id="btn_maq"/>
        <input type="reset" name="limpar" value="Limpar" class="btn"  />
        <input type="hidden" name="id" value="0" id="id_pedido"/>

    </div>
</form>

<?php
require_once '../Template/BottomTemplate.php';
?>

