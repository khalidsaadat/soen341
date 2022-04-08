<?php
    namespace App;

    class Payment {
        public static string $cc_number;
        public static string $type;

        protected function getPdo(): \PDO {
            if ($this->pdo === null) {
                $options = [
                     \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                     \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ];
                try {
                     $this->pdo = new \PDO("mysql:host=localhots; dbname=soen341; charset=utf8mb4", 'root', '', $options);
                  } catch (\PDOException $PDOException) {
                     throw new \PDOException($PDOException->getMessage(), (int) $PDOException->getCode());
                }
            }
            return $this->pdo;
        }
    }
?>