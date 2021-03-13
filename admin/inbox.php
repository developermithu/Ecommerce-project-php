<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filePath = realpath(dirname(__FILE__));
	include_once($filePath."/../classes/Cart.php");
	include_once($filePath."/../helpers/Format.php");
	$cart = new Cart();
	$fm 	= new Format();
?>
<?php 
	if (isset($_GET['shiftid'])) {
		$id    = $_GET['shiftid'];
		$price = $_GET['price'];
		$date  = $_GET['date'];
		$shifted = $cart->productShifted($id, $price, $date);
	}
 ?>
 <?php //for delete shifted product from admin panel
	if (isset($_GET['delProId'])) {
		$id    = $_GET['delProId'];
		$price = $_GET['price'];
		$date  = $_GET['date'];
		$delShiftedProduct = $cart->deleteShiftedProduct($id, $price, $date);
	}
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
            <?php 
            	if (isset($shifted)) {
            		echo $shifted;
            	}
            	if (isset($delShiftedProduct)) {
            		echo $delShiftedProduct;
            	}

             ?>
                <div class="block">        
         <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					$orderData = $cart->getAllOrderProduct();
					if ($orderData) {
						while ($order = $orderData->fetch_assoc()) {
				 ?>
						<tr class="odd gradeX">
							<td><?php echo $order['productId']; ?></td>
							<td><?php echo $fm->formatDate($order['date']); ?></td>
							<td><?php echo $order['productName']; ?></td>
							<td><?php echo $order['quantity']; ?></td>
							<td><?php echo $order['price']; ?></td>
							<td><a href="customer.php?custId=<?php echo $order['custId']; ?>">View Details</a></td>

							
								<?php
								 if ($order['status'] == '0') { ?>
									<td><a href="?shiftid=<?php echo $order['custId'];?>&price=<?php echo $order['price']; ?>&date=<?php echo $order['date']; ?>">Shifted</a></td>

							<?php }elseif ($order['status'] == '1') { ?>
								<td>Pending</td>
							
							<?php  } else{ ?>
									<td><a href="?delProId=<?php echo $order['custId'];?>&price=<?php echo $order['price']; ?>&date=<?php echo $order['date']; ?>">Remove</a></td>
							<?php } ?>
								
							
						</tr>

				<?php } } ?>		
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
