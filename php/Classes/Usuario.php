<?php
require_once "BD.php";
class Usuario extends BD
{
    protected $nome;
    protected  $id;
    protected  $token;
    protected  $status;
    protected $logado;
    public function __construct($token)
    {
        parent::__construct();
        $this->token = $token;
        $this->setStatus($this->validarToken($token));
    }
    private function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    private function setName($name)
    {
        $this->nome = $name;
    }
    public function getName()
    {
        return $this->nome;
    }
    private function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getLogado()
    {
        return $this->logado;
    }
    // Metodos
    public function validarToken($token)
    {
        $token = explode('.', $token);
        $validarAssinatura = base64_encode(hash_hmac('sha256', "$token[0].$token[1]", chave(), true));
        $horaAtual = time();
        $validade = json_decode(base64_decode($token[1]));
        $id = $validade->ID;
        $validade = $validade->exp;
        $this->setId($id);
        if (($validarAssinatura == $token[2]) && ($validade >= $horaAtual)) {
            return $this->user();
        }else{
            return array('status' => false);
        }
    }
    public function user()
    {
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        if ($conn->connect_error) {
            die("Falha na conexão com o Bando de dados: " . $conn->connect_error);
        }
        $result = $conn->query("SELECT * FROM users WHERE ID = " . $this->id);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['senha'] = '';
            $this->setName($row["nome"]);
            $row['status'] = true;
            return $row;
        } else {
            return array('status' => false);
        }
    }
}
