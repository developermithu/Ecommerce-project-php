<?php
  $filePath = realpath(dirname(__FILE__));
  include_once ($filePath.'/../lib/Database.php') ;
  include_once ($filePath.'/../helpers/Format.php') ;
?>

<?php 
  class Product{
    private $db;
    private $fm;

	 	public function __construct(){
	      $this->db = new Database();
	      $this->fm = new Format();
	    }

	public function productInsert($data, $file){  //$data = $_POST  $file = $_FILES
		$productName = $this->fm->validation($data['productName']);
		$catId		   = $this->fm->validation($data['catId']);
		$brandId	   = $this->fm->validation($data['brandId']);
		$body 		   = $this->fm->validation($data['body']);
		$price 		   = $this->fm->validation($data['price']);
		$type 		   = $this->fm->validation($data['type']);

		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId 	     = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body        = mysqli_real_escape_string($this->db->link, $data['body']);
		$price       = mysqli_real_escape_string($this->db->link, $data['price']);
		$type        = mysqli_real_escape_string($this->db->link, $data['type']);

	    $permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div 			= explode('.', $file_name);
	    $file_ext 		= strtolower(end($div));
	    $unique_image 	= substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" || $file_name == "") {
	     	$msg = "<span class='error'>Field must not be empty!</span>";
	     	return $msg;
	    }
	    elseif ($file_size >1048567) {
	     	$msg = "<span class='error'>Image Size should be less then 1MB!
	     	</span>";
	     	return $msg ;
	    } 
	    elseif (in_array($file_ext, $permited) === 'false') {
	     	$msg = "<span class='error'>You can upload only:-"
	     	.implode(', ', $permited)."</span>";
	     	return $msg ;
	    } 
	    else{
	    move_uploaded_file($file_temp, $uploaded_image);
	    $query = "INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `Price`, `image`, `type`) VALUES (NULL, '$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type') ";
	    $inserted_row = $this->db->insert($query);
	    if ($inserted_row) {
	    	$msg = "<span class='success'>Data inserted successfully !</span>";
	     	return $msg;
	    }else{
	    	$msg = "<span class='error'>Data not inserted !</span>";
	     	return $msg;
	    }
	   }
	 }

	 public function getAllProduct(){
	 	$query = "SELECT `tbl_product`.*,`tbl_category`.`catName`,`tbl_brand`.`brandName` FROM `tbl_product`
		INNER JOIN `tbl_category`
		ON `tbl_product`.`catId` = `tbl_category`.`catId`
		INNER JOIN `tbl_brand`
		ON `tbl_product`.`brandId` = `tbl_brand`.`brandId`
	 	ORDER BY `tbl_product`.`productId` DESC";
	 	$selected_row = $this->db->select($query);
	 	return $selected_row;
	 }

	 public function getAllProductById($id){
	 	$query = "SELECT * FROM `tbl_product` WHERE `productId` = '$id' ";
	 	$selected_row = $this->db->select($query);
	 	return $selected_row;
	 }

	 public function updateProduct($data, $file, $id){
	 	$productName = $this->fm->validation($data['productName']);
		$catId		 = $this->fm->validation($data['catId']);
		$brandId	 = $this->fm->validation($data['brandId']);
		$body 		 = $this->fm->validation($data['body']);
		$price 		 = $this->fm->validation($data['price']);
		$type 		 = $this->fm->validation($data['type']);

		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId 	     = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body        = mysqli_real_escape_string($this->db->link, $data['body']);
		$price       = mysqli_real_escape_string($this->db->link, $data['price']);
		$type        = mysqli_real_escape_string($this->db->link, $data['type']);

	    $permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div 			= explode('.', $file_name);
	    $file_ext 		= strtolower(end($div));
	    $unique_image 	= substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" ) {
	     	$msg = "<span class='error'>Field must not be empty!</span>";
	     	return $msg;
	    }else{
		   	 if (!empty($file_name)) {	
			    if ($file_size >1048567) {
			     	$msg = "<span class='error'>Image Size should be less then 1MB!
			     	</span>";
			     	return $msg ;
			    } 
			    elseif (in_array($file_ext, $permited) === 'false') {
			     	$msg = "<span class='error'>You can upload only:-"
			     	.implode(', ', $permited)."</span>";
			     	return $msg ;
			    } 
			    else{
			    move_uploaded_file($file_temp, $uploaded_image);
			    $query = "UPDATE `tbl_product` SET 
			    	`productName` = '$productName',
			    	`catId` 	  = '$catId',
			    	`brandId`     = '$brandId',
			    	`body`        = '$body',
			    	`Price`       = '$price',
			    	`image`       = '$uploaded_image',
			    	`type`        = '$type'
			        WHERE `productId` = '$id' ";
			    $updated_row = $this->db->update($query);
			    if ($updated_row) {
			    	$msg = "<span class='success'>Data updated successfully !</span>";
			     	return $msg;
			    }else{
			    	$msg = "<span class='error'>Data not updated !</span>";
			     	return $msg;
			    }
			   }

			}else{
				   $query = "UPDATE `tbl_product` SET 
			    	`productName` = '$productName',
			    	`catId` 	  = '$catId',
			    	`brandId`     = '$brandId',
			    	`body`        = '$body',
			    	`Price`       = '$price',
			    	`type`        = '$type'
			        WHERE `productId` = '$id' ";
			    $updated_row = $this->db->update($query);
			    if ($updated_row) {
			    	$msg = "<span class='success'>Data updated successfully !</span>";
			     	return $msg;
			    }else{
			    	$msg = "<span class='error'>Data not updated !</span>";
			     	return $msg;
			    }
		 	}
	  } //first else
	} //class end

	public function delProductById($id){
		$query = "SELECT * FROM `tbl_product` WHERE `productId` = '$id' ";
		$result = $this->db->select($query);
		if ($result) {
			while ($product = $result->fetch_assoc()) {
			    $delImg = $product['image'];
			    unlink($delImg);
			}
		}
		$query = "DELETE FROM `tbl_product` WHERE `productId` = '$id' ";
		$deleted = $this->db->delete($query);
		if ($deleted) {
			$msg = "<span class='error'>Data deleted successfully !</span>";
		    return $msg;
		}else{
			$msg = "<span class='error'>Data not deleted !</span>";
		    return $msg;
		}
	}

		public function getFeaturedProduct(){
			$query = "SELECT * FROM `tbl_product` WHERE `type` = '1' ORDER BY `productId` DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}

		public function getNewProduct(){
			$query = "SELECT * FROM `tbl_product` WHERE `type` = '2' ORDER BY `productId` DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSingleProductById($id){
			$query = "SELECT `tbl_product`.*, `tbl_category`.`catName`, `tbl_brand`.`brandName` FROM `tbl_product`
				INNER JOIN `tbl_category` ON `tbl_product`.`catId` = `tbl_category`.`catId`
				INNER JOIN `tbl_brand` ON `tbl_product`.`brandId` = `tbl_brand`.`brandId`
				WHERE `tbl_product`.`productId` = '$id' ";

			$result = $this->db->select($query);
			return $result;
		}

		// Brand Latest Product
		public function latestFromIphone(){
			$query = "SELECT * FROM `tbl_product` WHERE `brandId` = '12' ORDER BY `productId` DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function latestFromSamsung(){
			$query = "SELECT * FROM `tbl_product` WHERE `brandId` = '8' ORDER BY `productId` DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function latestFromAcer(){
			$query = "SELECT * FROM `tbl_product` WHERE `brandId` = '9' ORDER BY `productId` DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function latestFromCanon(){
			$query = "SELECT * FROM `tbl_product` WHERE `brandId` = '10' ORDER BY `productId` DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function productByCatId($id){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT * FROM `tbl_product` WHERE `catId` = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

 }
 
?>