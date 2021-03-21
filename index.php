<?php 
    session_start();
    $msg = $_SESSION['msg']['error'] ?? null; 
    /*Operador ternário, se sessão isSet($msg=$_SESSION['msg']) senão $msg = null*/
    unset($_SESSION['msg']);

    //Remove o login se a pessoa quer voltar para a página de index.
    if($_SESSION['logado']){
        unset($_SESSION['logado']);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1"
                class="tab">Login</label>
            <input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">
                Cadastrar</label>

            <div class="login-form">
                <form action="verificar.php" method="POST">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="user" class="label">Email</label>
                            <input id="user" type="email" class="input" name="username">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Senha</label>
                            <input id="pass" type="password" class="input" data-type="password" name="password">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Entrar">
                        </div>
                        <?php if ($msg) : ?>
                        <div class="alert alert-danger" role="alert">
                            <p class="alert-link"><?= $msg ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>

                <form action="cadastro.php" method="POST">
                    <div class="for-pwd-htm">
                        <div class="group">
                            <label for="user" class="label">E-mail/Login</label>
                            <input id="user" type="email" class="input" name="login">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Senha</label>
                            <input id="pass" type="password" class="input" data-type="password" name="password">
                        </div>
                        <div class="group">
                            <div class="group">
                                <label for="pass" class="label">Confirme a senha</label>
                                <input id="pass" type="password" class="input" data-type="password" name="check">
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="Cadastrar">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="hr"></div>
            </div>
        </div>
    </div>
</body>

</html>