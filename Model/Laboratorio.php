<?php

class Laboratorio {

    private $id;
    private $nome;
    private $capacidade;

    function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCapacidade() {
        return $this->capacidade;
    }

    public function setCapacidade($capacidade) {
        $this->capacidade = $capacidade;
    }

    public function Inserir() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'INSERT INTO `laboratorio`(`id`, `nome`, `capacidade`) 
        VALUES 
        ("","' . $this->nome . '",
            ' . $this->capacidade . ')';
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function Editar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'UPDATE laboratorio 
                    SET nome="' . utf8_decode($this->nome) . '",
                            capacidade=' . $this->capacidade . '
                                            WHERE id = ' . $this->id;
        print_r($sql);
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function Deletar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'DELETE FROM `laboratorio` WHERE  id = ' . $this->id;

        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function CarregarPorID() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM laboratorio WHERE id=' . $this->id;

        $resultado = $conexao->Consultar($sql);
        while ($linha = mysql_fetch_array($resultado)) {
            $this->id = $linha['id'];
            $this->nome = $linha['nome'];
            $this->capacidade = $linha['capacidade'];
        }
        $conexao->Desconecta();
    }

    public function CarregarTabela() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT DISTINCT * FROM `laboratorio`';

        $resultado = $conexao->Consultar($sql);

        $html = '<table class="paginar display Tabela" summary="Tabela contendo Laboratorios.">';
        $html .= '<caption>Lista de Laboratorios cadastrados</caption>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th id="nome">Nome </th>';

        $html .= '<th id="capacidade" class="capacidade">Capacidade</th>';
        $html .= '<th id="operacoes">Operações </th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        while ($linha = mysql_fetch_array($resultado)) {

            $html .='<tr>';
            $html .='<td headers="nome">' . utf8_encode($linha['nome']) . '</td>';
            $html .='<td headers="capacidade">' . utf8_encode($linha['capacidade']) . '</td>';


            $html .='<td headers="operacoes">
                <a href="javascript:void(0)" class="lk_editar_laboratorio" title="Editar" rel="' . $linha['id'] . '" ><img class="editar" src="../Resources/Img/Pencil.png" width="30px"></a> &nbsp;
                <a href="Laboratorios.php?idLab=' . $linha['id'] . '" class="lk_excluir_laboratorio" title="Excluir"  rel="' . $linha['id'] . '" ><img src="../Resources/Img/deletar.png" width="30px"></a>
                </td>';
            $html .='</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        echo $html;
    }

    public function CarregarLaboratorio() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT * FROM `laboratorio`';

        $resultado = $conexao->Consultar($sql);
        while ($row = mysql_fetch_array($resultado)) {
            echo '<option value="' . $row['id'] . '">' . utf8_encode($row['nome']) . '</option>';
        }
        $conexao->Desconecta();
    }

    public function CarregarSelect_Laboratorio() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT id,nome FROM laboratorio ORDER BY nome ASC';
        $resultado = $conexao->Consultar($sql);
        echo'<select name="laboratorio" id="laboratorio0" class="quebralinha text ui-widget-content ui-corner-all">';
        if ($conexao->total > 0) {
            echo'<option value="">Escolha um laboratório</option>';


            while ($linha = mysql_fetch_array($resultado)) {
                echo'<option value="' . $linha['id'] . '">' . utf8_encode($linha['nome']) . '</option>';
            }
        } else {
            echo'<option value="" selected="selected">Nenhum Laboratório Cadastrado</option>';
        }
        echo'</select>';
        $conexao->Desconecta();
    }

    public function Carregarpdf() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT * FROM `laboratorio` order by nome';


        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

}

?>
