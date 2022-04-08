<?php
class AccountController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){
		// only admin users are allowed to visit this page
		if($_SESSION['role'] != 'user') {
			return header('location:/');
		}

		// user detail
		$user_profile = $this->model('Profile')->findByUserId($_SESSION['user_id']);
		$profile_id = $user_profile->profile_id;

		// address detail
		$primary_address = $this->model('Address')->getPrimaryAddress($_SESSION['user_id']);
		$secondary_address = $this->model('Address')->getSecondaryAddress($_SESSION['user_id']);

		// Orders
		$orders = $this->model('Order')->getAllByUserId($_SESSION['user_id']);

		// wishlist
		$wishlists = $this->model('Wishlist')->getAllActiveForUserId($_SESSION['user_id']);

		// redirection ids
		$redirect_condition = '';

		// update address
		if(isset($_POST['update_address'])) {
			$redirect_condition = 4;

			// get primary address info
			$user_id = $_SESSION['user_id'];
			$p_street = $_POST['p_street'];
			$p_city = $_POST['p_city'];
			$p_province = $_POST['p_province'];
			$p_postal_code = $_POST['p_postal_code'];
			$p_country = $_POST['p_country'];
			$p_status = 0;
			if(isset($_POST['p_primary_address'])) {
				$p_status = 1;
			}

			// get secondary address info
			$user_id = $_SESSION['user_id'];
			$s_street = $_POST['s_street'];
			$s_city = $_POST['s_city'];
			$s_province = $_POST['s_province'];
			$s_postal_code = $_POST['s_postal_code'];
			$s_country = $_POST['s_country'];
			$s_status = 0;
			if(isset($_POST['s_primary_address'])) {
				$s_status = 1;
			}

			// udpated primary address id
			$updated_address_id = '';

			// check if the address already exists in the db
			// primary address already exitss, just update it; otherwise, make a new one.
			if($primary_address) {
				$primary_address->user_id = $user_id;
				$primary_address->street = $p_street;
				$primary_address->city = $p_city;
				$primary_address->province = $p_province;
				$primary_address->postal_code = $p_postal_code;
				$primary_address->country = $p_country;
				$primary_address->status = $p_status;
	
				$primary_address->update();
			}
			else {
				$primary_address = $this->model('Address');
				$primary_address->user_id = $user_id;
				$primary_address->street = $p_street;
				$primary_address->city = $p_city;
				$primary_address->province = $p_province;
				$primary_address->postal_code = $p_postal_code;
				$primary_address->country = $p_country;
				$primary_address->status = $p_status;
	
				$primary_address->insert();

				$updated_address_id = $_SESSION['updated_address_id'];
			}
			
			// secondary address already exitss, just update it; otherwise, make a new one.
			if($secondary_address) {
				$secondary_address->user_id = $user_id;
				$secondary_address->street = $s_street;
				$secondary_address->city = $s_city;
				$secondary_address->province = $s_province;
				$secondary_address->postal_code = $s_postal_code;
				$secondary_address->country = $s_country;
				$secondary_address->status = $s_status;
	
				$secondary_address->update();
			}
			else {
				$secondary_address = $this->model('Address');
				$secondary_address->user_id = $user_id;
				$secondary_address->street = $s_street;
				$secondary_address->city = $s_city;
				$secondary_address->province = $s_province;
				$secondary_address->postal_code = $s_postal_code;
				$secondary_address->country = $s_country;
				$secondary_address->status = $s_status;
	
				$secondary_address->insert();
			}

			
			// if primary checkbox is not clicked in either of them, keep the existing primary address the same
			// if primary address's pcheck is clicked, make secadd paddress, and change paddress to secaddress
			if($p_status == 0) {
				// update secondary address status to 1
				$secondary_address->makePrimary($secondary_address->address_id);
				$updated_address_id = $secondary_address->address_id;

				// update primary address status to 0
				$primary_address->makeSecondary($primary_address->address_id);
			}

			// if secondary address's pcheck is clicked, make secadd paddress, and change paddress to secaddress
			if($s_status == 1) {
				// update secondary address status to 1
				$secondary_address->makePrimary($secondary_address->address_id);
				$updated_address_id = $secondary_address->address_id;
				
				// update primary address status to 0
				$primary_address->makeSecondary($primary_address->address_id);
			}

			// // update profile table with the new primary address id
			$user_profile->address = $updated_address_id;
			$user_profile->updateAddress();

			// success msg 
			$_SESSION['return-msg'] = "Address updated successfully";
			if($redirect_condition == 4) {
				$this->redirect_to('/account');
			}
		}

