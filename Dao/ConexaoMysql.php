<?php

class ConexaoMysql {

    protected $link;
    protected $server = 'localhost'; //Endereço do servidor
    protected $usuario = 'root'; //Usuario que acessa o banco
    protected $senha = ''; //Senha do usuário
    protected $baseDados = 'projetolabs'; //Nome da base de dados

    /** Informa o TOTAL de qualquer registro afetado
      (SELECT, INSERT, UPDATE, DELETE) na base. */
    public $total = 0;

    /** Informa o ultimo id do registro inserido
      na base de dados */
    public $lastInsertId = 0; //Retorna a chave primária do registro

    /** Construtor */

    public function ConexaoMysql() {
        
    }

    public function ConveteDataBanco($data) {
        $data = explode('/', $data);
        return ''.$data[2] . '-' . $data[1] . '-' . $data[0];
    }

    public function ConveteDataBrasil($data) {
        $data = explode('-', $data);
        return ''.$data[2] . '/' . $data[1] . '/' . $data[0];
    }

    /** Conectar com banco de dados */
    public function Conecta() {

        @$this->link = mysql_connect($this->server, $this->usuario, $this->senha);
        //Verifica se N�O(!) conseguiu conectar
        if (!$this->link) {
            die("Problema na conexao com banco de dados");
        }
        //Tenta selecionar a base de dados. Caso n�o consiga mostra a mensagem
        else if (!mysql_select_db($this->baseDados, $this->link)) {
            die("Problema em selecionar banco de dados");
        }
        //else
        //echo 'Conexao e selecao da base efetuada com sucesso :D';
    }

    /** Realiza as consultas (SELECT) */
    public function Consultar($sql) {

        try {
            //Receber o parametro $sql e realizar a consulta
            if ($resultado = mysql_query($sql) or die("Erro: " . $sql)) {
                //Atualizar o contador informando o n�mero de registros retornados na consulta
                $this->total = mysql_num_rows($resultado);
                return $resultado;
            } else {
                $this->total = 0;
                return null;
            }
        } catch (Exception $exc) {
            //Desconectar....
            Desconecta();
        }
    }

    /** Realiza INSERT, UPDATE e DELETE */
    public function Executar($sql) {
        try {
            //Realiza a query(INSERT, UPDATE e DELETE)
            if ($resultado = mysql_query($sql) or die("Erro no comando SQL.")) {
                //Atualiza o contador com os registos afetados
                $this->total = mysql_affected_rows();
               
                $this->lastInsertId = mysql_insert_id($this->link);
                 return "Operacao efetuada com sucesso (Registro(s) afetado(s): $this->total)";
            } else {
                //Nenhum registro foi afetado a partir da consulta enviada.
                $this->total = 0;
                return "Nenhum registro foi afetado.";
            }
        } catch (Exception $exc) {
            //Em caso de erro desconecta
            $this->Desconecta();
        }
    }

    /** Fecha a conexao */
    public function Desconecta() {
        return mysql_close($this->link);
    }

}

?>