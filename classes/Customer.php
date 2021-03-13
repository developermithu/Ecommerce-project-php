<?php
  $filePath = realpath(dirname(__FILE__));
  include_once ($filePath.'/../lib/Database.php') ;
  include_once ($filePath.'/../helpers/Format.php') ;
?>

<?php 
  class Customer{
    private $db;
    private $fm;

    public function __construct(){
       $this->db = new Database();
       $this->fm = new Format();
    }

    public function customerRegistration($data){
        $name     = $this->fm->validation($data['name']);
        $city     = $this->fm->validation($data['city']);
        $zip      = $this->fm->validation($data['zip']);
        $email    = $this->fm->validation($data['email']);
        $address  = $this->fm->validation($data['address']);
        $country  = $this->fm->validation($data['country']);
        $phone    = $this->fm->validation($data['phone']);
        $password = $this->fm->validation($data['password']);

        $name     = mysqli_real_escape_string($this->db->link, $data['name']);
        $city     = mysqli_real_escape_string($this->db->link, $data['city']);
        $zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
        $email    = mysqli_real_escape_string($this->db->link, $data['email']);
        $address  = mysqli_real_escape_string($this->db->link, $data['address']);
        $country  = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']); //sha1(md5())

        if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "" ) {
          $msg = "<span class='error'>Field must not be empty!</span>";
          return $msg;
        }
        // email jodi database e age theke registration kora thake
        $mailQuery = "SELECT * FROM `tbl_customer` WHERE `email` = '$email' LIMIT 1 ";
        $mailCheck = $this->db->select($mailQuery);
        if ($mailCheck) {
          $msg = "<span class='error'>Email Alredy Exist !</span>";
          return $msg;
        }else{
            $query = "INSERT INTO `tbl_customer` (`name`, `city`, `zip`, `email`, `address`, `country`, `phone`, `password`) VALUES ('$name', '$city', '$zip', '$email', '$address', '$country', '$phone', '$password') ";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
              $msg = "<span class='success'>Congrates! Registration successfully completed.</span>";
              return $msg;
            }else{
              $msg = "<span class='error'>Something went wrong !</span>";
              return $msg;
            }
        }
    } //function End

    public function customerLogin($data){
        $email    = $this->fm->validation($data['email']);
        $password = $this->fm->validation($data['password']);

        $email    = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']); //sha1(md5())

        if (empty($email) || empty($password)) {
          $msg = "<span class='error'>Field must not be empty!</span>";
          return $msg;
        }else{

          $query = "SELECT * FROM `tbl_customer` WHERE `email` = '$email' AND `password` = '$password' ";
          $result = $this->db->select($query);
          if ($result) {
            $value = $result->fetch_assoc();
            Session::set("customerLogin", true);
            Session::set("customerId",   $value['id']);
            Session::set("customerName", $value['name']);
            header("location: cart.php"); //login korle cart page e redirect
          }else{
            $msg = "<span class='error'>Email or Password not Matched !</span>";
            return $msg;
          }
        }

    }//function End

    public function getCustomerDataById($id){
       $query = "SELECT * FROM `tbl_customer` WHERE `id` = '$id' ";
       $result = $this->db->select($query);
       return $result;
    }

    public function updateCustomerProfile($data, $id){
        $name     = $this->fm->validation($data['name']);
        $city     = $this->fm->validation($data['city']);
        $zip      = $this->fm->validation($data['zip']);
        $email    = $this->fm->validation($data['email']);
        $address  = $this->fm->validation($data['address']);
        $country  = $this->fm->validation($data['country']);
        $phone    = $this->fm->validation($data['phone']);
        $password = $this->fm->validation($data['password']);

        $name     = mysqli_real_escape_string($this->db->link, $data['name']);
        $city     = mysqli_real_escape_string($this->db->link, $data['city']);
        $zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
        $email    = mysqli_real_escape_string($this->db->link, $data['email']);
        $address  = mysqli_real_escape_string($this->db->link, $data['address']);
        $country  = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']); //sha1(md5())

        if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "" ) {
          $msg = "<span class='error'>Field must not be empty!</span>";
          return $msg;
        }else{
            $query = "UPDATE `tbl_customer` SET
              `name`     = '$name',
              `city`     = '$city',
              `zip`      = '$zip',
              `email`    = '$email',
              `address`  = '$address',
              `country`  = '$country',
              `phone`    = '$phone',
              `password` = '$password'
              WHERE `id` = '$id' ";
            $updated_row = $this->db->update($query);
          if ($updated_row) {
            $msg = "<span class='success'>Profile updated successfully !</span>";
            return $msg;
          }else{
            $msg = "<span class='error'>Profile not updated !</span>";
            return $msg;
          }
        }
    }//function End



} //class End
?>
