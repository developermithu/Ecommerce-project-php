<?php
 $filePath = realpath(dirname(__FILE__));
 include ($filePath.'/../lib/Session.php') ;
  Session::checkLogin();

  include_once ($filePath.'/../lib/Database.php') ;
  include_once ($filePath.'/../helpers/Format.php') ;

?>

<?php 
  class AdminLogin{
    private $db;
    private $fm;

    public function __construct(){
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function adminLogin($adminUser, $adminPass){
      $adminUser = $this->fm->validation($adminUser);
      $adminPass = $this->fm->validation($adminPass);

      $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
      $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

      if ($adminUser == "" || $adminPass == "") {
        $errorMsg = "Username or Password must not be empty!";
        return $errorMsg;
      }else {

        $query = "SELECT * FROM `tbl_admin` WHERE  `adminUser` = '$adminUser' AND  `adminPass` = '$adminPass' ";
        $result = $this->db->select($query);
        if ($result == true) {
          $value = $result->fetch_assoc();
          Session::set("adminLogin", true);
          Session::set("adminId", $value['adminId']);
          Session::set("adminUser", $value['adminUser']);
          Session::set("adminName", $value['adminName']);
          header("location: index.php");
        }else {
          $errorMsg = "Username or Password not matched!";
          return $errorMsg;
        }
      }
    }
    
  }
?>