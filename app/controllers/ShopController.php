<?php
// For normal user 
class ShopController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){

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
		// remove the first comma from the colors string
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
		// remove the first comma from the colors string
		$keywords = ltrim($all_keywords_str, ',');
		$all_keywords = array_unique(array_map('trim', explode(',', $keywords)));

	
		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('shop/index', ['brands'=>$all_brands, 'categories'=>$all_categories, 'colors'=>$all_colors, 'size'=>$all_size, 'keywords'=>$all_keywords]);
	}

    public function product($product_id) {
        $this->view('shop/product_detail');
    }

	public function cart() {

	}

	public function checkout() {
		$this->view('shop/checkout');
	}

}