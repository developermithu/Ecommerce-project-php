
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">

		<?php 
			$getIphone = $pd->latestFromIphone();
			if ($getIphone) {
				while ($product = $getIphone->fetch_assoc()) {
		?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $product['productId'] ?>"> <img src="admin/<?php echo $product['image'] ;?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $product['productName'] ?></p>
						<div class="button"><span><a href="details.php?productId=<?php echo $product['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
	 <?php } } ?>		

		<?php 
			$getAcer = $pd->latestFromAcer();
			if ($getAcer) {
				while ($product = $getAcer->fetch_assoc()) {
		?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $product['productId'] ?>"> <img src="admin/<?php echo $product['image'] ;?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $product['productName'] ?></p>
						<div class="button"><span><a href="details.php?productId=<?php echo $product['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
	 <?php } } ?>	
			</div>

			<div class="section group">
	<?php 
		$getSamsung = $pd->latestFromSamsung();
		if ($getSamsung) {
			while ($product = $getSamsung->fetch_assoc()) {
	?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $product['productId'] ?>"> <img src="admin/<?php echo $product['image'] ;?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Samsung</h2>
						<p><?php echo $product['productName'] ?></p>
						<div class="button"><span><a href="details.php?productId=<?php echo $product['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
	 <?php } } ?>	
			
	<?php 
		$getCanon = $pd->latestFromCanon();
		if ($getCanon) {
			while ($product = $getCanon->fetch_assoc()) {
	?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $product['productId'] ?>"> <img src="admin/<?php echo $product['image'] ;?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $product['productName'] ?></p>
						<div class="button"><span><a href="details.php?productId=<?php echo $product['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
	 <?php } } ?>	

			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	
