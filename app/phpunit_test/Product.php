<?php
    Class Product {
        private String $name;
        private String $quantity;

        public function __construct(string $name, int $quantity)
        {
            if($quantity < 0) {
                echo "error";
            }
            $this->name = $name;
            $this->quantity = $quantity;
        }

        public function increaseQuantity(int $quantity): void
        {
            if($quantity < 0) {
               echo "Error";
            }
            $this->quantity += $quantity;
        }

        public function getQuantity(): int
        {
            return $this->quantity;
        }
    }
?>