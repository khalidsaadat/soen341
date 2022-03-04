<?php
// For normal user 
class ShopController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){
    
		// get the products' basic information
		$products_basic_info = $this->model('Product')->getAllBasicInfo();
		$products = $this->model('Product')->getAllActive();

		// add to cart
		if(isset($_POST['add_to_cart'])) {
			$product_quantity = 1;
			$product_id = $_POST['product_id'];
			$product_user_id = $_SESSION['user_id'];

			$select_cart = $this->model('Cart')->findByProductId($product_id);
			// if it is false, add the product to the cart
			if(!$select_cart) {
				$new_product = $this->model('Cart');
				$new_product->product_id = $product_id;
				$new_product->quantity = $product_quantity;
				$new_product->user_id = $product_user_id;

				$new_product->insert();

				echo 'added to the cart';
			}
			else {
				// the product is already in the cart
				echo 'the product already exists';
			}

			
		}
    
		$this->view('shop/index', ['products'=>$products, 'products_basic_info'=>$products_basic_info]);

	}

    public function product($product_id) {
        $this->view('shop/product_detail');
    }

	public function cart() {

	}

	public function checkout() {
		$this->view('shop/checkout');
	}

}