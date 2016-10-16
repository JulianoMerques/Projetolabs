<?php
require_once '../Template/TopTemplate.php';
require_once '../Seguranca/seguranca.php';


if ($_GET) {
    if ($_GET['mensagem'] == 'acessonegado') {
        echo '<div class="negado"> 
                        <img class="imgnegado" src="../Resources/Img/acessoNegado.png"/>';
        echo'<p class="msg"><b>' . $_SESSION['admin'] . '</b>  Voce Não tem Acesso a Esta Pagina</p>
                            
</div>';
    }
} else {
    ?>

    <h3><?php echo strtoupper($_SESSION['admin']) . '  ' ?> Bem Vindo ao sistema de controle de manutenção</h3>

    <h2>Pedidos</h2>
    <?php
        if ($_SESSION['tipo'] == '1' ||$_SESSION['tipo'] == '2' ) {
            $id = "0";
        }else{
              $id = $_SESSION['id'];
        }
  
    require_once '../Model/Pedido.php';
    @$pedido = new Pedido();
    @$pedido->setId($id);
    @$pedido->Carregar();
    ?>
    <?php
}
require_once '../Template/BottomTemplate.php';
?>
