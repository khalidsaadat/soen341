<?php
class BabyRegistryController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){

		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('baby_registry/index');
	}

	public function add() {
		$this->view('BASE_STRUCTURES/empty_view');
	}

}