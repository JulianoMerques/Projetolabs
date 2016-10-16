<?php

class Manutencao {

    private $id;
    private $tipo;
    private $laboratorio;
    private $maquina;
    private $data;
    private $problema;
    private $solucao;
    private $monitor;
    private $turno;

    function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getLaboratorio() {
        return $this->laboratorio;
    }

    public function setLaboratorio($laboratorio) {
        $this->laboratorio = $laboratorio;
    }

    public function getMaquina() {
        return $this->maquina;
    }

    public function setMaquina($maquina) {
        $this->maquina = $maquina;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getProblema() {
        return $this->problema;
    }

    public function setProblema($problema) {
        $this->problema = $problema;
    }

    public function getSolucao() {
        return $this->solucao;
    }

    public function setSolucao($solucao) {
        $this->solucao = $solucao;
    }

    public function getMonitor() {
        return $this->monitor;
    }

    public function setMonitor($monitor) {
        $this->monitor = $monitor;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
    }

    public function Inserir() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'INSERT INTO `manutencao`(`id`, `TipoManutencao_id`, `Laboratorio_id`, `Maquinas_mac`,
                    `data`, `problema`, `solucao`, `Usuario_id`, `Turno_id`) 
                        VALUES 
                        ("",' . $this->tipo . ',
                            ' . $this->laboratorio . ',
                                "' . $this->maquina . '",
                                    "' . $conexao->ConveteDataBanco($this->data) . '",
                                        "' . $this->problema . '",
                                            "' . $this->solucao . '",
                                                ' . $this->monitor . ',
                                                    ' . $this->turno . ')';
        print_r($sql);
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function Editar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'UPDATE manutencao SET 
            TipoManutencao_id=' . $this->tipo . ',
                Laboratorio_id=' . $this->laboratorio . ',
                    Maquinas_mac="' . $this->maquina . '",
                        data="' . $conexao->ConveteDataBanco($this->data) . '",
                            problema="' . $this->problema . '",
                                solucao="' . $this->solucao . '",
                                    Usuario_id=' . $this->monitor . ',
                                        Turno_id=' . $this->turno . ' WHERE id=' . $this->id;
        print_r($sql);
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function deletar() {
                require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'DELETE FROM `manutencao` WHERE id = ' . $this->id;

        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function Carregar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT m.id as id, tm.tipo as manutencao, l.nome as laboratorio, ma.nome as maquina,
            m.data as data, m.problema as problema, m.solucao as solucao, u.nome as usuario , t.turno as turno
            FROM manutencao m, tipomanutencao tm,usuario u, maquinas ma, laboratorio l,  turno t
            WHERE 
            m.TipoManutencao_id = tm.id and
            m.Laboratorio_id = l.id and
            m.Maquinas_mac = ma.mac and
            m.Usuario_id = u.id and
            m.Turno_id = t.id
            ';
        $resultado = $conexao->Consultar($sql);
        $conexao->Desconecta();
        $html = '<table class="paginar display" summary="Tabela contendo todas as manutenções cadastradas.">';
        $html .= '<caption>Lista de manutenções cadastradas</caption>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th id="tipomanutencao"> Tipo manutenção </th>';
        $html .= '<th id="laboratorio"> Laboratório </th>';
        $html .= '<th id="maquina"> Maquina </th>';
        $html .= '<th id="datas"> Data </th>';
        $html .= '<th id="problemas"> Problema </th>';
        $html .= '<th id="solucao1"> Solução </th>';
        $html .= '<th id="usuarios"> Usuario </th>';
        $html .= '<th id="turnos"> Turno </th>';
        $html .= '<th id="operacoes"> Operações </th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        while ($linha = mysql_fetch_array($resultado)) {

            $html .='<tr>';
            $html .='<td id="tipomanutencao" headers="tipomanutencao">' . utf8_encode($linha['manutencao']) . '</td>';
            $html .='<td id="laboratorio" headers="laboratorio">' . utf8_encode($linha['laboratorio']) . '</td>';
            $html .='<td id="maquina" headers="maquina">' . utf8_encode($linha['maquina']) . '</td>';
            $html .='<td id="datas" headers="data">' . $conexao->ConveteDataBrasil($linha['data']) . '</td>';
            $html .='<td id="problemas" headers="problema">' . utf8_encode($linha['problema']) . '</td>';
            $html .='<td id="solucao1" headers="solucao">' . utf8_encode($linha['solucao']) . '</td>';
            $html .='<td id="usuarios" headers="usuario">' . utf8_encode($linha['usuario']) . '</td>';
            $html .='<td id="turnos" headers="turno">' . utf8_encode($linha['turno']) . '</td>';
            $html .='<td id="operacoes" headers="operacoes">
                <a href="javascript:void(0)" class="lk_editar_manutencao" title="Editar" man="' . $linha['id'] . '" ><img src="../Resources/Img/Pencil.png"></a> &nbsp;
                <a href="javascript:void(0)" class="lk_excluir_manutencao" title="Excluir"  man="' . $linha['id'] . '" ><img src="../Resources/Img/deletar.png"></a>
                </td>';
            $html .='</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        echo $html;
    }

    public function CarregarTurno() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT * FROM `turno`';

