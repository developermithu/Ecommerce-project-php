<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php 
    $brand = new Brand();

    if (!isset($_GET['brandId']) || $_GET['brandId'] == 'NULL') {
        echo '<script> window.location = "brand_list.php"; </script>';
    }else{
        // $id = $_GET['brandId'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandId']);
    }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $brandUpdate = $brand->brandUpdate($brandName, $id);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 
    <?php //not msg name
        if (isset($brandUpdate)) {
            echo $brandUpdate;
        }                       
    ?>   

    <?php 
        $result = $brand->getBrandById($id);
        if ($result) {
            while ($category = $result->fetch_assoc()) { ?>            
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $category['brandName'] ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>