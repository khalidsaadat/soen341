<?php
// For admin dashboard
class ProductController extends Controller{

	public function index(){

		// redirect to admin dashboard page
		return header('location:/admin/');
	}

    public function add_product() {
        $this->view('product/add_product');
    }

    public function edit_product($product_id) {

    }



}