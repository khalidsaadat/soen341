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

			$proceed_flag = 0;

			// check if there is a user with the same email address; if so, give error and terminate.
			$existed_user = $this->model('User')->findByUsername($email);

			if($existed_user == true) {
				$proceed_flag = 0;
				$this->view('account/signup', ['error'=>'Account already exists with this email address!']);
			}
			else {
				if($password == $confirm_password) { // proceed only if the password matches confirm password
					$new_user = $this->model('User'); // create user model
					// store user info in the db
					$new_user->username = $email;
					$new_user->password = password_hash($password, PASSWORD_DEFAULT);

					$proceed_flag = 1;

					// if the user entered the super code, verify it with the db
					if(!empty($_POST['super_code'])) {
						$entered_super_code = $_POST['super_code'];

						// check db if the entered super code matches one of the codes in the db; or if the super code is not used by another user
						$checked_super_code = $this->model('SuperCode')->findBySuperCode($entered_super_code);

						// proceed only if the super code matches the ones in the db
						if($checked_super_code == false) { // super code does not match with the ones in the db
							$proceed_flag = 0;
							$this->view('account/signup', ['error'=>'Wrong super code!']);
						}
						elseif($checked_super_code->status == 1) {
							$proceed_flag = 0;
							$this->view('account/signup', ['error'=>'Super code authentication failed!']);
						}
						else {
							$proceed_flag = 1;
							$new_user->role = 'admin';

							// change that super code's status to used (1) in the db
							$checked_super_code->status = 1;
							$checked_super_code->updateStatus();
						}
					}
					else {
						$new_user->role = 'user';
					}
					
					

					if($proceed_flag == 1) {
						
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


					
				}
				else {
					$this->view('account/signup', ['error'=>'Passwords do not match!']);
				}
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