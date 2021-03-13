<?php include 'inc/header.php' ;?>
<?php
if (!isset($_GET['productId']) || $_GET['productId'] == 'NULL') {
        echo '<script> window.location = "404.php"; </script>';
    }else{
        // $id = $_GET['productId'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productId']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	$quantity = $_POST['quantity'];
    	$addCart  = $cart->addToCart($quantity, $id);
	}
	
 ?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">		
	<?php 
		$getData = $pd->getSingleProductById($id);
		if ($getData) {
			while ($multiResult = $getData->fetch_assoc()) { ?>

					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $multiResult['image']?>" alt="" />
					</div>

				<div class="desc span_3_of_2">
					<h2>Lorem Ipsum is simply dummy text </h2>
										
					<div class="price">
						<p>Price: <span>$<?php echo $multiResult['Price']?></span></p>
						<p>Category: <span><?php echo $multiResult['catName']?></span></p>
						<p>Brand:<span><?php echo $multiResult['brandName']?></span></p>
					</div>

				<div class="add-cart">
					<form action="#" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>
				</div>
		<h3 style="color:red;margin-top:10px !important;">
			<?php 
				if (isset($addCart)) {
					echo $addCart;
				}
		  ?>
		</h3>		
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
				<?php echo $multiResult['body']?>
	    </div>
<?php } } ?>		

	</div>

			<!-- Category List -->
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php 
							$getCat = $cat->catSelect();
							if ($getCat) {
								while ($category = $getCat->fetch_assoc()) {
						?>

				      <li><a href="productbycat.php?catid=<?php echo $category['catId'] ;?>"><?php echo $category['catName'] ;?></a></li>

				 <?php } } ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>

<?php include 'inc/footer.php' ;?>