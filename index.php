<?php include 'inc/header.php' ;?>
<?php include 'inc/slider.php' ;?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Featured </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	     <?php
	     	$getData = $pd->getFeaturedProduct();
	     	if ($getData) {
	     		while ($product = $getData->fetch_assoc()) { ?>

				<div class="grid_1_of_4 images_1_of_4">

					 <a href="details.php?productId=<?php echo $product['productId'] ;?>">
					 	<img src="admin/<?php echo $product['image'] ;?>" alt="" /></a>

					 <h2><?php echo $product['productName'] ;?></h2>
					 <p><?php echo $fm->textShorten($product['body'], 50) ;?></p>
					 <p><span class="price">$<?php echo $product['Price'] ;?></span></p>

				     <div class="button"><span><a href="details.php?productId=<?php echo $product['productId'] ?>" class="details">Details</a></span></div>
				</div>
		<?php } } ?>
			</div>

			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

    <?php
	     	$getData = $pd->getNewProduct();
	     	if ($getData) {
	     		while ($product = $getData->fetch_assoc()) { ?>

				<div class="grid_1_of_4 images_1_of_4">

					  <a href="details.php?productId=<?php echo $product['productId'] ;?>">
					 	<img src="admin/<?php echo $product['image'] ;?>" alt="" /></a>

					 <h2><?php echo $product['productName'] ?> </h2>
					 <p><span class="price">$ <?php echo $product['Price'] ?></span></p>

				   <div class="button"><span><a href="details.php?productId=<?php echo $product['productId'] ?>" class="details">Details</a></span></div>
				</div>

		<?php } } ?>
			</div>
    </div>
 </div>

<?php include 'inc/footer.php' ;?>
