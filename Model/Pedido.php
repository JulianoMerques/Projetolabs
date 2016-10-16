<?php

class Pedido {

    private $id;
    private $TipoManutencao_id;
    private $Laboratorio_id;
    private $Maquinas;
    private $Problema;
    private $data;
    private $Hora;
    private $Situacao;
    private $usuario_id;
    private $sobrenome;

    function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTipoManutencao_id() {
        return $this->TipoManutencao_id;
    }

    public function setTipoManutencao_id($TipoManutencao_id) {
        $this->TipoManutencao_id = $TipoManutencao_id;
    }

    public function getLaboratorio_id() {
        return $this->Laboratorio_id;
    }

    public function setLaboratorio_id($Laboratorio_id) {
        $this->Laboratorio_id = $Laboratorio_id;
    }

    public function getMaquinas() {
        return $this->Maquinas;
    }

    public function setMaquinas($Maquinas) {
        $this->Maquinas = $Maquinas;
    }

    public function getProblema() {
        return $this->Problema;
    }

    public function setProblema($Problema) {
        $this->Problema = $Problema;
    }

    public function getSituacao() {
        return $this->Situacao;
    }

    public function setSituacao($Situacao) {
        $this->Situacao = $Situacao;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getHora() {
        return $this->Hora;
    }

    public function setHora($Hora) {
        $this->Hora = $Hora;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function Inserir() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
$data = $this->data;
        
        $sql = 'INSERT INTO `pedido`
            (`id`, `Usuario_id`,Sobrenome, `TipoManutencao_id`, `Laboratorio_id`, `Maquinas`, `Problema`,Data,Hora, `Situacao`) 
            VALUES ("",' . $this->usuario_id . ',
                            "' . $this->sobrenome . '",
                                ' . $this->TipoManutencao_id . ',
                                    ' . $this->Laboratorio_id . ',
                                        "' . $this->Maquinas . '",
                                            "' . $this->Problema . '",
                                                "' . $this->data. '",
                                                    "' . $this->Hora . '",
                                                        0)';
        print_r($sql);
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function CarregarCheckBox_Maquina($Laboratorio) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM `maquinas` WHERE  `Laboratorio_id1` =' . $Laboratorio;
        $resultado = $conexao->Consultar($sql);
        if ($conexao->total > 0) {
            $s = $conexao->Consultar('SELECT COUNT( mac )as soma FROM `maquinas`WHERE `Laboratorio_id1` =' . $Laboratorio);
            while ($linha = mysql_fetch_array($s)) {
                $b = $linha['soma'];
            }
            $c = $b - 1;
            while ($linha = mysql_fetch_array($resultado)) {
                echo '<input type="checkbox" name="Pedido[]" id="Pedido" value="' . $linha['nome'] . '"/>' . $linha['nome'] . '';
                for ($i = 0; $i <= $c; $i++) {
                    if ($i < $c) {
                        echo ',';
                        break;
                    } else {
                        echo '.';
                        break;
                    }
                }
            }
        } else {
            echo'Nenhuma Maquina Cadastrada';
        }
        $conexao->Desconecta();
    }

    public function Carregar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        if ($this->id > 0) {
            $sql = 'SELECT p.id as id, u.nome as usuario,
            p.Situacao as Situacao, tm.tipo as manutencao,
            p.maquinas as maquinas, p.data as data, p.problema as problema
            FROM pedido p, usuario u, laboratorio l, tipomanutencao tm
            where
            p.Usuario_id = u.id and
            p.Laboratorio_id = l.id and
            p.TipoManutencao_id = tm.id and
            u.id = ' . $this->id;
        } else {
            $sql = 'SELECT p.id as id, u.nome as usuario,
            p.Situacao as Situacao, tm.tipo as manutencao,
            p.maquinas as maquinas, p.data as data, p.problema as problema
            FROM pedido p, usuario u, laboratorio l, tipomanutencao tm
            where
            p.Usuario_id = u.id and
            p.Laboratorio_id = l.id and
            p.TipoManutencao_id = tm.id ';
        }
        $resultado = $conexao->Consultar($sql);


        $html = '<table class="paginar display Tabela" summary="Tabela contendo Pedidos."   >';
        $html .= '<caption><img src="../Resources/Img/Não verificado.png" width="30px"> Não verificado  ---->  
                           <img src="../Resources/Img/Verificando.png" width="30px"> Verificado  ---->  
                           <img src="../Resources/Img/Verificado.png" width="30px"> Executado 
                  </caption>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th id="id">ID </th>';
        $html .= '<th id="descricao">Descrição</th>';
        $html .= '<th id="status">Status </th>';
        $html .= '<th id="data">Data</th>';
        $html .= '<th id="imprimr"></th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        while ($linha = mysql_fetch_array($resultado)) {

            $html .='<tr>';
            $html .='<td headers="id" id="id">' . utf8_encode($linha['id']) . '</td>';
            $html .='<td headers="descricao" id="descricao">' . utf8_encode($linha['problema']) . '</td>';

            $html .='<td headers="status"  id="status">';
            if ($linha['Situacao'] == 0) {
                $img0 = 'Não verificado';
                $img1 = 'oculto';
                $img2 = 'oculto';
            } else if ($linha['Situacao'] == 1) {
                $img0 = 'oculto';
                $img1 = 'Verificando';
                $img2 = 'oculto';
            } else {
                $img0 = 'oculto';
                $img1 = 'oculto';
                $img2 = 'Verificado';
            }

            $html .='<a href="../View/VerPedido.php?id=' . $linha['id'] . '&&situacao=' . $linha['Situacao'] . '"
                rel="shadowbox" title="Pedido Manutenção" >
                          <img src="../Resources/Img/' . $img0 . '.png" width="30px"> &nbsp;
                          <img src="../Resources/Img/' . $img1 . '.png" width="30px"> &nbsp;
                          <img src="../Resources/Img/' . $img2 . '.png" width="30px"> &nbsp;
               </a> </td>';
               $html .='<td headers="data" id="data">' . utf8_encode($conexao->ConveteDataBrasil($linha['data'])) . '</td>';
               $html .='<td headers="imprimr" id="imprimr"><a href="../View/VerPedido.php?imprimir=1&&id='.$linha['id'].'" rel="shadowbox" title="Pedido"><img src="../Resources/Img/impressora.png" width="30px"></a></td>';

            $html .='</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        echo $html;
    }

