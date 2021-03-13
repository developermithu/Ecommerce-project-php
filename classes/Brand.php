<?php
  $filePath = realpath(dirname(__FILE__));
  include_once ($filePath.'/../lib/Database.php') ;
  include_once ($filePath.'/../helpers/Format.php') ;
?>

<?php 
  class Brand{
    private $db;
    private $fm;

    public function __construct(){
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function brandInsert($brandName){
      $brandName = $this->fm->validation($brandName);
      $brandName = mysqli_real_escape_string($this->db->link, $brandName);

      if ($brandName == "") {
        $msg = "<span class='error'>Field must not be empty!</span>";
        return $msg;
      }
      else{
        $query = "INSERT INTO `tbl_brand` (`brandName`) VALUES('$brandName')";
        $result = $this->db->insert($query);
        if ($result) {
            $msg = "<span class='success'>Brand inserted successfully!</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Brand not inserted!</span>";
            return $msg;
        }
      }
  }

  public function brandSelect(){
    $query = "SELECT * FROM `tbl_brand` ORDER BY `brandId` DESC ";
    $selected_row = $this->db->select($query);
    return $selected_row;
  }

  public function getBrandById($id){  //get value
    $query = "SELECT * FROM `tbl_brand` WHERE `brandId` = '$id' ";
    $selected_row = $this->db->select($query);
    return $selected_row;
  }

  public function brandUpdate($brandName, $id){
     $brandName = $this->fm->validation($brandName);
     $brandName = mysqli_real_escape_string($this->db->link, $brandName);
     $id        = mysqli_real_escape_string($this->db->link, $id);

      if ($brandName == "") {
        $msg = "<span class='error'>Field must not be empty!</span>";
        return $msg;
      }
      else{
        $query = "UPDATE `tbl_brand` SET `brandName` = '$brandName' WHERE `brandId` = '$id' ";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Brand updated successfully!</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Brand not updated!</span>";
            return $msg;
        }
      }
    
  }

  public function delBrandById($id){
        $query = "DELETE FROM `tbl_brand` WHERE `brandId` = '$id' ";
        $deleteData = $this->db->delete($query);
        if ($deleteData) {
            $msg = "<span class='error'>Brand deleted successfully!</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Brand not deleted!</span>";
            return $msg;
        }
  }


}
?>