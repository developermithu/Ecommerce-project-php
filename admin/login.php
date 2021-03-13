<?php include '../classes/AdminLogin.php' ?>
<?php 
	$al = new AdminLogin();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$adminUser = $_POST['adminUser'];
		$adminPass = md5($_POST['adminPass']);

		$loginCheck = $al->adminLogin($adminUser, $adminPass);
	}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

		<form action="" method="post">
			<h1>Admin Login</h1>
			<?php 
				if (isset($loginCheck)) {
					echo "<h4 style='color:red;padding-bottom:6px;'> $loginCheck</h4>";
				}
			?>
			<div>
				<input type="text" placeholder="Username..."  name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password..."  name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->


		<div class="button">
			<a href="#">Full-Stack Developer Mithu</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>