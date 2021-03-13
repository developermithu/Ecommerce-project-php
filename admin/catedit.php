<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php 
    $cat = new Category();

    if (!isset($_GET['catId']) || $_GET['catId'] == 'NULL') {
        echo '<script> window.location = "catlist.php"; </script>';
    }else{
        // $id = $_GET['catId'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
    }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $catUpdate = $cat->catUpdate($catName, $id);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
    <?php //not msg name
        if (isset($catUpdate)) {
         echo $catUpdate;
        }                       
    ?>   

    <?php 
        $result = $cat->getCatById($id);
        if ($result) {
            while ($category = $result->fetch_assoc()) { ?>            
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $category['catName'] ?>" class="medium" />
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