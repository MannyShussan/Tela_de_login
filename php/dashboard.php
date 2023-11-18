<?php
require_once "Classes/Chave.php";
require_once "Classes/Usuario.php";

$token = $_GET['token'] ?? 0;
$user = new Usuario($token);

$nome = $user->getStatus()['nome'];

if ($user->getStatus()['status']) {
    echo <<< PAG
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../style/dashboard.css">
    </head>

    <body>

        <header class="cabecalho">
            <h1 class="centralizado">TMR0</h1>
        </header>

        <aside class="menu-lateral-esquerda">
            <ul>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
                <li><a href="#">qualquer coisa aqui</a></li>
            </ul>
        </aside>
        <h2 class="titulo centralizado">$nome</h2>
        <div class="container-1">
            <h3 class="centralizado">Dipositivos</h3>
            <h4 class="centralizado">lista de Dipositivos</h4>
            <ul>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
            </ul>
        </div>
        <aside class="status menu-lateral-direita">
            <h3 class="centralizado">Status</h3>
            <p>temperatura</p>
            <p>umidade do ar</p>
            <p>previsão do tempo</p>
        </aside>
        <div class="container-2">
            <h3 class="centralizado">Consumo por dispositivos</h3>
            <ul>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
                <li>Interruptor</li>
            </ul>
        </div>
        <footer class="rodape">
            <p>&trade; TMR0</p>
        </footer>
    </body>

    </html>
    PAG;
} else {
    header("location: ../index.php");
}
