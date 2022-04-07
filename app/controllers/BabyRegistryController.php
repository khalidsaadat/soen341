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

		// get the all the baby registries for the current logged in user
		$baby_registeries = $this->model('BabyRegistry')->getAllByUserId($_SESSION['user_id']);

		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('baby_registry/index', ['baby_registeries'=>$baby_registeries]);
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
			$address_id = $_POST['change_address'];
			$description = $_POST['description'];

			// // get products detail
			// $product_ids_obj = $this->model('Product')->getAllIdsByUserId($_SESSION['user_id']);	// object => {1,2,3,4}	
			// $product_ids_array = array(); // {1,2,3,4}

			// $counter = 0;
			// foreach($product_ids_obj as $product) {
			// 	$product_ids_array[$counter] = $product->product_id;
				
			// 	// Update cart items' status to 1 (they are no longer in cart)
			// 	$current_product_item = $this->model('Product')->find($product->product_id);
			// 	$current_product_item->status = '1';
			// 	$current_product_item->updateStatus();

			// 	$counter++;
			// }
			// $product_ids_serialized = serialize($product_ids_array);
		

			$new_registry = $this->model('BabyRegistry'); // create registry model

            // $new_registry->product_ids = $product_ids_serialized;
			$new_registry->user_id = $_SESSION['user_id'];
			$new_registry->name = $name;
			$new_registry->email = $email;
			$new_registry->delivery_date = $delivery_date;
			$new_registry->organizer_name = $organizer_name;
			$new_registry->address_id = $address_id;
			$new_registry->description = $description;
		
			$new_registry->insert();

			// $this->view('baby_registry/add');
			return header('location:/babyregistry');
		}
	    
	}

	public function add_products($token) {

		// if not logged in, go to the login page
		if(!isset($_SESSION['user_id'])) {

			$_SESSION['login_flag'] = 1;
			return header('location:/account/login');
		}
		
		$baby_registry_token = $this->model('BabyRegistryToken')->find($token);

		if($baby_registry_token) {
			$token = $baby_registry_token->token;

			$baby_registry_id = $baby_registry_token->baby_registry_id;

			// get the baby registry
			$baby_registry = $this->model('BabyRegistry')->find($baby_registry_id);

			// get the products' basic information
			$babies_products = $this->model('Product')->getSearchResultByCategory('babies');

			// Search product
			if(isset($_POST['search_btn'])) {
				$search_query = $_POST['search_query'];

				// filter product by 'name' field
				if(empty($search_query))
					$babies_products = $this->model('Product')->getSearchResultByCategory('babies');
				else 
					$babies_products = $this->model('Product')->getSearchResultByName($search_query);
				
			}

			// // $this->view('baby_registry/add_products');
			$this->view('baby_registry/add_products', ['baby_registry'=>$baby_registry, 'token'=>$token, 'babies_products'=>$babies_products]);
		
		}
		else {
			echo 'nothing to show';
		}
	}

	public function shareable($token) {
		
		// get the baby reg id by the token if exists
		$baby_reg_token = $this->model('BabyRegistryToken')->find($token);
		

		if($baby_reg_token) {
			// get the baby registry
			$baby_reg_id = $baby_reg_token->baby_registry_id;

			$baby_registry = $this->model('BabyRegistry')->find($baby_reg_id);

			$this->view('baby_registry/shareable_page', ['baby_registry'=>$baby_registry]);
		}
	}

	public function add_to_registry($token, $product_id) {

		if(!isset($_SESSION['user_id'])) {
			$_SESSION['login_flag'] = 1;
			return header('location:/registry');
		}

		// baby registry token object
		$baby_reg_token = $this->model('BabyRegistryToken')->find($token);

		if($baby_reg_token) {
			// get the baby registry id from the baby registry token object
			$baby_reg_id = $baby_reg_token->baby_registry_id;

			// make a baby registry object from baby registry id
			$baby_registry = $this->model('BabyRegistry')->find($baby_reg_id);

			// update baby registry to add the new product
			$baby_reg_product_ids_serialized = $baby_registry->product_ids; 
			$baby_reg_product_ids_unserialized = unserialize($baby_reg_product_ids_serialized); 

			// if baby reg product ids is emtpy, add a new; otherwise, append to the existing array
			if($baby_reg_product_ids_unserialized == false) {
				// product ids field is empty
				$serialized_product_id_array = explode(',', $product_id);
				$updated_baby_reg_product_ids = serialize($serialized_product_id_array);
			}
			else {
				// append to array
				array_push($baby_reg_product_ids_unserialized, $product_id);

				// serialize the product ids array
				$updated_baby_reg_product_ids = serialize($baby_reg_product_ids_unserialized);
			}

			// update baby registry with the new product ids
			$baby_registry->product_ids = $updated_baby_reg_product_ids;
			$baby_registry->updateProductIds();
			
			return header('location:/babyregistry/add_products/' . $token);

		}

	}

	public function remove_from_registry($token, $product_id) {
		
		if(!isset($_SESSION['user_id'])) {
			$_SESSION['login_flag'] = 1;
			return header('location:/registry');
		}

		// baby registry token object
		$baby_reg_token = $this->model('BabyRegistryToken')->find($token);

		if($baby_reg_token) {
			// get the baby registry id from the baby registry token object
			$baby_reg_id = $baby_reg_token->baby_registry_id;

			// make a baby registry object from baby registry id
			$baby_registry = $this->model('BabyRegistry')->find($baby_reg_id);

			// update baby registry to add the new product
			$baby_reg_product_ids_serialized = $baby_registry->product_ids; 
			$baby_reg_product_ids_unserialized = unserialize($baby_reg_product_ids_serialized); 

			
			// // append to array
			// array_push($baby_reg_product_ids_unserialized, $product_id);

			// // serialize the product ids array
			// $updated_baby_reg_product_ids = serialize($baby_reg_product_ids_unserialized);
		}
	}

	public function add_to_cart($token, $product_id){
		
		$user_id = '';
		if(!isset($_SESSION['user_id'])) {
			$_SESSION['login_flag'] = 1;
			$user_id = $_SESSION['user_id'];

			return header('location:/registry');
		}

		// baby registry id
		$baby_registry_id = $this->model('BabyRegistryToken')->find($token)->baby_registry_id;
		
		// get the updated values
		$product = $this->model('Product')->find($product_id);
		
		$size = unserialize($product->size);
		$color = unserialize($product->colors);
		$quantity = 1;
		$price = $product->price;
	
		
		// update the product cart
		$add_cart = $this->model('Cart');
		
		$add_cart->product_id = $product_id;
		$add_cart->size = $size[0];
		$add_cart->color = $color[0];
		$add_cart->quantity = $quantity;
		$add_cart->price = $price;
		$add_cart->user_id = $_SESSION['user_id'];
		$add_cart->baby_reg_flag = 1;
		$add_cart->baby_reg_id = $baby_registry_id;

		$add_cart->insertForBabyRegistry();

		$_SESSION['return-msg'] = "Product added to cart";


		return header('location:/babyregistry/shareable/' . $token);
	}

	public function remove_from_cart($token, $product_id) {

		// baby registry id
		$baby_registry_id = $this->model('BabyRegistryToken')->find($token)->baby_registry_id;

		$cart_item = $this->model('Cart')->findByProductIdByUserIdByRegId($product_id, $_SESSION['user_id'], $baby_registry_id);
		$cart_item->deleteForBabyRegistry();

		$_SESSION['return-msg'] = "Product removed from cart";

		return header('location:/babyregistry/shareable/' . $token);

	}


}