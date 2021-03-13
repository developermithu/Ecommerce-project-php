<?php include 'inc/header.php' ;?>

<?php // login kora na thakle
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("location: login.php");
	}
?>

<style>
.payment{width: 500px; margin: 0 auto;border:2px solid #ddd;text-align: center;padding:50px;min-height: 160px;margin-bottom: 20px;background:#f1f1f1}
.payment h2 {padding-bottom: 8px;border-bottom: 2px solid #bbb;margin-bottom: 65px;font-weight: bold;
    font-size: 35px;}
.payment a {background: tomato;color: #fff;padding: 10px 25px;border-radius: 3px;font-size: 20px;}
.back a {width: 150px;margin: 0 auto;display: block;background: #555;color: #fff;padding: 6px 20px;text-align:center;font-size: 25px;border-radius: 3px;}
</style>

		<div class="main">
			<div class="content">
			  <div class="section group">
			    <div class="payment">
			    	<h2>Choose Payment Option</h2>
			    	<a href="offline_payment.php">Offline Payment</a>
			    	<a href="online_payment.php">Online Payment</a>
			    </div>	
			    <div class="back"><a href="cart.php">Previous</a></div>	
		 		</div>
		 	</div>
		</div>

<?php include 'inc/footer.php' ;?>