<?php
require_once("Classes/Sessao.php");

$usuario = $_POST['username'] ?? '';
$senha = $_POST['password'] ?? '';

$conexao = new Sessao();
$conexao->iniciarSessao($usuario, $senha);