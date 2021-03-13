<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php' ;?>
<?php include '../classes/Category.php' ;?>
<?php include '../classes/Product.php' ;?>
<?php 
    $pd = new Product();

    if (!isset($_GET['productId']) || $_GET['productId'] == 'NULL') {
        echo '<script> window.location = "product_list.php"; </script>';
    }else{
        // $id = $_GET['productId'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productId']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  //as many file
    $updateProduct = $pd->updateProduct($_POST, $_FILES, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">   
    <?php 
        if (isset($updateProduct)) {
            echo $updateProduct;
        }
     ?>

    <?php 
        $getData = $pd->getAllProductById($id);
        if ($getData) {
            while ($product = $getData->fetch_assoc()) { ?>
            
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $product['productName'] ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
            <?php 
                $cat = new Category();
                $getData = $cat->catSelect();
                if ($getData) {
                    while ($category = $getData->fetch_assoc()) { ?>

                        <option     
                            <?php 
                            if ($product['catId'] == $category['catId']){ ?> 
                                    selected=""
                            <?php } ?>                  
                         value="<?php echo $category['catId'] ?>">
                          <?php echo $category['catName'] ?>                             
                         </option>  

            <?php } } ?>          
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
         
            <?php 
                $brand = new Brand();
                $getData = $brand->brandSelect();
                if ($getData) {
                    while ($brand = $getData->fetch_assoc()) { ?>

                        <option
                        <?php 
                        if ($product['brandId'] == $category['brandId']){ ?>
                                  selected=""
                         <?php  } ?>  
                         value="<?php echo $brand['brandId'] ;?>">
                         <?php echo $brand['brandName'] ;?>                             
                         </option>
                        
            <?php } } ?>            
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $product['body'] ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $product['Price'] ?>" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $product['image'] ;?>" height="80px" width="200px">
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php 
                                if ($product['type'] == 1) { ?>
                                    <option value="1" selected="">Featured</option>
                                    <option value="2">Non-Featured</option>
                                
                             <?php }else{ ?>
                                    <option value="1">Featured</option>
                                    <option value="2" selected="">Non-Featured</option>
                          <?php  } ?>
                            
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
<?php  } } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


