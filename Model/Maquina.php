<?php

class Maquina {

    private $patrimonio;
    private $nome;
    private $mac;
    private $laboratorio;
    private $conf;

    function __construct() {
        
    }

    public function getPatrimonio() {
        return $this->patrimonio;
    }

    public function setPatrimonio($patrimonio) {
        $this->patrimonio = $patrimonio;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getMac() {
        return $this->mac;
    }

    public function setMac($mac) {
        $this->mac = $mac;
    }

    public function getLaboratorio() {
        return $this->laboratorio;
    }

    public function setLaboratorio($laboratorio) {
        $this->laboratorio = $laboratorio;
    }

    public function getConf() {
        return $this->conf;
    }

    public function setConf($conf) {
        $this->conf = $conf;
    }

    public function Inserir() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'INSERT INTO `maquinas`(`mac`, `Patrimonio`, `nome`, `conf_maquina`, `Laboratorio_id1`) 
            VALUES 
            ("' . $this->mac . '",
                ' . $this->patrimonio . ',
                    "' . $this->nome . '",
                        "' . $this->conf . '",
                            ' . $this->laboratorio . ')';
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function Editar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'UPDATE `maquinas` SET 
                    Patrimonio=' . $this->patrimonio . ',
                         nome="' . $this->nome . '",
                             conf_maquina="' . $this->conf . '",
                                Laboratorio_id1=' . $this->laboratorio . '
                                    WHERE mac="' . $this->mac . '"';
        print_r($sql);
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function Deletar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'DELETE FROM `maquinas` WHERE mac ="' . $this->mac . '"';
        print_r($sql);
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function carregarPDF() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT m.mac as mac,m.Patrimonio as Patrimonio,m.nome as nome,l.nome as laboratorio FROM maquinas m, laboratorio l where 
            m.Laboratorio_id1 = l.id
            order by nome';
        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

    public function carregarPDF2($tipo) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT m.mac as mac,m.Patrimonio as Patrimonio,m.nome as nome,l.nome as laboratorio FROM maquinas m, laboratorio l where 
            m.Laboratorio_id1 = l.id  and
            m.Laboratorio_id1 = ' . $tipo . '
            order by nome';


        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

    public function CarregarTabela() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT DISTINCT 
            m.mac as mac,m.nome as maquina, l.nome as laboratorio, m.Patrimonio as patrimonio,
            m.conf_maquina as configuracao FROM maquinas m,laboratorio l where m.Laboratorio_id1 = l.id';

        $resultado = $conexao->Consultar($sql);

        $html = '<table class="paginar display Tabela" summary="Tabela contendo Maquinas."   >';
        $html .= '<caption>Lista de Maquinas Cadastrados</caption>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th id="patrimonios">Patrimonio </th>';
        $html .= '<th id="nome">Nome </th>';
        $html .= '<th id="mac">MAC </th>';
        $html .= '<th id="configuracao">Configuração</th>';
        $html .= '<th id="laboratorio3">Laboratório </th>';


        $html .= '<th id="operacoes">Operações </th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        while ($linha = mysql_fetch_array($resultado)) {

            $html .='<tr>';

            $html .='<td id="patrimonios" headers="patrimonio">' . utf8_encode($linha['patrimonio']) . '</td>';
            $html .='<td id="nome" headers="nome">' . utf8_encode($linha['maquina']) . '</td>';
            $html .='<td id="mac" headers="mac">' . utf8_encode($linha['mac']) . '</td>';
            $html .='<td id="configuracao" headers="configuracao">' . utf8_encode($linha['configuracao']) . '</td>';
            $html .='<td id="laboratorio3" headers="laboratorio">' . utf8_encode($linha['laboratorio']) . '</td>';



            $html .='<td id="operacoes" headers="operacoes">
                <a href="javascript:void(0)" class="lk_editar_maquina" title="Editar" rel="' . $linha['mac'] . '" ><img src="../Resources/Img/Pencil.png" width="30px"></a> &nbsp;
                <a href="Maquinas.php?idmaqu=' . $linha['mac'] . '" class="lk_excluir_maquina" title="Excluir"  rel="' . $linha['mac'] . '" ><img src="../Resources/Img/deletar.png" width="30px"></a>
                </td>';
            $html .='</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        echo $html;
    }

    public function CarregarMaquina() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT * FROM `maquinas`';

        $resultado = $conexao->Consultar($sql);
        while ($row = mysql_fetch_array($resultado)) {
            echo '<option value="' . $row['mac'] . '">' . utf8_encode($row['nome']) . '</option>';
        }
        $conexao->Desconecta();
    }

    public function CarregarPorID() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM maquinas WHERE mac="' . $this->mac . '"';

        $resultado = $conexao->Consultar($sql);
        while ($linha = mysql_fetch_array($resultado)) {

            $this->mac = $linha['mac'];
            $this->patrimonio = $linha['Patrimonio'];
            $this->nome = $linha ['nome'];
            $this->conf = $linha ['conf_maquina'];
            $this->laboratorio = $linha ['Laboratorio_id1'];
        }
        $conexao->Desconecta();
    }

    public function Carregar_laboratorio_selecionada() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM `laboratorio`';
        return $conexao->Consultar($sql);
        $conexao->Desconecta();
    }

    public function CarregarSelect_Maquina($Laboratorio) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM `maquinas` WHERE  `Laboratorio_id1` =' . @$Laboratorio;
        $resultado = $conexao->Consultar($sql);
        if ($conexao->total > 0) {
            echo'<option value="0" selected="selected">Selecione uma maquina</option>';
            while ($linha = mysql_fetch_array($resultado)) {
                echo'<option value="' . $linha['mac'] . '">' . $linha['nome'] . '</option>';
            }
        } else {
            echo'<option value="0" selected="selected">Nenhuma Maquina Cadastrada</option>';
        }
        $conexao->Desconecta();
    }

}

?>
