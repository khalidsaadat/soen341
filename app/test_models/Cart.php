<?php
    namespace App;

    class Cart {
        public float $price;
        public static float $tax = 1.2;

        public function getNetPrice() {
            return $this->price * self::$tax;
        }
    }
?>