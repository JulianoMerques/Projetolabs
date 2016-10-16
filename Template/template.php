
<?php
session_start();
//require_once '../Seguranca/seguranca.php';
?><!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="../Resources/Img/logo.png">
        <link rel="stylesheet" type="text/css" href="../Resources/Css/CssPage.css">
        <link rel="stylesheet" type="text/css" href="../Resources/Css/CssMenus.css">

        <link href="../Resources/Css/jquery-ui.css" type="text/css" rel="stylesheet">
        <link href="../Resources/Css/jquery.dataTables.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="../Resources/Css/shadowbox.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../Resources/Css/msgBoxLight.css" type="text/css" media="screen" />

        <script type="text/javascript" src="../Resources/Js/jquery.js"></script>
        <script type="text/javascript" src="../Resources/Js/jquery-ui.js"></script>
        <script type="text/javascript" src="../Resources/Js/Script.js"></script>

        <script type="text/javascript" src="../Resources/Js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../Resources/Js/plugins/jquery.action.dataTables.js"></script>
        <script type="text/javascript" src="../Resources/Js/shadowbox.js"></script>
        <script type="text/javascript" src="../Resources/Js/plugins/jquery.msgBox.js"></script>
        <script type="text/javascript" src="../Resources/Js/plugins/jquery.maskedinput.min.js"></script>
<?php
if (@$_SESSION['tipo'] == "2") {
    

?>
        <script type="text/javascript">
            
            $(document).ready(function (){
                 $("#lab").hide();
                 $("#maq").hide();
                 $("#usu").hide();

            });
        </script>
        <?php 
}
?>
    <title> .:: Sistema de Controle de Manutenção ::.</title>
</head>
<body>
    <div class="todo">
        <div class="topo">
            <img  class="img" src="../Resources/Img/logo.png"/>
            <div class="nameSist">

                <img src="../Resources/Img/Banner.png"/>

            </div>

            <div class="logar">
                <?php
                if (isset($_SESSION['admin'])) {
                    echo ' <a href="../Seguranca/Logout.php"><img src="../Resources/Img/login.png" title="Sair"/><label>Logout</label></a>';
                    echo'<label class="logar">Ola Sr.(a) ' . strtolower($_SESSION['admin']) . '</label>';
                } else {
                    echo '<a href="../index.php"><img  src="../Resources/Img/logout.png" title="Logar"/><label class="logar">Login</label></a>';
                }
                ?>

            </div>
        </div>

        <div class="menu">
            <ul>
                <li>
                    <a class="pai_menu" href="../View/PaginaPrincipal.php">
                        <img class="imgMenu"  src="../Resources/Img/home 4235_64x64.png"/>
                        <span><label>Home</label></span>
                    </a>
                </li>
                <li id="lab">
                    <a class="pai_menu"   href="../View/Laboratorios.php">
                        <img class="imgMenu" src="../Resources/Img/home 4235_64x64.png"/>
                        <span><label>Laboratórios</label></span>
                    </a>
                </li>
                <li>
                    <a class="pai_menu" id="maq" href="../View/Maquinas.php">
                        <img class="imgMenu" src="../Resources/Img/107_128x128.png"/>
                        <span><label>Maquinas</label></span>
                    </a>
                </li>
                <li>
                    <a class="pai_menu" href="../View/Manutencao.php">
                        <img class="imgMenu" src="../Resources/Img/home 4235_64x64.png"/>
                        <span><label>Manutenção</label></span>
                    </a>
                </li>

                <li>
                    <a class="pai_menu" id="usu" href="../View/Usuarios.php">
                        <img class="imgMenu" src="../Resources/Img/503_128x128.png"/>
                        <span><label>Usuários</label></span>
                    </a>
                </li>





                <li>
                    <a class="pai_menu">
                        <img class="imgMenu" src="../Resources/Img/Relatorio.png"/>
                        Relatórios
                    </a>
                    <div class="conteudoMenu" id="cad">
                        <ul>  
                            <li>
                                <a class="pai_Submenu" id="rel" name="completo">
                                    <img class="imgsubmenu" src="../Resources/Img/RelatorioUsuario.png"/>
                                    Usuario
                                </a>

                                <div class="conteudoMenu">
                                    <ul>
                                        <a href="../Relatorios/Professor.php"><img class="imgsubmenu" src="../Resources/Img/calendario.png"/>  Professor</a>
                                        <a href="../Relatorios/Monitor.php"><img class="imgsubmenu" src="../Resources/Img/1588_64x64.png"/>  Monitor</a>
                                        <a href="../Relatorios/Administrador.php"><img class="imgsubmenu" src="../Resources/Img/RelatorioManutencao.png"/>  Admin.</a>
                                    </ul>
                                </div>
                            </li>
                            <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                            <li>
                                <a class="pai_Submenu" id="rel" href="../Relatorios/RelatoriosManutencao.php">
                                    <img class="imgsubmenu" src="../Resources/Img/RelatorioManutencao.png"/>
                                    <input type="hidden" name="Tipo" value="Completo">
                                    Manutenção
                                </a>

                                <div class="conteudoMenu">
                                    <ul>
                                        <a href="../Relatorios/PorData.php"><img class="imgsubmenu" src="../Resources/Img/calendario.png"/>  Por Data</a>
                                        <a href="../Relatorios/Manutencao.php"><img class="imgsubmenu" src="../Resources/Img/RelatorioManutencao.png"/>  Manutenção</a>
                                        <a href="../Relatorios/Maquina.php"><img class="imgsubmenu" src="../Resources/Img/107_128x128.png"/>  Por Maquina</a>
                                        <a href="../Relatorios/Problema.php"><img class="imgsubmenu" src="../Resources/Img/Problema.png"/>  Por Problema</a>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
             </ul>
        </div>
        <div class="conteudo">
            <div class="BemVindo">
            <h3>Bem Vindos ao sistema de controle de manutenção</h3>

        </div>
        </div>

        <div class="rodape">
            <h5> Copyright © 2013</h5>
            <h5>Todos os direitos reservados</h5>
        </div>

    </div>
</body>
</html>
