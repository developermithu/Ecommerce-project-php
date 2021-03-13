<?php include 'inc/header.php' ;?>

<?php // login kora na thakle
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("location: login.php");
	}
?>

<style>
	.tblone{width:50%; margin: 0 auto; border: 2px solid #ddd}
	.tblone tr td{text-align: justify;}
	.tblone tr td h2{text-align: center;padding:8px 0;font-weight: bold}
	.tblone input[type=text]{ padding: 5px; width: 250px}
	.tblone input[type=submit]{font-size: 22px !important;padding: 5px 18px !important;}
</style>

<?php //update data
		$id = Session::get("customerId");
		if (isset($_POST['submit'])) {
			$updateData = $customer->updateCustomerProfile($_POST, $id);
		}
?>

<?php //update er niche eta likle update value o show korbe
	$id = Session::get("customerId");
	$getData = $customer->getCustomerDataById($id);
	if ($getData) {
		while ( $result = $getData->fetch_assoc()) { ?>

			 <div class="main">
			    <div class="content">
			    	<div class="section group">
			    		<form action="" method="post">
			    		<table class="tblone">
		 						<?php 
		 							if (isset($updateData)){
		 								echo '<tr><td colspan="3"><h2>' .$updateData. '</h2></td></tr>' ;
		 							} ?>
			    			<tr>
			    				<td colspan="3"><h2>Update Your Profile </h2></td>
			    			</tr>
			    			<tr>
			    				<td width="20%">Name</td>
			    				<td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
			    			</tr>
			    			<tr>
			    				<td>City</td>
			    				<td><input type="text" name="city" value="<?php echo $result['city']; ?>"></td>
			    			</tr>
			    			<tr>
			    				<td>Zip-Code</td>
			    				<td><input type="text" name="zip" value="<?php echo $result['zip']; ?>"></td>
			    			</tr>
			    			<tr>
			    				<td>Email</td>
			    				<td><input type="text" name="email" value="<?php echo $result['email']; ?>"></td>
			    			</tr>
			    			<tr>
			    				<td>Address</td>
			    				<td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
			    			</tr>
			    			<tr>
			    				<td>Country</td>
			    				<td><input type="text" name="country" value="<?php echo $result['country']; ?>"></td>
			    			</tr>
			    			<tr>
			    				<td>Phone</td>
			    				<td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
			    			</tr>
			    			<tr>
			    				<td>Password</td>
			    				<td><input type="text" name="password" value="<?php echo $result['password']; ?>"></td>
			    			</tr>
			    			<tr>
			    				<td></td>
			    				<td><input type="submit" name="submit" value="Save"></td>
			    			</tr>
			    		</table>
			    	</form>
  <?php } }  ?>

 		</div>
 	</div>
	</div>

<?php include 'inc/footer.php' ;?>