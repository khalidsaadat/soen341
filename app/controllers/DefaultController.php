<?php
class DefaultController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){

		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('default/index');
	}

	public function empty_view() {
		$this->view('BASE_STRUCTURES/empty_view');
	}

}