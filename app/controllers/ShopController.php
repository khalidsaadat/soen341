<?php
// For normal user 
class ShopController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){
    
		// get the products' basic information
		$products_basic_info = $this->model('Product')->getAllBasicInfo();
		$products = $this->model('Product')->getAllActive();

		// add to cart
		if(isset($_POST['add_to_cart'])) {
			// redirect user to login page if they are not logged in
			if(!isset($_SESSION['user_id'])) {
				$_SESSION['login_flag'] = 1;
				return header('location:/account/login');
			}
			$product_quantity = 1;
			$product_id = $_POST['product_id'];
			$product_user_id = $_SESSION['user_id'];

			$select_cart = $this->model('Cart')->findByProductIdByUserId($product_id, $product_user_id);
			// if it is false, add the product to the cart
			if(!$select_cart) {
				$new_product = $this->model('Cart');
				$new_product->product_id = $product_id;
				$new_product->quantity = $product_quantity;
				$new_product->user_id = $product_user_id;

				$new_product->insert();
			}
			else {
				// the product is already in the cart
				$current_quantity = $select_cart->quantity;
				$updated_quantity = $current_quantity + 1;

				// update the cart table
				$select_cart->quantity = $updated_quantity;
				$select_cart->updateQuantity();
			}
		}
    
		$all_brands = $this->model('Brand')->getAll();
		
		
		$all_categories = $this->model('Category')->getAll();



		// Colors for sidebar
		$all_colors_serialized = $this->model('Product')->getAllColors();
		
		$all_colors_str = '';
		foreach($all_colors_serialized as $color) {
			$color_array = (array) $color; // array of serialized colors
			$unserialized_color = unserialize($color_array['colors']); //--> red, blue, yellow

			$all_colors_str .= ',' . implode(', ', array_map("ucfirst", $unserialized_color));
		}
		
		// all colors stored in array
		// remove the first comma from the colors string
		$colors = ltrim($all_colors_str, ',');
		$all_colors = array_unique(array_map('trim', explode(',', $colors)));



		
	
		// Sizes for sidebar
		$all_sizes_serialized = $this->model('Product')->getAllSizes();
		
		$all_sizes_str = '';
		foreach($all_sizes_serialized as $sizes) {
			$size_array = (array) $sizes; // array of serialized colors
			$unserialized_size = unserialize($size_array['size']); //--> red, blue, yellow

			$all_sizes_str .= ',' . implode(', ', array_map("ucfirst", $unserialized_size));
		}
		
		// all colors stored in array
		// remove the first comma from the size string
		$size = ltrim($all_sizes_str, ',');
		$all_size = array_unique(array_map('trim', explode(',', $size)));




		
		// TAGS for sidebar
		$all_keywords_serialized = $this->model('Product')->getAllKeywords();
		
		$all_keywords_str = '';
		foreach($all_keywords_serialized as $keyword) {
			$keyword_array = (array) $keyword; // array of serialized colors
			$unserialized_keyword = unserialize($keyword_array['keywords']); //--> red, blue, yellow

			$all_keywords_str .= ',' . implode(', ', array_map("ucfirst", $unserialized_keyword));
		}
		
