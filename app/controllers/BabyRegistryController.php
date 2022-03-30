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
    
    private function getToken($length=12){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
        }
        return $token;
    }

	// Function that shows the index page when you type 'localhost'
	public function index(){

		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('baby_registry/index');
	}

	public function add() {
		$this->view('BASE_STRUCTURES/empty_view');
	}

	public function generate($order_id) {
		$token = $this->getToken(64);

		// Baby reg token
		$baby_reg_token = $this->model('BabyRegistryToken');
		$baby_reg_token->baby_registry_id = $order_id;
		$baby_reg_token->token = $token;
		$baby_reg_token->status = 1;
		$baby_reg_token->insert();

		echo 'done';
	}

}