    public function CarregarPorID() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT p.id AS id, u.nome AS usuario, p.Situacao AS Situacao,
                    tm.tipo AS manutencao, p.maquinas AS maquinas, p.data AS data,
                    p.Problema AS problema, p.Hora AS Hora,l.nome as laboratorio,p.Sobrenome as Sobrenome
                FROM pedido p, usuario u, laboratorio l, tipomanutencao tm
                WHERE p.Usuario_id = u.id
                AND p.Laboratorio_id = l.id
                AND p.TipoManutencao_id = tm.id
                AND p.id =' . $this->id;

        $resultado = $conexao->Consultar($sql);
        while ($linha = mysql_fetch_array($resultado)) {
            $this->id = $linha['id'];
            $this->usuario_id = $linha['usuario'];
            $this->sobrenome = $linha['Sobrenome'];
            $this->TipoManutencao_id = utf8_encode($linha['manutencao']);
            $this->Laboratorio_id = utf8_encode($linha['laboratorio']);
            $this->Maquinas = $linha['maquinas'];
            $this->Problema = $linha['problema'];
            $this->data = $linha['data'];
            $this->Hora = $linha['Hora'];
        }
        $conexao->Desconecta();
    }

    public function EditarSit() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'UPDATE `pedido` SET `Situacao`=' . $this->Situacao . ' WHERE id=' . $this->id;

        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

}
?>
