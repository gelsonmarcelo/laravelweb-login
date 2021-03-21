<?php
    require_once("src/User.php");
    require_once("src/UserDAO.php");

    session_start();

    $u = new User();
    $u->setEmail($_REQUEST['username']);
    $u->setPassword($_REQUEST['password']);
    
    $exist = UserDAO::verificaCredenciais($u);

    if ($exist) {
        $_SESSION['user'] = $u->getEmail();
        header("Location: dashboard.php");
    } else {
        $_SESSION['msg']['error'] = "As credenciais estão incorretas, tente novamente.";
        header("Location: index.php");
    }

?>