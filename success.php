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
.payment p {font-size: 18px;text-transform: capitalize;line-height: 1.6;text-align: justify;}
.payment p span{font-weight: bold}
</style>

		<div class="main">
			<div class="content">
			  <div class="section group">
			    <div class="payment">
			    	<h2>Success</h2>
			    	<?php  
			    				$customerId = Session::get("customerId");
			    				$amount = $cart->payableAmount($customerId);
			    				if ($amount) {
			    					$sum = 0;
			    					while ($order = $amount->fetch_assoc()) {
			    						$price = $order['price'];
			    						$sum = $sum + $price;
			    					}
			    				}
			    			?>
			    	<p>Total Payable Amount ( Including Vat ) : 
			    		<span>
			    			<?php 
			    				// global $sum;
			    				$vat = $sum * 0.1;
			    				$total = $sum + $vat;
			    				echo '$'.$total;
			    			?>
			    		</span> </p>
			    	<p>Thanks for Purchase. Receive your order successfully. We will contact you ASAP with delivery details. Here is your order details... <a href="order_details.php">Visite Here</a></p>
			    </div>
		 		</div>
		 	</div>
		</div>

<?php include 'inc/footer.php' ;?>