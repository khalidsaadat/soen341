<?php
class ShopController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){

		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('shop/index');
	}

    public function product($product_id) {
        $this->view('shop/product_detail');
    }

	public function cart() {

	}

	public function checkout() {
		
	}

}