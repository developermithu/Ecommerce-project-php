<?php include 'inc/header.php' ;?>
<!-- login thakle order page e redirect hobe & logout option asbe -->
<?php 
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("location: login.php");
	}
?>
<?php 
	if (isset($_GET['confirmid'])) {
		$id    = $_GET['confirmid'];
		$price = $_GET['price'];
		$date  = $_GET['date'];
		$confirmed = $cart->confirmProductShifted($id, $price, $date);
	}
 ?>

<style>
	.details {font-size: 26px;font-weight: bold;margin-top: 20px;margin-bottom: 8px;text-align: center;}
</style>


<div class="details">
	<h2>Your Order Details</h2>
</div>
<table class="tblone">
							<tr>
								<th width="5%">No</th>
								<th width="18%">Product Name</th>
								<th width="10%">Image</th>
								<th width="5%">Quantity</th>
								<th width="10%">Price</th>
								<th width="20%">Date</th>
								<th width="8%">Status</th>
								<th width="8%">Action</th>
							</tr>
			<?php 
				$customerId = Session::get("customerId");
				$getOrder = $cart->getOrderdDetails($customerId);
				if ($getOrder) {
					$i = 01;
					while ($order = $getOrder->fetch_assoc()) {
						$i++;
	    ?>				
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $order['productName'] ;?></td>
								<td><img src="admin/<?php echo $order['image'] ;?>" alt=""/></td>
								<td><?php echo $order['quantity'] ;?></td>
								<td><?php echo $order['price'] ;?></td>
								<td><?php echo $fm->formatDate($order['date']) ;?></td>

								<td>
								<?php 
									if ($order['status'] == '0' ) {
										echo "Pending";
									}
									elseif($order['status'] == '1' ){ ?>
										<a href="?confirmid=<?php echo $order['custId'];?>&price=<?php echo $order['price']; ?>&date=<?php echo $order['date']; ?>">Shifted</a>
									
								<?php } else{
										echo "Confirm";
									}
								 ?>
								 </td>

								<td>
									<?php 
										if ($order['status'] == '2') { ?>
											<a onclick="return confirm('Are you sure?')" href="">X</a>
									<?php }else{
										echo "N/A";
									} ?>
								</td>
							</tr>

					<?php } } ?>

						</table>

<?php include 'inc/footer.php' ;?>
