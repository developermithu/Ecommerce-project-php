<?php
  $filePath = realpath(dirname(__FILE__));
  include_once ($filePath.'/../lib/Database.php') ;
  include_once ($filePath.'/../helpers/Format.php') ;
?>

<?php 
  class Cart{
    private $db;
    private $fm;

    public function __construct(){
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function addToCart($quantity, $id){
      $quantity  = $this->fm->validation($quantity);
      $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
      $productId = mysqli_real_escape_string($this->db->link, $id);
      $sessionId = session_id();  //every pc has unique session_id like 3b4t0onf4a5ch39f6cu5tpatlr;

      $query = "SELECT * FROM `tbl_product` WHERE `productId` = '$productId' ";
      $result = $this->db->select($query)->fetch_assoc();

      $productName = $result['productName'];
      $Price = $result['Price'];
      $image = $result['image'];

      $checkQuery = "SELECT * FROM `tbl_cart` WHERE `productId` = '$productId' AND `sessionId` = '$sessionId' ";
      $result = $this->db->select($checkQuery);
      if ($result) {
        $msg = 'Product Already Added';
        return $msg;
      }else{
          $query = "INSERT INTO `tbl_cart` (`sessionId`, `productId`, `productName`, `Price`, `quantity`, `image`) VALUES ('$sessionId', '$productId', '$productName', '$Price', '$quantity', '$image') ";
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
           header("location: cart.php");
          }else{
            header("location: 404.php");
          } 
      }
  }

  public function getCartProductById(){
    $sessionId = session_id();
    $query = "SELECT * FROM `tbl_cart` WHERE `sessionId` = '$sessionId' " ;
    $result = $this->db->select($query);
    return $result;
  }

  public function updateCartQuantity($cartId, $quantity){
     $quantity  = $this->fm->validation($quantity);
     $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
     $cartId    = mysqli_real_escape_string($this->db->link, $cartId);

     $query = "UPDATE `tbl_cart` SET `quantity` = '$quantity' WHERE `catId` = '$cartId' ";
     $updated_row = $this->db->update($query);
     if ($updated_row) {
       header("location:cart.php");
     }else{
       $msg = "<span class='error'>Quantity Not Updated !</span>";
       return $msg;
     }
  }

  public function deleteCartById($delCart){
      $delCart  = mysqli_real_escape_string($this->db->link, $delCart);
      $query = "DELETE FROM `tbl_cart` WHERE `catId` = '$delCart' ";
      $deleted = $this->db->delete($query);
    if ($deleted) {
      echo "<script>window.location = 'cart.php'; </script>";
    }else{
      $msg = "<span class='error'>Cart not deleted !</span>";
        return $msg;
    }
  }

  public function checkCartTable(){
    $sessionId = session_id();
    $query = "SELECT * FROM `tbl_cart` WHERE `sessionId` = '$sessionId' " ;
    $result = $this->db->select($query);
    return $result;
  }

  // logout korle cart delete hoye jabe
  public function delCustomerCart(){
    $sessionId = session_id();
    $query = "DELETE FROM `tbl_cart` WHERE `sessionId` = '$sessionId' ";
    $this->db->delete($query);
  }

  public function orderProduct($customerId){
    $sessionId = session_id();
    $query = "SELECT * FROM `tbl_cart` WHERE `sessionId` = '$sessionId' " ;
    $result = $this->db->select($query);
    if ($result) {
      while ($cart   = $result->fetch_assoc()) {
        $productId   = $cart['productId'];
        $productName = $cart['productName'];
        $quantity    = $cart['quantity'];
        $Price       = $cart['Price'] * $quantity;  //quantity*price
        $image       = $cart['image'];

         $query = "INSERT INTO `tbl_order` (`custId`, `productId`, `productName`, `quantity`, `price`, `image`) VALUES ('$customerId', '$productId', '$productName', '$quantity', '$Price', '$image') ";
          $inserted_row = $this->db->insert($query);
      }
    }
  }

  public function payableAmount($customerId){
    $query = "SELECT `price` FROM `tbl_order` WHERE `custId` = '$customerId' AND `date` = now() ";
    $result = $this->db->select($query);
    return $result;
  }

  public function getOrderdDetails($customerId){
    $query = "SELECT * FROM `tbl_order` WHERE `custId` = '$customerId' ORDER BY `date` DESC ";
    $result = $this->db->select($query);
    return $result;
  }

  public function checkOrderProduct($customerId){
    $query = "SELECT * FROM `tbl_order` WHERE `custId` = '$customerId' ";
    $result = $this->db->select($query);
    return $result;
  }

  // For Admin Panel inbox
  public function getAllOrderProduct(){
     $query = "SELECT * FROM `tbl_order` ORDER BY `date` DESC ";
     $result = $this->db->select($query);
     return $result;
  }

  public function productShifted($id, $price, $date){
     $id    = $this->fm->validation($id);
     $price = $this->fm->validation($price);
     $date  = $this->fm->validation($date);

     $id    = mysqli_real_escape_string($this->db->link, $id);
     $price = mysqli_real_escape_string($this->db->link, $price);
     $date  = mysqli_real_escape_string($this->db->link, $date);

     $query = "UPDATE `tbl_order`
        SET `status` = '1' 
        WHERE `custId` = '$id' AND `price` = '$price' AND `date` = '$date' ";
      $updated_row = $this->db->update($query);
      if ($updated_row) {
        $msg = "<span class='success'> Updated successfully!</span>";
        return $msg;
      }else{
        $msg = "<span class='error'> Not updated!</span>";
        return $msg;
      }
  }//function end

  // delete shifted product from admin panel
  public function deleteShiftedProduct($id, $price, $date){
    $query = "DELETE FROM `tbl_order`  WHERE `custId` = '$id' AND `price` = '$price' AND `date` = '$date' ";
      $deleted = $this->db->delete($query);
    if ($deleted) {
      $msg = "<span class='success'>Data Deleted Successfully !</span>";
        return $msg;
    }else{
      $msg = "<span class='error'>Data not deleted !</span>";
        return $msg;
    }
  }

  //confirm product shifted by customer
  public function confirmProductShifted($id, $price, $date){
    $id     = $this->fm->validation($id);
     $price = $this->fm->validation($price);
     $date  = $this->fm->validation($date);

     $id    = mysqli_real_escape_string($this->db->link, $id);
     $price = mysqli_real_escape_string($this->db->link, $price);
     $date  = mysqli_real_escape_string($this->db->link, $date);

     $query = "UPDATE `tbl_order`
        SET `status` = '2' 
        WHERE `custId` = '$id' AND `price` = '$price' AND `date` = '$date' ";
      $updated_row = $this->db->update($query);
     
    }//function end


}
?>