        $resultado = $conexao->Consultar($sql);
        while ($row = mysql_fetch_array($resultado)) {
            echo '<option value="' . $row['id'] . '">' . utf8_encode($row['turno']) . '</option>';
        }
        $conexao->Desconecta();
    }

    public function CarregarTipoManutencao() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT * FROM `tipomanutencao`';

        $resultado = $conexao->Consultar($sql);
        while ($row = mysql_fetch_array($resultado)) {
            echo '<option value="' . $row['id'] . '">' . utf8_encode($row['tipo']) . '</option>';
        }
        $conexao->Desconecta();
    }

    public function CarregarSelect_Maquina($Laboratorio) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM `maquinas` WHERE  `Laboratorio_id1` =' . $Laboratorio;
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

    public function CarregarPorID() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM manutencao WHERE id=' . $this->id;

        $resultado = $conexao->Consultar($sql);
        while ($linha = mysql_fetch_array($resultado)) {

            $this->tipo = $linha['TipoManutencao_id'];
            $this->laboratorio = $linha['Laboratorio_id'];
            $this->maquina = $linha['Maquinas_mac'];
            $this->data = $linha['data'];
            $this->problema = $linha['problema'];
            $this->solucao = $linha['solucao'];
            $this->monitor = $linha['Usuario_id'];
            $this->turno = $linha['Turno_id'];
        }
        $conexao->Desconecta();
    }

    public function Carregar_TipoManutencao_selecionada() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM `tipomanutencao`';
        return $conexao->Consultar($sql);
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

    public function Carregar_maquina_selecionada($idlab) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM maquinas WHERE Laboratorio_id1 = ' . $idlab;
        return $conexao->Consultar($sql);
        $conexao->Desconecta();
    }

    public function Carregar_turno_selecionado() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM `turno`';
        return $conexao->Consultar($sql);
        $conexao->Desconecta();
    }

    public function Carregarpdf_pordata($de, $ate) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT m.id as id, tm.tipo as manutencao, l.nome as laboratorio, ma.nome as maquina,
            m.data as data, m.problema as problema, m.solucao as solucao, u.nome as usuario , t.turno as turno
            FROM manutencao m, tipomanutencao tm,usuario u, maquinas ma, laboratorio l,  turno t
            WHERE 
            m.TipoManutencao_id = tm.id and
            m.Laboratorio_id = l.id and
            m.Maquinas_mac = ma.mac and
            m.Usuario_id = u.id and
            m.Turno_id = t.id and 
            data>="' . $de . '" and 
            data<="' . $ate . '"';

        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

    public function Carregarpdf_manutencao($tipomanutencao) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT m.id as id, tm.tipo as manutencao, l.nome as laboratorio, ma.nome as maquina,
            m.data as data, m.problema as problema, m.solucao as solucao, u.nome as usuario , t.turno as turno
            FROM manutencao m, tipomanutencao tm,usuario u, maquinas ma, laboratorio l,  turno t
            WHERE 
            m.TipoManutencao_id = tm.id and
            m.Laboratorio_id = l.id and
            m.Maquinas_mac = ma.mac and
            m.Usuario_id = u.id and
            m.Turno_id = t.id and 
            TipoManutencao_id = ' . $tipomanutencao . '';

        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

    public function Carregarpdf_maquina($laboratorio, $maquina) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT m.id as id, tm.tipo as manutencao, l.nome as laboratorio, ma.nome as maquina,
            m.data as data, m.problema as problema, m.solucao as solucao, u.nome as usuario , t.turno as turno
            FROM manutencao m, tipomanutencao tm,usuario u, maquinas ma, laboratorio l,  turno t
            WHERE 
            m.TipoManutencao_id = tm.id and
            m.Laboratorio_id = l.id and
            m.Maquinas_mac = ma.mac and
            m.Usuario_id = u.id and
            m.Turno_id = t.id and 
            Laboratorio_id = ' . $laboratorio . ' and
            Maquinas_mac = "' . $maquina . '"';

        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

    public function Carregarpdf_problema($problema) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT m.id as id, tm.tipo as manutencao, l.nome as laboratorio, ma.nome as maquina,
            m.data as data, m.problema as problema, m.solucao as solucao, u.nome as usuario , t.turno as turno
            FROM manutencao m, tipomanutencao tm,usuario u, maquinas ma, laboratorio l,  turno t
            WHERE 
            m.TipoManutencao_id = tm.id and
            m.Laboratorio_id = l.id and
            m.Maquinas_mac = ma.mac and
            m.Usuario_id = u.id and
            m.Turno_id = t.id and 
            problema  like "%'.$problema.'%"';

        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }
    
    public function Carregarpdf() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT m.id as id, tm.tipo as manutencao, l.nome as laboratorio, ma.nome as maquina,
            m.data as data, m.problema as problema, m.solucao as solucao, u.nome as usuario , t.turno as turno
            FROM manutencao m, tipomanutencao tm,usuario u, maquinas ma, laboratorio l,  turno t
            WHERE 
            m.TipoManutencao_id = tm.id and
            m.Laboratorio_id = l.id and
            m.Maquinas_mac = ma.mac and
            m.Usuario_id = u.id and
            m.Turno_id = t.id';

        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

}

?>
