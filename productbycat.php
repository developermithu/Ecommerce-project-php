<?php include 'inc/header.php' ;?>

<?php
if (!isset($_GET['catid']) || $_GET['catid'] == 'NULL') {
        echo '<script> window.location = "404.php"; </script>';
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
    }
  ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Iphone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	<?php 
		$productByCat = $pd->productByCatId($id);
		if ($productByCat) {
			while ($product = $productByCat->fetch_assoc()) {
	?>

				<div class="grid_1_of_4 images_1_of_4">

					  <a href="details.php?productId=<?php echo $product['productId'] ;?>">
					 	<img src="admin/<?php echo $product['image'] ;?>" alt="" /></a>

					 <h2><?php echo $product['productName'] ;?></h2>
					 <p><?php echo $fm->textShorten($product['body'], 50) ;?></p>
					 <p><span class="price">$<?php echo $product['Price'] ;?></span></p>

				     <div class="button"><span><a href="details.php?productId=<?php echo $product['productId'] ?>" class="details">Details</a></span></div>
				</div>

	<?php } }else{
		header("location:404.php");
		// echo "Products are not available on this category !";
	} ?>	

			</div>
	
	
    </div>
 </div>

<?php include 'inc/footer.php' ;?>