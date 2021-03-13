<?php include 'inc/header.php' ;?>
<?php 
	if (isset($_GET['delCart'])) {
		$delCart = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delCart']);
		$deleteCart = $cart->deleteCartById($delCart);
	}
?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cartId   = $_POST['catId'];  //catId database mistake
		$quantity = $_POST['quantity'];
		$updateQuantity = $cart->updateCartQuantity($cartId, $quantity);

		if ($quantity <= 0 ) {
			$deleteCart = $cart->deleteCartById($cartId);
		}
	}
?>
<?php // for page refresh
	if (!isset($_GET['id'])) {
		echo '<meta http-equiv="refresh" content="0;URL=?id=mithu">';
	}
 ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			<?php 
				if (isset($updateQuantity)) {
					echo $updateQuantity;
				}
		  ?>
		  <?php 
				if (isset($deleteCart)) {
					echo $deleteCart;
				}
		  ?>
						<table class="tblone">
							<tr>
								<th width="5%">Sl</th>
								<th width="25%">Product Name</th>
								<th width="10%">Image</th>
								<th width="10%">Price</th>
								<th width="25%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
			<?php 
				$getData = $cart->getCartProductById();
				if ($getData) {
					$i = 01;
					$qty = 0;
					$sum = 0;
					while ($cart = $getData->fetch_assoc()) {
						$i++;
	    ?>				
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $cart['productName'] ;?></td>
								<td><img src="admin/<?php echo $cart['image'] ;?>" alt=""/></td>
								<td><?php echo $cart['Price'] ;?></td>
								<td>
									<form action="#" method="post">
										<input type="hidden" name="catId" value="<?php echo $cart['catId'] ;?>"/>
										<input type="number" name="quantity" value="<?php echo $cart['quantity'] ;?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									<?php 
										$totalPrice = $cart['Price'] * $cart['quantity'];
										echo $totalPrice;
								  ?>
								</td>
								<td><a onclick="return confirm('Are you sure?')" href="?delCart=<?php echo $cart['catId'] ;?>">X</a></td>
							</tr>

							<?php 
								$qty = $qty + $cart['quantity'];
								$sum = $sum + $totalPrice;	
								Session::set("sum", $sum);
								Session::set("qty", $qty);
							?>

				<?php } } ?>

						</table>
		<?php  
			$checkCart = $cart->checkCartTable();
			if ($checkCart) {
		?> 
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum ;?></td> <!--$sum ke GLOBAl korte hobe -->
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td> 
									<?php
										$vat = $sum * 0.1 ;  
										$grandTotal = $sum + $vat;
										echo $grandTotal;
									?> 
								</td>
							</tr>
					   </table>

				 <?php }else{
					 	header("location:index.php");
					 	// echo "Cart Empty! Please Shop Now.";
					 } ?> 

					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php include 'inc/footer.php' ;?>
