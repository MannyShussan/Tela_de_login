<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/style.css">
    <!-- <script src="scritps/jquery-min.js"></script> -->
</head>

<body>
    <div class="container-formulario">
        <img src="assets/iot.jpg" alt="">
        <div class="container-login">
            <form action="php/confere_senha.php" method="post">
                <p class="paragrafo-customizado"><label for="user">Login:</label><br>
                <input type="email" name="username" id="user" placeholder="E-mail ID" class="nome-usuario" value="<?=""?>"></p>
                <p class="paragrafo-customizado"><label for="key">Senha:</label><br>
                <input type="password" name="password" id="key" placeholder="Password" class="email-usuario" value="<?=""?>"></p>
                <input type="submit" id="btn-login" value="LOGIN" class="botao-login" disabled>
            </form>

            <div class="container-rodape">
                <div class="custom-checkbox">
                    <input type="checkbox" name="remember" id="remember" class="lembrar-senha">
                    <label for="remember">Lembrar Senha</label>
                </div>
                <a href="reset-password.html">Esqueceu Senha?</a>
            </div>
        </div>
    </div>
    <script type="module" src="scritps/verificador.js"></script>
</body>

</html>