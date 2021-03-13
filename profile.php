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
	.tblone tr td a { background: #ddd;padding: 7px 18px;font-size: 18px;color: #333;text-transform:uppercase;border-radius: 3px;}
	.tblone tr td a:hover{cursor: pointer;background: #aaa}
</style>

<?php 
	$id = Session::get("customerId");
	$getData = $customer->getCustomerDataById($id);
	if ($getData) {
		while ( $result = $getData->fetch_assoc()) { ?>

			 <div class="main">
			    <div class="content">
			    	<div class="section group">
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
		 			</div>
			</div>

<?php include 'inc/footer.php' ;?>