		// update account info
		if(!isset($_POST['update-account'])) {
			// redirection condition
			$redirect_condition = 1;

			$this->view('user/index', ['user_profile'=>$user_profile, 'orders'=>$orders, 'wishlists'=>$wishlists, 'primary_address'=>$primary_address, 'secondary_address'=>$secondary_address]);
		}
		else {
			
			// Get users information

			// user table info
			$current_user = $this->model('User')->find($_SESSION['user_id']);

			$full_name = $_POST['full_name'];
			echo $full_name;
			$phone_number = $_POST['phone_number'];
			$email = $_POST['email'];
			// $address = $_POST['address'];

			// update profile table
			$user_profile->full_name = $full_name;
			$user_profile->email = $email;
			$user_profile->phone_number = $phone_number;
			// $user_profile->address = $address;

			$user_profile->update();
			
			// update user table for password if their password is changed
			// if all fields are filled
			if(!empty($_POST['current_pwd'])) {

				// redirection condition
				$redirect_condition = 1;

				$current_pwd = $_POST['current_pwd'];
				

				// get user's old password 
				$old_password = $current_user->password;
				// verify if old password matches with the entered current password - if true, good; if not, print error.
				if(password_verify($current_pwd, $old_password)) {
					if(!empty($_POST['new_pwd']) && !empty($_POST['confirm_new_pwd'])) {
						$new_pwd = $_POST['new_pwd'];
						$confirm_new_pwd = $_POST['confirm_new_pwd'];

						// verify the new and confirm password
						if($new_pwd == $confirm_new_pwd) {
							// change user's password
							$current_user->password = password_hash($new_pwd, PASSWORD_DEFAULT);
							$current_user->updatePassword();

							// redirect with success msg
							$_SESSION['return-msg'] = "Password changed successfully";
							
							if($redirect_condition == 1) {
								$this->redirect_to('/account');
							}
							
						}
						else {
							$error_msg = 'Passwords do not match!';
							$this->view('user/index', ['user_profile'=>$user_profile, 'error_msg'=>$error_msg, 'orders'=>$orders, 'wishlists'=>$wishlists, 'primary_address'=>$primary_address, 'secondary_address'=>$secondary_address]);	
						}
					}
					else {
						$error_msg = 'To change your password, enter your new password!';
						$this->view('user/index', ['user_profile'=>$user_profile, 'error_msg'=>$error_msg, 'orders'=>$orders, 'wishlists'=>$wishlists, 'primary_address'=>$primary_address, 'secondary_address'=>$secondary_address]);	
					}
				}
				else {
					$error_msg = 'Current password is wrong!';
					$this->view('user/index', ['user_profile'=>$user_profile, 'error_msg'=>$error_msg, 'orders'=>$orders, 'wishlists'=>$wishlists, 'primary_address'=>$primary_address, 'secondary_address'=>$secondary_address]);
				}
			}
			else {
				// redirection condition
				$redirect_condition = 2;
				
				// redirect with success msg
				$_SESSION['return-msg'] = "Profile updated successfully";

				if($redirect_condition == 2) {
					$this->redirect_to('/account');
				}
			}

		}

		
	}


	public function signup() {

		// if the user is logged-in, redirect them to homepage
		if(isset($_SESSION['user_id'])) {
			return header('location:/');
		}

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
			$super_code_flag = 0;

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

							// assigned the super code to the user who used it and change its status to used (1) in the db
							$super_code_flag = 1;
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

						// super code table
						if($super_code_flag == 1) {
							
							$checked_super_code->user_id = $inserted_user_id;
							$checked_super_code->updateUserId();
						}

						// // successfull redirect to login page
						$_SESSION['successful_account_creation_msg'] = "Account created successfully. Please login to complete your profile!";
						header('location:/account/login');
					}


					
				}
				else {
					$this->view('account/signup', ['error'=>'Passwords do not match!']);
				}
			}
		}
		
	}

	public function login() {

		// if the user is logged-in, redirect them to homepage
		if(isset($_SESSION['user_id'])) {
			return header('location:/');
		}


		// if the login button is not clicked
		if(!isset($_POST['login'])) {
			$this->view('account/login');
		}
		else {
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			// // check if the user exists in the db
			$user = $this->model('User')->findByUsername($email);
			
			if($user == false || $user == null) {
				$this->view('account/login', ['error'=>'Account does not exist with this email!']);
			}
			elseif($user != null && password_verify($password, $user->password)) {
				// successfull login
				$_SESSION['user_id'] = $user->user_id; // global user id session to be used across
				$_SESSION['role'] = $user->role;

				// remove the $_SESSION['successful_account_creation_msg'] session.
				unset($_SESSION['successful_account_creation_msg']);

				header('location:/');
			}
			else {
				// remove the $_SESSION['successful_account_creation_msg'] session.
				unset($_SESSION['successful_account_creation_msg']);

				$this->view('account/login', ['error'=>'Wrong username or password!']);
			}

		}
	}

	public function signout() {
		session_destroy();

		header('location:/account/login');

	}

	// used for multiple header redirection - to fix the probelem
	private function redirect_to($destination) {
		if (headers_sent($filename, $line)) {
			trigger_error("Headers already sent in {$filename} on line {$line}", E_USER_ERROR);
		  }
		header("Location: {$destination}");
		exit;
	}

}