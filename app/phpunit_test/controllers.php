<?php
declare(strict_types=1);

    class ProductTest extends TestCase
    {
        public function testIncreaseQuantityInProduct(): void
        {
            //Given
            $chocolate = new Product("Chocolate", 2);

            //When
            $chocolate->increaseQuantity(2);

            //Then
            self::assertSame(4, $chocolate->getQuantity());
        }
    }
?>