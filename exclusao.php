<?php
    require_once "src/UserDAO.php";

    $id = $_REQUEST['id'];

    UserDAO::deletaUsuario($id);

    header("Location:dashboard.php");
?>