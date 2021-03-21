<?php
require_once "src/User.php";
require_once "src/UserDAO.php";

session_start();

$u = new User();
$results = UserDAO::buscaDados();

$login = $_REQUEST['login'];
$password = $_REQUEST['password'];
$check = $_REQUEST['check'];
$valido = false;

/* Verifica se há campos vazios */
if (!$login || !$password || !$check) {
    $_SESSION['msg']['error'] = "Preencha todos os campos e tente novamente.";
} else {
    /* Verifica compatibilidade das senhas */
    if ($check == $password) {
        $valido = true;
        /*Verifica duplicidade de nomes*/
        for ($i = 0; $i < sizeof($results); $i++) {
            if ($results[$i]['email'] == $login) {
                $valido = false;
                break;
            }
        }
        if ($valido) {
            /*Registra usuário*/
            $u->setEmail($login);
            $u->setPassword($password);

            UserDAO::cadastraUsuarios($u);
            $_SESSION['logado'] = $login;
        } else {
            $_SESSION['msg']['error'] = "Este nome de usuário já está cadastrado, tente outro!";
        }
    } else {
        $_SESSION['msg']['error'] = "As senhas não são compatíveis! Tente novamente!";
    }
}
/* Se email é válido usuário foi cadastrado e vai direto para dashboard */
if($valido){
    header('Location: dashboard.php');
}else{
    header('Location: index.php');
}
