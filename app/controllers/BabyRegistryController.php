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

		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('baby_registry/index');
	}

	public function add() {
		$this->view('BASE_STRUCTURES/empty_view');
	}

	public function add_products($token) {

	}



}