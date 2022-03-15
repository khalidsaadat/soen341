<?php
class AdminController extends Controller{

	public function index(){
		// only admin users are allowed to visit this page
		if($_SESSION['role'] != 'admin') {
			return header('location:/');
		}
		// get list of all products from the db
		$products = $this->model('Product')->getAll();
		$promotions = $this->model('Product')->getAllPromotions();
		$new_products = $this->model('Product')->getAllNewProducts();

		$this->view('admin/index', ['products'=>$products, 'promotions'=>$promotions, 'new_products'=>$new_products]);
	}

}