<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="Resources/Img/senha.png">
        <link rel="stylesheet" type="text/css" href="Resources/Css/CssLogin.css">
        <link rel="stylesheet" type="text/css" href="Resources/Css/Mensagens.css">



        <script type="text/javascript" src="Resources/Js/plugins/jquery.msgBox.js"></script>
        <script type="text/javascript" src="Resources/Js/jquery.js"></script>

        <link rel="stylesheet" href="Resources/Css/msgBoxLight.css" type="text/css" media="screen" />
        <title>.:: Login ::.</title>
    </head>
    <body>
        <div class="todo">
            <div class="logo">
                <?php
                if (@$_GET['mensagem'] == 'erro2') {
                    echo ' <img class="imgnegado" src="Resources/Img/acessoNegado.png"/>';
                } else if (@$_GET['mensagem'] == 'erro') {
                    echo ' <img class="imgnegado" src="Resources/Img/acessoNegado.png"/>';
                } else {
                    echo ' <img class="imglogo" src="Resources/Img/logo.png"/>';
                }
                ?>

            </div>

            <div class="login">
                <form method="post" action="Seguranca/autentica.php">
                    <div class="divPequena">
                        <label for="login" class="quebralinha">Login:</label>
                        <label for="senha" class="quebralinha">Senha:</label>
                    </div>
                    <div class="divGrande">
                        <input type="text" name="login" id="login" maxlength="45" autofocus class="quebralinha text ui-widget-content ui-corner-all" />
                        <input type="password" name="senha" id="senha" maxlength="45"class="quebralinha text ui-widget-content ui-corner-all" />
                    </div>
                    <div class="contem_btns">
                        <input type="submit" name="logar" value="Logar" class="btn"/>
                        <input type="reset" name="limpar" value="Limpar" class="btn"  />
                    </div>
                </form>
            </div>
            <div id="msg" class="quebralinha">
                <?php
                if (@$_GET) {
                    if (@$_GET['mensagem'] == 'logar') {
                        echo'<p class="msg"> Precisa logar primeiro</p>';
                    } else
                    if (@$_GET['mensagem'] == 'erro') {
                        echo'<br>';
                        echo'<p class="msg"> Login (e)ou senha incorreto(s)!</p> ';
                    } else
                    if (@$_GET['mensagem'] == 'erro2') {
                        echo'<br>';
                        echo'<p class="msg"> Voce esqueceu algum<br> campo em branco</p>';
                    } else {
                        echo'<br>';
                        echo'<p class="msg"> Você tem que logar !!!</p>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="rodape">
            <h5> Copyright © 2013</h5>
            <h5>Todos os direitos reservados</h5>
        </div>
    </body>
</html>
