<?php
class BabyRegistryController extends Controller{

	private function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }
    
    private function get_token($length=12){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
        }
        return $token;
    }

	// Generate shareable uniqe key
	public function generate() {
		$data = [];
		$baby_reg_id = $_POST['baby_registry_id'];

		// check the baby registry token; if the baby reg id exists, return the existing token; otherwise, create a new one and return that
		$baby_reg_token = $this->model('BabyRegistryToken')->findByBabyRegistryId($baby_reg_id);
		if($baby_reg_token == false) {
			$new_token = $this->get_token(37);

			// make a new baby reg token
			$baby_reg_token = $this->model('BabyRegistryToken');
			$baby_reg_token->baby_registry_id = $baby_reg_id;
			$baby_reg_token->token = $new_token;
			$baby_reg_token->status = 1;
			$baby_reg_token->insert();
			
			$data['success'] = true;
			$data['token'] = $new_token;
		}
		else {
			// return the existing token
			$existing_token = $baby_reg_token->token;

			$data['success'] = false;
			$data['token'] = $existing_token;
		}

		echo json_encode($data);
	}

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

	public function add_products($token) {

	}



}