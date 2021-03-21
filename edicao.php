<?php
    require_once("src/UserDAO.php");

    session_start();

    $id = $_REQUEST['id'] ?? null;
    $email = $_REQUEST['email'] ?? null;
    $senha = $_REQUEST['senha'] ?? null;

    if($email && $email!="null"){
        UserDAO::atualizaEmail($id, $email);
        $_SESSION['msgAdmin']['success'] = "Dados atualizados com sucesso!";
    }else if($senha && $senha!="null"){
        UserDAO::atualizaSenha($id, $senha);
        $_SESSION['msgAdmin']['success'] = "Dados atualizados com sucesso!";
    }else{
        unset($_SESSION['msgAdmin']['seccess']);
        $_SESSION['msgAdmin']['error'] = "Os parâmetros foram vazios!";
    }
    header("Location:dashboard.php");
?>