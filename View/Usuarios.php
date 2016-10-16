<?php
require_once '../Template/TopTemplate.php';
require_once '../Seguranca/seguranca.php';
if ($_SESSION['tipo'] == "2") {
    header('location:../View/PaginaPrincipal.php?mensagem=acessonegado');
} else if ($_SESSION['tipo'] == "3") {
    header('location:../View/PaginaPrincipal.php?mensagem=acessonegado');
}
?>
<script type="text/javascript" src="../Resources/Js/jquery.complexify.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if (screen.width <= 773) {
            $("#tipoUserr").html("T. User.:");
            $("#sobrenomee").html("Sobren.:");
            $("#consee").html("Con. Sen.:");
            $("#telefonee").html("Tel.:");
            $("#operacoes").html("Oper:");
        }
 $('#form_usuarios').validate({
            rules: {
                senha: {
                    required: true
                },
                confirmar_senha: {
                    required: true,
                    equalTo: "#senha"
                },
                termos: "required"
            },
            messages: {
                senha: {
                    required: "O campo senha é obrigatório."
                },
                confirmar_senha: {
                    required: "O campo confirmação de senha é obrigatório.",
                    equalTo: "<label style='color:red;'>O campo confirmação de senha deve ser identico ao campo senha.</label>"
                }
            }
 
        });
        	    $(function() {
	        $('.password').pstrength();
	    });
        //------------------------------ cadastrar usuario -----------------------------------------//
        $("#form_usuarios").submit(function() {
            var id = $("#Usuario_id").val();
            var nome = $('#nome').val();
            var sobrenome = $('#sobrenome').val();
            var turno = $('#turno').val();
            var tipousuario = $('#tipousuario').val();
            var email = $('#emaill').val();
            var tel = $('#tel').val();
            var login = $('#login').val();
            var senha = $('#senha').val();
            var consenha = $('#confirmar_senha').val();

                var url = "../Controller/UsuarioController.php";
                var parametros = {
                    id: id,
                    nome: nome,
                    sobrenome: sobrenome,
                    turno: turno,
                    tipousuario: tipousuario,
                    email: email,
                    tel: tel,
                    login: login,
                    senha: senha,
                    acao: "cadastrar"
                };
                if (id !== '' && nome !== '' && sobrenome !== '' && turno !== '' && tipousuario !== '' && email !== '' && tel !== '' && login !== '' && senha !== '') {
                    $.post(url, parametros, function(data) {
                        $('#Usuario_id').val('0');
                        $('#nome').val('');
                        $('#sobrenome').val('');
                        $('#turno').val('');
                        $('#tipousuario').val('');
                        $('#email').val('');
                        $('#tel').val('');
                        $('#login').val('');
                        $('#senha').val('');
                        if (id === '0') {
                            $(this).mensagemBox("cadastro de Usuario", "Usuario cadastrado com sucesso!");
                        } else {
                            $(this).mensagemBox("edição de Usuario", "Usuario editado com sucesso!");
                        }
                        $(this).Reload_Pagina();
                    });
                    return false;
                }
                return false;
        });
        //------------------------------ editar usuario -----------------------------------------//

        $('#data_table_usuario').on('click', '.lk_editar_usuario', function() {

            var id = $(this).attr('rel');
            $('#conse').hide();
            $('#se').hide();

            var url = '../Controller/UsuarioController.php';
            var parametros = {
                id: id,
                acao: "editar"
            };
            $.post(url, parametros, function(data) {
                $("#form_usuarios > .divGrande ").html(data);
                $("#btn_usuario").val("Editar");
                $("#Usuario_id").val(id);
                $.getScript("../Resources/Js/scripts.js");
                $.getScript("../Resources/Js/plugins/jquery.maskedinput.min.js");
                $.getScript("../Resources/Js/jquery.dataTables.js");
                $.getScript("../Resources/Js/Script.js");
            });
        });
        //------------------------------ excluir usuario -----------------------------------------//
        $('#data_table_usuario').on('click', '.lk_excluir_usuario', function() {

            var id = $(this).attr('rel');
            var url = '../Controller/UsuarioController.php';
            var parametros = {
                id: id,
                acao: "deletar"
            };
            $.post(url, parametros, function(data) {
                alert(data);
                $(this).mensagemBox("Exclusão de Usuario", "Usuario Excluído com Sucesso!!!");
                $(this).Reload_Pagina();
            });
        });
    });
</script>
<title>.:: Cadastro de Usuarios ::.</title>

<div class="formulario-modal">
    <div class="logo">
        <img class="imglogo" src="../Resources/Img/503_128x128.png"/>
    </div>
    <form method="post"  id="form_usuarios">
        <div class="divPequena">
            <label for="nome" class="quebralinha">Nome:</label>
            <label id="sobrenomee"  for="sobrenome" class="quebralinha">Sobrenome:</label>
            <label for="turno" class="quebralinha">Turno:</label>
            <label id="tipoUserr"for="tipo-usuario" class="quebralinha">Tipo de Usuario:</label>
            <label for="email" class="quebralinha">E-mail:</label>
            <label for="tel" class="quebralinha">Telefone:</label>
            <label for="login" class="quebralinha">Login:</label>
            <label for="senha" id="se" class="quebralinha">Senha:</label>
            <br>
            <br>
            <br>
            <br>
            <label for="con-senha" id="conse" class="quebralinha">Confirmar Senha:</label>
        </div>
        <div class="divGrande">
            <input type="text" autofocus name="nome" id="nome" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="sobrenome" id="sobrenome" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <select name="turno" id="turno" class="quebralinha text ui-widget-content ui-corner-all">
                <option value="">Escolha o Turno</option>
                <?php
                require_once '../Model/Usuario.php';
                $usuario1 = new Usuario();
                $usuario1->CarregarTurno();
                ?>
            </select>
            <select name="tipousuario" id="tipousuario" class="quebralinha text ui-widget-content ui-corner-all">
                <option value="">Escolha o Tipo de Usuario</option>
                <?php
                require_once '../Model/Usuario.php';
                $usuario = new Usuario();
                $usuario->CarregarTipoUsuario();
                ?>
            </select>
            <input type="email" name="email" id="emaill" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="tel" name="tel" id="tel" maxlength="45"class="celular quebralinha text ui-widget-content ui-corner-all" />
            <input type="text" name="login" id="login" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="password" name="senha" class="password" size="20"  id="senha" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <input type="password" name="confirmar_senha" id="confirmar_senha" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
            <label id="teste"></label>
        </div>
        <div class="contem_btns">
            <input type="submit" name="acao" value="cadastrar" class="btn" id="btn_usuario"/>
            <input type="reset" name="limpar" value="Limpar" class="btn"  />
            <input type="hidden" name="id" value="0" id="Usuario_id"/>
        </div>

    </form>
</div>
<div class="data_table" id="data_table_usuario">
    <?php
    require_once '../Model/Usuario.php';
    $Usuario = new Usuario();
    $Usuario->CarregarTabela();
    ?>
</div>
<?php
require_once '../Template/BottomTemplate.php';
?>