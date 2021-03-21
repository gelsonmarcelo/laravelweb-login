<?php

    class LoginDB {
        
        private static $host = 'localhost';
        private static $databaseName = 'login_db';
        private static $charset = 'utf8';
        private static $databaseUser = 'root';
        private static $databasePassword = 'root';
        private static $databaseInstance = null;

        public static function getConnection() {
            self::$databaseInstance = self::$databaseInstance ?? 
            new PDO("mysql:host=" . self::$host . 
                    ";dbname=" . self::$databaseName . 
                    ";charset=" . self::$charset, 
                    self::$databaseUser, self::$databasePassword);

            return self::$databaseInstance;
        }        
        
        /**
        * Esse método é responsável pela validação das credenciais do usuário.
        * @param User $userForm
        * @return boolean
        */
        public function verificarCredenciais($userForm) {
            foreach ($this->users as $user) {
                $user_exploded = explode(",", $user);
         
                $email = $user_exploded[0];
                $password = $user_exploded[1];
         

                 if ($userForm->getEmail() == $email && $userForm->getPassword() == $password) {
                   return true;
                 }
            }

            return false;
        }

    }

?>