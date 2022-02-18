<?php
// For admin dashboard
class ProductController extends Controller{

	public function index(){

		// redirect to admin dashboard page
		return header('location:/admin/');
	}

    public function add_product() {
        $brands = $this->model('Brand')->getAll();
        $categories = $this->model('Category')->getAll();

        if(!isset($_POST['create'])) {

            $this->view('product/add_product', ['brands'=>$brands, 'categories'=>$categories]);
        }
        else {
            // Image validation and upload - Multiple product images
            $error = '';

            $targetDir = getcwd()."/assets/products/images/"; 
            $allowTypes = array('jpg','png','jpeg'); 

            $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
            $fileNames = array_filter($_FILES['images']['name']); 
            if(!empty($fileNames)){ 
                foreach($_FILES['images']['name'] as $key=>$val){ 
                    // File upload path 
                    $unique_id = uniqid();
                    $extension = strtolower(pathinfo(basename($_FILES['images']['name'][$key]),PATHINFO_EXTENSION));
                    $target_file_name = $unique_id.'.'.$extension;

                    // $fileName = basename($_FILES['images']['name'][$key]); 
                    $targetFilePath = $targetDir . $target_file_name; 
                    
                    // Check whether file type is valid 
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)); 
                    if(in_array($fileType, $allowTypes)){ 
                        // Upload file to server 
                        if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){ 
                            // Image db insert sql 
                            // $insertValuesSQL .= "('".$fileName."', NOW()),"; 
                            $insertValuesSQL .= $unique_id . '.' . $fileType . ',';
                        }else{ 
                            $errorUpload .= $_FILES['images']['name'][$key].' | '; 
                        } 
                    }else{ 
                        $errorUploadType .= $_FILES['images']['name'][$key].' | '; 
                    } 
                } 
                
                // Error message 
                $errorUpload = !empty($errorUpload) ? 'Upload Error: '.trim($errorUpload, ' | ') : ''; 
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: '.trim($errorUploadType, ' | ') : ''; 
                $$error = !empty($errorUpload) ? $errorUpload : $errorUploadType; 
        
                // // store each image in the db
                if(!empty($insertValuesSQL)){ 
                    $image_list_array = array_map('trim', explode(',', $insertValuesSQL));
                    $image_list_str = implode(', ', array_filter($image_list_array)); // this is string
                    
                    $images_name = explode(',', $image_list_str); // this is array

                     // get the information
                    $name = $_POST['name'];
                    $brand = $_POST['brand'];
                    $categories = serialize($_POST['categories']);
                    $price = $_POST['price'];
                    $quantities = $_POST['quantity'];
                    $size = serialize($_POST['size']);

                    $colors = array_map('trim', explode(',', $_POST['colors']));
                    $serialized_colors = serialize($colors);
                    
                    // serialize the keywords array to prevent sql injection 
                    $keywords = array_map('trim', explode(',', $_POST['keywords']));
                    $serialized_keywords = serialize($keywords);

                    $reward_point = $_POST['reward_point'];

                    $promotion = (isset($_POST['promotion'])) ? '1' : '0';
                    
                    $description = htmlentities($_POST['product_description']); // to prevent sql injection

                    // store the info in the db
                    // product model
                    $product = $this->model('Product');

                    $product->name = $name;
                    $product->brand_id = $brand;
                    $product->categories = $categories;
                    $product->price = $price;
                    $product->quantity_available = $quantities;
                    $product->size = $size;
                    $product->colors = $serialized_colors;
                    $product->keywords = $serialized_keywords;
                    $product->reward_point = $reward_point;
                    $product->promotion = $promotion;
                    $product->images = $image_list_str;
                    $product->description = $description;

                    $product->insert();

                    return header('location:/admin');

                }
                else {
                    $error .= "Upload failed!";
                }


                // foreach($image_list as $key=>$value) {
                //     echo "key: " . $key . ' -------> ' . 'value: ' . $value . "<br>";
                // }
                

            }else{ 
                $error = 'Please select a file to upload.'; 
            } 

        }
    }

    public function edit_product($product_id) {
        
    }



}