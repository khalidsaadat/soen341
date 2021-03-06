<?php
    namespace App;

    class Cart {
        public float $price;
        public static float $tax = 1.2;

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

        public function getNetPrice() {
            return $this->price * self::$tax;
        }

        public function fetchBabyRegisteries(): array {
            dd("this is inside fetchusers method");
            
            return $this->getPdo()->prepare("SELECT * FROM cart where baby_reg_flag = 1 AND status = 0")->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function fetchRegularProducts(): array {
            dd("this is inside fetchusers method");
            
            return $this->getPdo()->prepare("SELECT * FROM cart where baby_reg_flag = 0 AND status = 0")->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>