<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php' ;?>
<?php include_once '../helpers/Format.php' ; ?>
<?php 
	$pd = new Product();
	$fm = new Format();

	if (isset($_GET['productId'])) {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productId']);
    	$deleteProduct = $pd->delProductById($id);
    }
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block"> 
	<?php 
	if (isset($deleteProduct)) {
	 	echo $deleteProduct;
	 } ?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL.</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Body</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

		<?php 
			$getData = $pd->getAllProduct();
			if ($getData) {
				$i=0;
				while ($product = $getData->fetch_assoc()) {
					$i++;
		?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $product['productName'] ;?></td>
					<td><?php echo $product['catName'] ;?></td>
					<td><?php echo $product['brandName'] ;?></td>
					<td><?php echo $fm->textShorten($product['body'],35) ;?></td>
					<td>$<?php echo $product['Price'] ;?></td>
					<td><img src="<?php echo $product['image'] ;?>" height="40px" width="60px"></td>
					<td>
					<?php 
						if ($product['type'] == 1) {
							echo 'Featured';
						}else{
							echo 'Non-Featured';
						}
					 ?>							
					</td>
					<td><a href="product_edit.php?productId=<?php echo $product['productId'] ?>">Edit</a> || 
					<a onclick="return confirm('Are you sure?')" href="?productId=<?php echo $product['productId'] ?>">Delete</a></td>
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
