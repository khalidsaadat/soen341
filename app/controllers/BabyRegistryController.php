<?php
class BabyRegistryController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){

		// if not logged in, go to the login page
		if(!isset($_SESSION['user_id'])) {

			$_SESSION['login_flag'] = 1;
			return header('location:/account/login');
		}

		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('baby_registry/index');
	}

	public function add() {


		// addresses
		$user_primary_address = $this->model('Address')->getPrimaryAddress($_SESSION['user_id']);
		$user_secondary_address = $this->model('Address')->getSecondaryAddress($_SESSION['user_id']);
           
		// if the create_Registry button is clicked 
		if(!isset($_POST['create_registry'])) {
			$this->view('baby_registry/add', ['primary_address'=>$user_primary_address, 'secondary_address'=>$user_secondary_address]);
		}
		else {
			$name = $_POST['title'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$organizer_name = $first_name . ' ' . $last_name;
			$email = $_POST['email'];
			$delivery_date = $_POST['date'];
			$address_id = 8; // default id until we fix it
			$description = $_POST['description'];
		

			$new_registry = $this->model('BabyRegistry'); // create registry model

			$new_registry->name = $name;
			$new_registry->email = $email;
			$new_registry->delivery_date = $delivery_date;
			$new_registry->organizer_name = $organizer_name;
			$new_registry->address_id = $address_id;
			$new_registry->description = $description;
		
			$new_registry->insert();

			$this->view('baby_registry/add');
		}
	    

	}

}