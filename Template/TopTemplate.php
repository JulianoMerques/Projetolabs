<?php   
session_start();

require_once '../Seguranca/seguranca.php';
echo '
<!--
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
        <link href="../Resources/Css/jquery.dataTables_themeroller.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="../Resources/Css/shadowbox.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../Resources/Css/msgBoxLight.css" type="text/css" media="screen" />

        <script type="text/javascript" src="../Resources/Js/jquery.js"></script>
        <script type="text/javascript" src="../Resources/Js/jquery-ui.js"></script>
        <script type="text/javascript" src="../Resources/Js/Script.js"></script>
        <script type="text/javascript" src="../Resources/Js/jquery.pstrength-min.1.2.js"></script>
        <script type="text/javascript" src="../Resources/Js/plugins/jquery.validate.js"></script>
        <script type="text/javascript" src="../Resources/Js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../Resources/Js/plugins/jquery.action.dataTables.js"></script>
        <script type="text/javascript" src="../Resources/Js/shadowbox.js"></script>
        <script type="text/javascript" src="../Resources/Js/plugins/jquery.msgBox.js"></script>
        <script type="text/javascript" src="../Resources/Js/plugins/jquery.maskedinput.min.js"></script>
                <script type="text/javascript">
    Shadowbox.init({
        language: "pt",
        player: ["img", "html", "swf"],
        counterType:"skip", counterLimit:20, counterFromCurrent:true
       
    });

     </script>
';
if ($_SESSION['tipo'] == "2") {


    echo '
        <script type="text/javascript">
            
            $(document).ready(function (){
                 $("#lab").hide();
                 $("#maq").hide();
                 $("#usu").hide();
                 $("#relusu").hide();

            });
        </script>';
}else if ($_SESSION['tipo'] == "3") {


    echo '
        <script type="text/javascript">
            
            $(document).ready(function (){
                 $("#lab").hide();
                 $("#maq").hide();
                 $("#usu").hide();
                 $("#relusu").hide();
                 $("#man").hide();

            });
        </script>';
}
echo '
    <title> .:: Sistema de Controle de Manutenção ::.</title>
</head>
<body>
    <div class="todo">
        <div class="topo">
            <img  class="img" src="../Resources/Img/logociet.png"/>


';

if (isset($_SESSION['admin'])) {
    echo'<label id="usuario">Ola Sr.(a) ' . strtolower($_SESSION['admin']) . '</label>
   <div class="logar">';
    echo ' <a href="../Seguranca/Logout.php"><img  src="../Resources/Img/login.png" title="Sair"/><label class="logar1">Logout</label></a>';
}

echo'
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
                <li>
                    <a class="pai_menu"   id="lab" href="../View/Laboratorios.php">
                        <img class="imgMenu" src="../Resources/Img/Laboratório.png"/>
                        <span><label>Laboratórios</label></span>
                    </a>
                </li>
                <li>
                    <a class="pai_menu" id="maq" href="../View/Maquinas.php" >
                        <img class="imgMenu" src="../Resources/Img/107_128x128.png"/>
                        <span><label>Maquinas</label></span>
                    </a>
                </li>
                <li>
                    <a class="pai_menu" id="man" href="../View/Manutencao.php" >
                        <img class="imgMenu" src="../Resources/Img/Manutençao.png"/>
                        <span><label>Manutenção</label></span>
                    </a>
                </li>

                <li>
                    <a class="pai_menu" id="usu" href="../View/Usuarios.php">
                        <img class="imgMenu" src="../Resources/Img/503_128x128.png"/>
                        <span><label>Usuários</label></span>
                    </a>
                </li>
';

if ($_SESSION['tipo'] == "3") {
    
    echo '                <li>
                    <a class="pai_menu" id="ped" href="../View/Pedido.php">
                        <img class="imgMenu" src="../Resources/Img/1588_64x64.png"/>
                        <span><label>Pedidos</label></span>
                    </a>
                </li>';
}
echo'

                <li>
                    <a class="pai_menu">
                        <img class="imgMenu" src="../Resources/Img/Relatorio.png"/>
                        Relatórios
                    </a>
                    <div class="conteudoMenu" id="cad">
                        <ul>  
                            <li>
                                <a class="pai_Submenu" id="relusu" href="../Relatorios/Usuarios.php">
                                    <img class="imgsubmenu" src="../Resources/Img/RelatorioUsuario.png"/>
                                    Usuario
                                </a>
                            </li>
                            <li>
                                <a class="pai_Submenu" id="rel" href="../Relatorios/RelatorioLabs.php">
                                    <img class="imgsubmenu" src="../Resources/Img/Laboratório.png"/>
                                    Laboratório
                                </a>
                            </li>
                            <li>
                                <a class="pai_Submenu" id="rel" href="../Relatorios/Maquinas.php">
                                    <img class="imgsubmenu" src="../Resources/Img/107_128x128.png"/>
                                    Maquinas
                                </a>
                            </li>
                            <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                            <li>
                                <a class="pai_Submenu" id="rel" href="../Relatorios/RelatoriosManutencao.php?tipo=Completo">
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
                </li>
            </ul>
        </div>
        <div class="conteudo">
            ';
?>
