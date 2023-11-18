<?php
require_once "BD.php";
require_once "Chave.php";
class Sessao extends BD
{
    protected $serverName, $userName, $password, $dbName, $senhaSegura, $connection, $duracao, $identificador;

    public function __construct()
    {
        parent::__construct();
    }
    private function getServerName()
    {
        return $this->serverName;
    }
    private function getUserName()
    {
        return $this->userName;
    }
    private function getPassword()
    {
        return $this->password;
    }
    private function getDbName()
    {
        return $this->dbName;
    }
    private function getSenhaSegura()
    {
        return $this->senhaSegura;
    }
    private function setSenhaSegura($senha)
    {
        $this->senhaSegura = $senha;
    }
    private function setConnection($connection)
    {
        $this->connection = $connection;
    }
    public function iniciarSessao($user, $pass)
    {
        $result = $this->logar($user, $pass);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($this->verificaSenha($pass, $row["senha"])) {
                // Se conseguiu logar <-
                $this->identificador = $row["ID"];
                $token = $this->geratoken($this->identificador);
                $this->salvaToken($token);
                header("location: ../php/dashboard.php?token=$token");
            } else {
                header("location: ../index.php");
            }
        } else {
            header("location: ../index.php");
        }
    }
    private function verificaSenha($senhaUsuario, $senhaBd)
    {
        return password_verify($senhaUsuario, $senhaBd);
    }
    private function logar($us, $se)
    {
        $this->setSenhaSegura(password_hash($se, PASSWORD_DEFAULT));
        $this->login();
        return $this->getSearchSQL("SELECT * FROM users WHERE email = '$us'");
    }
    private function getSearchSQL($query)
    {
        $sql = "$query";
        $result = $this->connection->query($sql);
        $this->connection->close();
        return $result;
    }
    private function geraToken($id)
    {
        $cabeca = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $this->duracao = time() + (60 * 60);
        $payLoad = base64_encode(json_encode(['exp' => $this->duracao, 'ID' => "$id"]));
        $assinatura = base64_encode(hash_hmac('sha256', "$cabeca.$payLoad", chave(), true));
        return ("$cabeca.$payLoad.$assinatura");
    }
    private function salvaToken($data)
    {
        $this->setTokenSQL($data);
    }
    private function login()
    {
        $this->connection = new mysqli($this->getServerName(), $this->getUserName(), $this->getPassword(), $this->getDbName());
        if ($this->connection->connect_error) {
            die("falha na conexão com o banco de dados: " . $this->connection->connect_error);
        }
    }
    private function setTokenSQL($token)
    {
        $this->login();
        $horaAtual = date("Y-m-d H:i:s");
        $horaVencimento = date("Y-m-d H:i:s", $this->duracao);
        $sql = "UPDATE users SET gerado = '$horaAtual', vencimento = '$horaVencimento', token = '$token' WHERE id = $this->identificador";
        $result = $this->connection->query($sql);
        $this->connection->close();
        return $result;
    }
}
