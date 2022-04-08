<?php 
    use App\Cart;
    use PHPUnit\Framework\TestCase;
    

    class CartTest extends TestCase {
        // public function testCorrectNetPrice() {

        //     $cart = new Cart();
        //     $cart->price = 10;
        //     $netPrice = $cart->getNetPrice();

        //     $this->assertEquals(12, $netPrice);
        // }

        private function mockData() {
            $mockRepoBabyReg = $this->createMock(\App\Cart::class);
            $mockRepoRegular = $this->createMock(\App\Cart::class);

            // mock data for baby registry products in the cart
            $mockBabyRegCartArray = [
                ['cart_id' => 2, 'product_id' => 27, 'color' => 'Black', 'size' => 'S', 'quantity' => '1', 'user_id' => '18', 'price' => '23.99', 'baby_reg_flag' => '1', 'baby_reg_id' => '4', 'status' => '0'],
                ['cart_id' => 3, 'product_id' => 27, 'color' => 'Black', 'size' => 'S', 'quantity' => '1', 'user_id' => '19', 'price' => '23.99', 'baby_reg_flag' => '1', 'baby_reg_id' => '4', 'status' => '0'],
            ];

            // mock data for regular (non baby registry) products in the cart
            $mockRegularCartArray = [
                ['cart_id' => 1, 'product_id' => 19, 'color' => 'Green', 'size' => 'M', 'quantity' => '3', 'user_id' => '18', 'price' => '123.99', 'baby_reg_flag' => '0', 'baby_reg_id' => 'NULL', 'status' => '0'],
                ['cart_id' => 4, 'product_id' => 37, 'color' => 'Blue', 'size' => 'L', 'quantity' => '1', 'user_id' => '18', 'price' => '55.99', 'baby_reg_flag' => '0', 'baby_reg_id' => 'NULL', 'status' => '0'],
                ['cart_id' => 5, 'product_id' => 20, 'color' => 'Yellow', 'size' => 'S', 'quantity' => '4', 'user_id' => '19', 'price' => '155.99', 'baby_reg_flag' => '0', 'baby_reg_id' => 'NULL', 'status' => '0'],
            ];

            $mockRepoBabyReg->method('fetchBabyRegisteries')->willReturn($mockBabyRegCartArray);
            $mockRepoRegular->method('fetchRegularProducts')->willReturn($mockRegularCartArray);

            $baby_registeries = $mockRepoBabyReg->fetchBabyRegisteries();
            $regular_products = $mockRepoRegular->fetchRegularProducts();

            // Test data
            $correct_baby_registry = $mockBabyRegCartArray[0];
            $incorrect_baby_registry = $mockRegularCartArray[0];
            
            $correct_regular_product = $mockRegularCartArray[0];
            $incorrect_regular_product = $mockBabyRegCartArray[0];

            return ['baby_registeries'=>$baby_registeries,
                    'regular_products'=>$regular_products,
                    'correct_baby_registry'=>$correct_baby_registry,
                    'incorrect_baby_registry'=>$incorrect_baby_registry,
                    'correct_regular_product'=>$correct_regular_product,
                    'incorrect_regular_product'=>$incorrect_regular_product,];
        }

        public function testCorrectBabyReg() {
            $mockData = $this->mockData();

            $baby_registeries = $mockData['baby_registeries'];

            $correct_baby_reg = $mockData['correct_baby_registry'];

            // check if the item in the cart belongs to a baby registry
            $this->assertContains($correct_baby_reg, $baby_registeries, 'Item in the cart is not a baby registry');
        }

        public function testIncorrectBabyReg() {
            $mockData = $this->mockData();

            $baby_registeries = $mockData['baby_registeries'];

            $incorrect_baby_reg = $mockData['incorrect_baby_registry'];

            // check if the item in the cart belongs to a baby registry
            $this->assertContains($incorrect_baby_reg, $baby_registeries, 'Item in the cart is not a baby registry');
        }

        public function testCorrectRegularProduct() {
            $mockData = $this->mockData();

            $regular_products = $mockData['regular_products'];

            $correct_regular_product = $mockData['correct_regular_product'];

            $this->assertContains($correct_regular_product, $regular_products, 'Item in the cart is not a regular product');

        }

        public function testIncorrectRegularProduct() {
            $mockData = $this->mockData();

            $regular_products = $mockData['regular_products'];

            $incorrect_regular_product = $mockData['incorrect_regular_product'];

            $this->assertContains($incorrect_regular_product, $regular_products, 'Item in the cart is not a regular product');

        }
    }
?>