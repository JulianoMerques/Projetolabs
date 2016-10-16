<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Juliano
 */
class Usuario {

    private $id;
    private $nome;
    private $sobrenome;
    private $turno;
    private $tipousuario;
    private $email;
    private $tel;
    private $login;
    private $senha;

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

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
    }

    public function getTipousuario() {
        return $this->tipousuario;
    }

    public function setTipousuario($tipousuario) {
        $this->tipousuario = $tipousuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function Inserir() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'INSERT INTO `usuario`(`id`, `nome`, `sobrenome`, `Turno_id`, `TipoUsuario_id`, `email`, `telefone`,login, `senha`) VALUES
                ("", "' . strtolower($this->nome) . '",
                     "' . strtolower($this->sobrenome) . '",
                        ' . $this->turno . ',
                        ' . $this->tipousuario . ',
                            "' . strtolower($this->email) . '",
                                "' . $this->tel . '",
                                "' . $this->login . '",
                                    "' . md5($this->senha) . '"
                        )';
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function Alterar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'UPDATE `usuario` SET 
                `nome`="' . $this->nome . '",
                    `sobrenome`="' . $this->sobrenome . '",
                         `Turno_id`=' . $this->turno . ',
                            `TipoUsuario_id`=' . $this->tipousuario . ',
                                `email`="' . $this->email . '",
                                    `telefone`="' . $this->tel . '",
                                        `login`="' . $this->login . '",
                                            `senha`="' . $this->senha . '"
                                                 WHERE id= ' . $this->id;

        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function Deletar() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'DELETE FROM `usuario` WHERE id=' . $this->id;
        $conexao->Executar($sql);
        $conexao->Desconecta();
    }

    public function CarregarPorID() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM usuario WHERE id=' . $this->id . '';

        $resultado = $conexao->Consultar($sql);
        while ($linha = mysql_fetch_array($resultado)) {

            $this->nome = $linha['nome'];
            $this->sobrenome = $linha['sobrenome'];
            $this->turno = $linha['Turno_id'];
            $this->tipousuario = $linha['TipoUsuario_id'];
            $this->email = $linha['email'];
            $this->tel = $linha['telefone'];
            $this->login = $linha['login'];
            $this->senha = $linha['senha'];
        }
        $conexao->Desconecta();
    }

    public function CarregarTipoUsuario() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();

        $conexao->Conecta();

        $sql = 'SELECT * FROM `tipousuario`';

        $resultado = $conexao->Consultar($sql);
        while ($row = mysql_fetch_array($resultado)) {
            echo '<option value="' . $row['id'] . '">' . utf8_encode($row['tipo']) . '</option>';
        }
        $conexao->Desconecta();
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

    public function CarregarTabela() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT u.id as id, u.nome as nome, u.sobrenome as sobrenome, t.turno as turno,
            u.email as email, u.telefone as telefone FROM usuario u, turno t WHERE 
            u.Turno_id = t.id
            ';

        $resultado = $conexao->Consultar($sql);

        $html = '<table class="paginar display Tabela" summary="Tabela contendo Usuarios."   >';
        $html .= '<caption>Lista de Usuarios cadastrados</caption>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th id="nome">Nome </th>';
        $html .= '<th id="sobrenomes">Sobrenome</th>';
        $html .= '<th id="turnoss">Turno</th>';
        $html .= '<th id="email">E-mail</th>';
        $html .= '<th id="telefone">Telefone</th>';
        $html .= '<th id="operacoes">Operações </th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        while ($linha = mysql_fetch_array($resultado)) {

            $html .='<tr>';
            $html .='<td headers="nome">' . utf8_encode($linha['nome']) . '</td>';
            $html .='<td id="sobrenomes" headers="sobrenome">' .  utf8_encode($linha['sobrenome']) . '</td>';
            $html .='<td id="turnoss" headers="turno">' . utf8_encode($linha['turno']) . '</td>';
            $html .='<td id="email" headers="email">' . utf8_encode($linha['email']) . '</td>';
            $html .='<td id="telefone" headers="telefone">' . utf8_encode($linha['telefone']) . '</td>';


            $html .='<td id="operacoes" headers="operacoes">
                <a href="javascript:void(0)" class="lk_editar_usuario" title="Editar" rel="' . $linha['id'] . '" ><img src="../Resources/Img/Pencil.png" width="30px"></a> &nbsp;
                <a href="javascript:void(0)" class="lk_excluir_usuario" title="Excluir"  rel="' . $linha['id'] . '" ><img src="../Resources/Img/deletar.png" width="30px"></a>
                </td>';
            $html .='</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        echo $html;
    }

    public function Carregar_TipoUsuario_selecionado() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM tipousuario';
        return $conexao->Consultar($sql);
        $conexao->Desconecta();
    }

    public function Carregar_Turno_selecionado() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();
        $sql = 'SELECT * FROM `turno`';
        return $conexao->Consultar($sql);
        $conexao->Desconecta();
    }

    public function Carregarpdf($id) {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT u.nome as nome,u.sobrenome as sobrenome, t.turno as turno, tu.tipo as tipo,
            u.email as email,u.telefone as telefone
            FROM Usuario u, TipoUsuario tu, turno t
            WHERE 
            u.TipoUsuario_id = tu.id and
            u.Turno_id = t.id and
            TipoUsuario_id=' . $id;


        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

    public function Carregarpdf1() {
        require_once '../Dao/ConexaoMysql.php';
        $conexao = new ConexaoMysql();
        $conexao->Conecta();

        $sql = 'SELECT u.nome as nome,u.sobrenome as sobrenome, t.turno as turno, tu.tipo as tipo,
            u.email as email,u.telefone as telefone
            FROM Usuario u, TipoUsuario tu, turno t
            WHERE 
            u.TipoUsuario_id = tu.id and
            u.Turno_id = t.id';


        $resultado = $conexao->Consultar($sql);
        return $resultado;
    }

}

?>
