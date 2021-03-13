<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filePath = realpath(dirname(__FILE__));
    include_once($filePath."/../classes/Customer.php");
?>

<?php 
    if (!isset($_GET['custId']) || $_GET['custId'] == 'NULL') {
        echo '<script> window.location = "inbox.php"; </script>';
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
    }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo '<script> window.location = "inbox.php"; </script>';
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Address</h2>
               <div class="block copyblock"> 

    <?php 
        $customer = new Customer();
        $result = $customer->getCustomerDataById($id);
        if ($result) {
            while ($customer = $result->fetch_assoc()) { ?>   

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" value="<?php echo $customer['name'] ?>" class="medium" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input type="text" value="<?php echo $customer['city'] ?>" class="medium" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" value="<?php echo $customer['address'] ?>" class="medium" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" value="<?php echo $customer['email'] ?>" class="medium" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip-Code</td>
                            <td>
                                <input type="text" value="<?php echo $customer['zip'] ?>" class="medium" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input type="text" value="<?php echo $customer['phone'] ?>" class="medium" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                                <input type="text" value="<?php echo $customer['country'] ?>" class="medium" readonly />
                            </td>
                        </tr>
						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>