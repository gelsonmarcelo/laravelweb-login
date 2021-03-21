<?php

    require_once('User.php');
    require_once('LoginDB.php');

    class UserDAO {

        /**
        * Esse método é responsável pela validação das credenciais do usuário.
        * @param User $user
        * @return boolean
        */
        public static function verificaCredenciais($user) {
            $conn = LoginDB::getConnection();
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            $stmt->bindValue(':email',    $user->getEmail(),    PDO::PARAM_STR);
            $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        }

        /**
         * Cadastramento de usuários
         * @param User $user
         */
        public static function cadastraUsuarios($user) {
            $conn = LoginDB::getConnection();
            $stmt = $conn->prepare("INSERT INTO users VALUES (default, :email, :password, 1)");
            $stmt->bindValue(':email',    $user->getEmail(),    PDO::PARAM_STR);
            $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
            $stmt->execute();
        }

        /**
         * Busca dados do BD
         * @return $results
         */
        public static function buscaDados() {
            $conn = LoginDB::getConnection();
            $stmt = $conn->query('SELECT id, email, roles_id FROM users order by id;');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }

        /**
         * Exclui usuário passado pelo ID
         * @param id
         */
        public static function deletaUsuario(int $id) {
            $conn = LoginDB::getConnection();
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id;");
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }

        /**
         * Atualiza email do usuário passado pelo ID
         * @param id
         * @param email
         */
        public static function atualizaEmail(int $id, string $email){
            $conn = LoginDB::getConnection();
            $stmt = $conn->prepare("UPDATE users SET email = :email WHERE id = :id;");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }

        /**
         * Atualiza senha do usuário passado pelo ID
         * @param id
         * @param senha
         */
        public static function atualizaSenha(int $id, string $senha){
            $conn = LoginDB::getConnection();
            $stmt = $conn->prepare("UPDATE users SET password = :senha WHERE id = :id;");
            $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }
    }

?>