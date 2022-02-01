<?php
class AccountController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){

		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('account/index');
	}

	public function signup() {

		// if the signup button is clicked 
		if(!isset($_POST['signup'])) {
			$this->view('account/signup');
		}
		else {
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$phone_number = $_POST['phone_number'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];

			// check if there is a user with the same email address; if so, give error and terminate.
			$existed_user = $this->model('User')->findByUsername($email);

			if(isset($existed_user)) {
				$this->view('account/signup', ['error'=>'Account already exists with this email address!']);
			}
			elseif($password == $confirm_password) { // proceed only if the password matches confirm password
				$new_user = $this->model('User'); // create user model
				// store user info in the db
				$new_user->username = $email;
				$new_user->password = password_hash($password, PASSWORD_DEFAULT);
				// save new user's info into user table
				$new_user->insert();

				$inserted_user_id = '';
				if(isset($_SESSION['lastInsertId_UserId'])) {
					$inserted_user_id = $_SESSION['lastInsertId_UserId'];
				}

				$new_profile = $this->model('Profile'); // create profile model
				// store user profile info in the db
				$new_profile->user_id = $inserted_user_id;
				$new_profile->full_name = $first_name . ' ' . $last_name;
				$new_profile->email = $email;
				$new_profile->phone_number = $phone_number;
				// save new user profile's info into profile table
				$new_profile->insert();

				// // successfull redirect to user account page
				header('location:/');



			}
			else {
				$this->view('account/signup', ['error'=>'Passwords do not match!']);
			}
			
		}
		
	}

	public function login() {

		// if the login button is not clicked
		if(!isset($_POST['login'])) {
			$this->view('account/login');
		}
		else {
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			// // check if the user exists in the db
			$user = $this->model('User')->findByUsername($email);
			
			if($user == false) {
				$this->view('account/login', ['error'=>'Account does not exist with this email!']);
			}
		}
	}

}