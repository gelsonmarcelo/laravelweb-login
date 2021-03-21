<?php
require_once "src/UserDAO.php";
require_once "src/User.php";

session_start();
$results = UserDAO::buscaDados();

$user = $_SESSION['user'] ?? null;
$msgError = $_SESSION['msgAdmin']['error'] ?? null;
unset($_SESSION['msgAdmin']['error']);
$msgSuccess = $_SESSION['msgAdmin']['success'] ?? null;
unset($_SESSION['msgAdmin']['success']);

if (!$user) {
    $_SESSION['msg']['error'] = "É necessário logar para efetuar essa ação.";
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
</head>

<body class="dashboard">

    <?php     
        if($msgError){
            echo '<div class="alert alert-warning" role="alert">';
                echo $msgError;
        }else if($msgSuccess){
            echo '<div class="alert alert-success" role="alert">';
                echo $msgSuccess;
        }
        echo '</div>';
    ?>

    <script>
    function recebeEmail() {
        var email = prompt("Digite o novo e-mail:");
        return email;
    }
    function recebeSenha() {
        var senha = prompt("Digite a nova senha:");
        return senha;
    }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Image and text -->
                <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="#">
                        <img src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" width="30"
                            height="30" class="d-inline-block align-top" alt="">
                        Projeto Login
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link" href="#">Features</a>
                            <a class="nav-item nav-link" href="#">Pricing</a>
                            <a class="nav-item nav-link disabled" href="#" tabindex="-1"
                                aria-disabled="true">Disabled</a>
                            <a class="nav-item nav-link" href="sair.php">Sair</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-2">
                <h3>Navegação</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                <h3>Dashboard</h3>
                <hr />

                <h4>Lista de Usuários</h4>

                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>E-mail</th>
                        <?php
                        //Percorre a matriz com os dados para imprimir o ID e email
                        for ($i = 0; $i < sizeof($results); $i++) {
                            //Encontrou o usuário da sessão
                            if ($user == $results[$i]['email']) {
                                //Verifica qual tipo de usuário é : se admin
                                if ($results[$i]['roles_id'] == '2') {
                                        echo '<th class="acoes">Ações</th>';
                                    echo '</tr>';
                                    for ($j=0; $j<sizeof($results); $j++) { 
                                        echo '<tr>';
                                            echo '<td>';
                                                echo $results[$j]['id'];
                                            echo '</td>';
                                            echo '<td>';
                                                echo $results[$j]['email'];                                                
                                            echo '</td>';
                                            echo '<td class="ex">';                                                
                                                echo '<a href="#" class="btn btn-primary" onclick="window.location =\'edicao.php?id=' . $results[$j]['id'] . '&email=\' + recebeEmail()">Editar e-mail</a>';
                                                echo '<a href="#" class="btn btn-primary" onclick="window.location =\'edicao.php?id=' . $results[$j]['id'] . '&senha=\' + recebeSenha()">Editar senha</a>';
                                                echo '<a href="exclusao.php?id=' . $results[$j]['id'] . '" class="btn btn-danger" onClick="return confirm(\'Você realmente deseja excluir esse usuário?\')">Excluir</a>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    break;
                                } else { 
                                    //usuário comum
                                    echo '</tr>';
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $results[$i]['id'];
                                        echo "</td>";

                                        echo "<td>";
                                            echo $results[$i]['email'];
                                        echo "</td>";

                                    echo "</tr>";
                                    break;
                                }
                            }
                        }

                    ?>
                </table>

            </div>
        </div>
    </div>

</body>

</html>