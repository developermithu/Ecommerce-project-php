<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php 
    $cat = new Category();

    if (isset($_GET['catId'])) {
    	// $id = $_GET['catId'];
    	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
    	$deleteCat = $cat->delCatById($id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block"> 
         <?php 
         	if (isset($deleteCat)) {
         		echo $deleteCat;
         	}
          ?>              
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
			<?php 
				$getAllCat = $cat->catSelect();
				if ($getAllCat) {
					$i = 0;
					while ($category = $getAllCat->fetch_assoc()) { 
						$i++;
			  ?>
							<td><?php echo $i ;?></td>
							<td><?php echo $category['catName'] ?></td>
							<td><a href="catedit.php?catId=<?php echo $category['catId'] ?>">Edit</a> ||
							 <a onclick="return confirm('Are you sure to delete?')" href="?catId=<?php echo $category['catId'] ?>">Delete</a></td>
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

