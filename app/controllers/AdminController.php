<?php
class AdminController extends Controller{

	public function index(){
		// get list of all products from the db
		$products = $this->model('Product')->getAll();
		$promotions = $this->model('Product')->getAllPromotions();

		$this->view('admin/index', ['products'=>$products, 'promotions'=>$promotions]);
	}

}