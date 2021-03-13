<?php include 'inc/header.php' ;?>
<!-- login thakle order page e redirect hobe & logout option asbe -->
<?php 
	$login = Session::get("customerLogin");
	if ($login == true) {
		header("location: order.php");
	}
?>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	 	$customerLogin = $customer->customerLogin($_POST);
	 } 

?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
		<?php
			if (isset($customerLogin)) {
			 	echo $customerLogin;
			 } 
		?>
        	<form action="" method="post" >
              <input type="text" name="email" placeholder="Enter your email">
              <input type="password" name="password" placeholder="Enter your password">
               <p class="note"><a href="#">Forget Password? </a></p>
            <div class="buttons">          	
            		<button name="login" class="grey">Login</button>
            </div>
          </form>
           
        </div>

   <?php 
  		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
  		 	$customerRegi = $customer->customerRegistration($_POST);
  		 } 
   ?>                
    	<div class="register_account">
    		<h3>Register New Account</h3>
   <?php 
	   	if (isset($customerRegi)) {
	   		echo $customerRegi;
	   	}
    ?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Your Address">
						</div>
		    		<div>
							<input type="text" name="country" placeholder="Country">
				    </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone Number">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>

    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php' ;?>