		// all colors stored in array
		// remove the first comma from the keyword string
		$keywords = ltrim($all_keywords_str, ',');
		$all_keywords = array_unique(array_map('trim', explode(',', $keywords)));

	
		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('shop/index', ['products'=>$products, 'products_basic_info'=>$products_basic_info, 'brands'=>$all_brands, 'categories'=>$all_categories, 'colors'=>$all_colors, 'size'=>$all_size, 'keywords'=>$all_keywords]);

	}

	// product detail page
    public function product($product_id, $type="view") {
		$product = $this->model('Product')->find($product_id);

		// redirect conditions based on the view type
		$redirect_condition = '';

		// if product does not exist, show error 404 view; otherwise, show the product detail page
		if($product == null) {
			$this->view('EXCEPTIONS/error_404');
		}
		else {
			// to view the product detail page
			if($type == 'view') {
				$redirect_condition = 1;
				$this->view('shop/product_detail', ['product'=>$product, 'type'=>'view']);
			}
			// to edit the product in product detail page
			elseif($type == 'edit') {
				
				

				$cart_item = $this->model('Cart')->findByProductIdByUserId($product_id, $_SESSION['user_id']);

				// remove item from the cart
				if(isset($_POST['remove_cart'])) {
					$redirect_condition = 2;
					$cart_item->delete();

					// success session msg
					$_SESSION['cart_removed'] = 1;

					if($redirect_condition == 2) {
						$this->redirect_to('/shop/checkout');
					}
					
				}

				// check if the update cart button is clicked
				if(!isset($_POST['update_cart'])) {
					$this->view('shop/product_detail', ['product'=>$product, 'cart_item'=>$cart_item, 'type'=>'edit']);
				}
				else {
					// redirect condition number for editing product
					$redirect_condition = 3;
					// get the updated values
					$size = $_POST['size'];
					$color = $_POST['color'];
					$quantity = $_POST['quantity'];

					// update the product cart
					$cart_item->size = $size;
					$cart_item->color = $color;
					$cart_item->quantity = $quantity;

					$cart_item->updateCart();
					
					if($redirect_condition == 3) {
						$this->redirect_to('/shop/checkout');
					}
				}
				
			}
			else {
				$this->view('EXCEPTIONS/error_404');
			}
		}
		
    }

	// used for multiple header redirection - to fix the probelem
	private function redirect_to($destination) {
		if (headers_sent($filename, $line)) {
			trigger_error("Headers already sent in {$filename} on line {$line}", E_USER_ERROR);
		  }
		header("Location: {$destination}");
		exit;
	}

	public function cart() {

	}

	public function checkout() {
		if(!isset($_SESSION['user_id'])) {
			$_SESSION['login_flag'] = 1;
			return header('location:/account/login');
		}

		if(isset($_SESSION['user_id'])) {
			$cart_items = $this->model('Cart')->getAllByUserId($_SESSION['user_id']);

			if(!isset($_POST['review_cart'])) {
				$this->view('shop/checkout', ['cart_items'=>$cart_items]);
			}
			else {
				// get the user information
				$order_id = 5;
				$first_name = $_POST['first'];
				$last_name = $_POST['last'];
				$addres = $_POST['address'];
				$city = $_POST['city'];
				$province = $_POST['province'];
				$postal_code = $_POST['code'];
				$country = $_POST['country'];
				$phone = $_POST['phone_num'];
				$email = $_POST['email'];
				$card = $_POST['credit_card_num'];
				$name = $_POST['card_holder_name'];
				$expiry_date = $_POST['expiry_date'];
				$cvv_num = $_POST['cvv'];
				$cvvType = $_POST['cvvType'];
				$detail_user_id = $_SESSION['user_id'];
	
	
				// Evaluation
	
				// credit card validation
				$ccResult = ($this->CCValidate($cvvType, $card)) ? 'valid' : 'invalid';
	
				// cvv validation
				$cvvResult = ($this->CVV($cvvType, $cvv_num)) ? 'valid' : 'invalid';
	
				// expiry date validation
				$expResult = ($this->validateCCExpDate($expiry_date)) ? 'valid' : 'invalid';
		
				if($ccResult == 'valid' && $cvvResult == 'valid' && $expResult == 'valid') { 
					// it is safe to continue
	
					// Order table
					// $last_order_id = '5';
	
					// get the information
					$cart_ids = $this->model('Cart')->getAllIdsByUserId($_SESSION['user_id']);	// {1,2,3,4}
					// $billing_detail = $_SESSION['billing_detail_id'];
					// $order_number = $_POST['order_number'];
					// $status = $_POST['status'];
					
							
					$order_number = $this->getToken();

					$_SESSION['current_order_number'] = $order_number;
					
					// $order->order_number = $order_number;
					// echo "$order_number";
	
	
					//Order Table
					// $new_order = $this->model('Order');
					// $new_order->cart_ids = $cart_ids;
					// $new_order->order_number  = $order_number;
					// $new_order->status  = $status;
	
					// $new_order->insert();
	
					$last_order_id = $_SESSION['current_order_number'];
	
					// Billing detail table
					$new_detail = $this->model('BillingDetails');
					// $new_detail->order_id = $last_order_id; --> we dont need it
					$new_detail->first_name   = $first_name;
					$new_detail->last_name    = $last_name;
					$new_detail->address = $addres;
					$new_detail->city    = $city;
					$new_detail->province = $province;
					$new_detail->postal_code     = $postal_code;
					$new_detail->country  = $country;
					$new_detail->phone = $phone;
					$new_detail->email     = $email;
					$new_detail->user_id  = $detail_user_id; 
	
					$new_detail->insert();
	
					// success redirect
					return header('location:/shop/order_confirmation');
			
				}
				else {
					// credit card detail wrong
					$this->view('shop/checkout', ['cart_items'=>$cart_items, 'ccError'=>$ccResult, 'cvvError'=>$cvvResult, 'expError'=>$expResult]);
				}
	
			}
		}
		else {
			$cart_items = '';
			$this->view('shop/checkout', ['cart_items'=>$cart_items]);
		}
	}


	private function CCValidate($type, $cNum) {
        switch ($type) {
        case "American":
            $pattern = "/^([34|37]{2})([0-9]{13})$/";//American Express
            return (preg_match($pattern,$cNum)) ? true : false; 
            break;
        case "Discover":
            $pattern = "/^([6011]{4})([0-9]{12})$/";//Discover Card
            return (preg_match($pattern,$cNum)) ? true : false;
            break;
        case "Master":
            $pattern = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//Mastercard
            return (preg_match($pattern,$cNum)) ? true : false;
            break;
        case "Visa":
            $pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa
            return (preg_match($pattern,$cNum)) ? true : false; 
            break;               
       }
  } 

	private function CVV($type, $cvv) {
        
        switch ($type) {
        case "American":
            $pattern = "/^[0-9]{4}$/";//American Express
            return (preg_match($pattern,$cvv)) ? true : false; 
            break;
        case "Discover":
            $pattern = "/^[0-9]{4}$/";//Discover Card
            return (preg_match($pattern,$cvv)) ? true : false;
            break;
        case "Master":
            $pattern = "/^[0-9]{3}$/";//Mastercard
            return (preg_match($pattern,$cvv)) ? true : false;
            break;
        case "Visa":
            $pattern = "/^[0-9]{3}$/";//Visa
            return (preg_match($pattern,$cvv)) ? true : false; 
            break;               
       }
   }


    private function validateCCExpDate($date)
    {
       
         // get the expiry date from the checkout view
        $expiry_date_post = $date;
        // add "01" (which is day) to the expiry date variable
        $expiry_date_str = "01/" . $expiry_date_post;
        // replace / with - 
        $expiry_date = str_replace('/', '-', $expiry_date_str);

        // Creating timestamp from given date
        $timestamp = strtotime($expiry_date);

        // Creating new date format from that timestamp
        $new_date = date("Y/m", $timestamp);
        //echo $new_date;
		$current_date = date("Y/m");
        return ($new_date > $current_date) ? true : false;
	
    }

	public function order_confirmation() {
		$order_detail = ''; // get the order detail from order table



		$this->view('shop/order_confirmation', ['order_detail'=>$order_detail]);
	}

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
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
        }
        return $token;
    }
  
	public function add_to_wishlist($product_id) {

		if(!isset($_SESSION['user_id'])) {
			return header('location:/account/login');
		}

		$user_id = '';
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
		}

		// wishlist object
		$wishlist = $this->model('Wishlist');
		$wishlist->product_id = $product_id;
		$wishlist->user_id = $user_id;

		$wishlist->insert();

		// success session msg
		$_SESSION['wishlist_added'] = 1;

		return header('location:/shop/checkout');

	}

	public function remove_from_wishlist($product_id) {

		if(!isset($_SESSION['user_id'])) {
			return header('location:/account/login');
		}
		
		$user_id = '';
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
		}

		// wishlist object
		$wishlist = $this->model('Wishlist');
		$wishlist->product_id = $product_id;
		$wishlist->user_id = $user_id;

		$wishlist->delete();

		// success session msg
		$_SESSION['wishlist_removed'] = 1;

		return header('location:/shop/checkout');

	}

}
