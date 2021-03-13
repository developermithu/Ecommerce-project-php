<?php include 'inc/header.php' ;?>

<?php // login kora na thakle
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("location: login.php");
	}
?>
<?php 
		if (isset($_GET['orderId']) && $_GET['orderId'] == 'order') {
			$customerId = Session::get("customerId");
			$order = $cart->orderProduct($customerId);
			$deleteCart = $cart->delCustomerCart(); //after order deleted cart data
			header("location: success.php");
		}
?>

<style>
	.tbltwo{min-height: 100px}
	.tblone, .tbltwo{width:90%; margin: 0 auto; border: 2px solid #ddd}
	.tblone tr td{text-align: justify;}
	.tbltwo tr td{text-align: center;}
	.tblone tr td h2{text-align: center;padding:8px 0;font-weight: bold}
	.tblone tr td a { background: #ddd;padding: 7px 18px;font-size: 18px;color: #333;text-transform:uppercase;border-radius: 3px;}
	.tblone tr td a:hover{cursor: pointer;background: #aaa}
	.division{width: 50%;float: left;}
	.small-tbl{width:50%;float: left;margin-top: 25px;border: 2px solid #ddd;    margin-left: 26px;}
	.small-tbl tr th{text-align: left;padding:6px}
	.small-tbl tr td{text-align: center}
	.order {margin: 0 auto;width: 200px;margin-top: 40px;}
	.order a {background: red;display: block;width: 180px;font-size: 22px;text-align: center;padding: 10px 25px;border-radius: 5px;color: #fff;text-transform: uppercase;}

</style>

<?php 
	$id = Session::get("customerId");
	$getData = $customer->getCustomerDataById($id);
	if ($getData) {
		while ( $result = $getData->fetch_assoc()) { ?>

			 <div class="main">
			    <div class="content">
			    	<div class="section group">

			    		<div class="division">
			    			<table class=" tblone tbltwo">
							<tr>
								<th>No</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
			<?php 
				$getData = $cart->getCartProductById();
				if ($getData) {
					$i = 1;
					$qty = 0;
					$sum = 0;
					while ($cart = $getData->fetch_assoc()) {
						$i++;
	    ?>				
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $cart['productName'] ;?></td>
								<td><?php echo $cart['Price'] ;?></td>
								<td><?php echo $cart['quantity'] ;?></td>
								<td>
									<?php 
										$totalPrice = $cart['Price'] * $cart['quantity'];
										echo '$'.$totalPrice;
								  ?>
								</td>
							</tr>

							<?php 
								$qty = $qty + $cart['quantity'];
								$sum = $sum + $totalPrice;	
								Session::set("sum", $sum);
								Session::set("qty", $qty);
							?>

				<?php } } ?>

						</table>
						<table class="small-tbl">
							<tr>
								<th>Sub Total</th>
								<td>:</td>
								<td>$<?php echo $sum ;?></td> <!--$sum ke GLOBAl korte hobe -->
							</tr>
							<tr>
								<th>VAT</th>
								<td>:</td>
								<td>10% ($<?php echo $vat = $sum * 0.1 ; ?>) </td>
							</tr>
							<tr>
								<th>Grand Total</th>
								<td>:</td>
								<td> 
									<?php
										$vat = $sum * 0.1 ;  
										$grandTotal = $sum + $vat;
										echo '$'.$grandTotal;
									?> 
								</td>
							</tr>
								<tr>
								<th>Quantity</th>
								<td>:</td>
								<td><?php echo $qty ;?></td> <!--$sum ke GLOBAl korte hobe -->
							</tr>
					   </table>
			    		</div>

			    		<div class="division">
			    			<table class="tblone">
			    			<tr>
			    				<td colspan="3"><h2>Your Profile Details</h2></td>
			    			</tr>
			    			<tr>
			    				<td width="20%">Name</td>
			    				<td width="5%">:</td>
			    				<td><?php echo $result['name']; ?></td>
			    			</tr>
			    			<tr>
			    				<td>City</td>
			    				<td>:</td>
			    				<td><?php echo $result['city']; ?></td>
			    			</tr>
			    			<tr>
			    				<td>Zip-Code</td>
			    				<td>:</td>
			    				<td><?php echo $result['zip']; ?></td>
			    			</tr>
			    			<tr>
			    				<td>Email</td>
			    				<td>:</td>
			    				<td><?php echo $result['email']; ?></td>
			    			</tr>
			    			<tr>
			    				<td>Address</td>
			    				<td>:</td>
			    				<td><?php echo $result['address']; ?></td>
			    			</tr>
			    			<tr>
			    				<td>Country</td>
			    				<td>:</td>
			    				<td><?php echo $result['country']; ?></td>
			    			</tr>
			    			<tr>
			    				<td>Phone</td>
			    				<td>:</td>
			    				<td><?php echo $result['phone']; ?></td>
			    			</tr>
			    			<tr>
			    				<td>Password</td>
			    				<td>:</td>
			    				<td><?php echo $result['password']; ?></td>
			    			</tr>
			    			<tr>
			    				<td></td>
			    				<td></td>
			    				<td><a href="edit_profile.php">Update</a></td>
			    			</tr>
			    		</table>
  <?php } }  ?>
			    		</div>

			    		

			 			</div><div class="order"><a href="?orderId=order">Order Now</a></div>
			 		</div>
			</div>

<?php include 'inc/footer.php' ;?>