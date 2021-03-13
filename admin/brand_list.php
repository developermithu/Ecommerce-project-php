<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php 
    $brand = new Brand();

    if (isset($_GET['brandId'])) {
    	// $id = $_GET['brandId'];
    	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandId']);
    	$deleteBrand = $brand->delBrandById($id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block"> 
         <?php 
         	if (isset($deleteBrand)) {
         		echo $deleteBrand;
         	}
          ?>              
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
			<?php 
				$getAllBrand = $brand->brandSelect();
				if ($getAllBrand) {
					$i = 0;
					while ($brand = $getAllBrand->fetch_assoc()) { 
						$i++;
			  ?>
							<td><?php echo $i ;?></td>
							<td><?php echo $brand['brandName'] ?></td>
							<td><a href="brand_edit.php?brandId=<?php echo $brand['brandId'] ?>">Edit</a> ||
							 <a onclick="return confirm('Are you sure to delete?')" href="?brandId=<?php echo $brand['brandId'] ?>">Delete</a></td>
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

