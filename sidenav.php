<?php
	include 'dependency.php';
?>


<div id="sideNavBody">
	<img src="Resources/Images/FiestaHomesLogo.png" style="width:80%; display:block; margin:0 auto"  />
	<h6 style="color:white; text-align:center">Fiesta Homes Gate Pass and Announcement System</h6>
	<hr style="margin: 20; border-color:white"/>

	<div style="min-height:300; overflow: auto">
	<ul class="navigationV" style="background:transparent; ">
		<li>
			<a href="dashboard.php"> <i class="fas fa-home"></i> Dashboard</a>
		</li>
		<li>
			<a href="items.php"> <i class="fas fa-tag"></i> Items</a>
		</li>
		<li>
			<a href="employees.php"> <i class="fas fa-user"></i> Accounts</a>
		</li>
		<li>
			<a href="customers.php"> <i class="fas fa-users"></i> Customers</a>
		</li>
		<li>
			<a href="suppliers.php"> <i class="fas fa-truck"></i> Suppliers</a>
		</li>
		<li>
			<a href="purchaseorder.php"> <i class="fas fa-shopping-cart"></i> Purchase Order</a>
		</li>
		<li>
			<a href="inventory.php"> <i class="fas fa-dolly-flatbed"></i> Inventory</a>
		</li>
		<li>
			<a href="maintenance.php"> <i class="fas fa-users-cog"></i> Maintenance</a>
		</li>
		<li>
			<a href="sales.php"> <i class="fas fa-cash-register"></i> Sales</a>
		</li>
		<li>
			<a href="reports.php"> <i class="fas fa-file"></i> Reports</a>
		</li>

	</ul>
	</div>

	<div style="position:relative; bottom:0; height:150; width:250">
		<div style="display:block; width:100%; text-align:center; padding: 27 0; font-weight:bold; color:white">
			<!-- <label><?php echo($_SESSION["UserName"]) ?></label>
			<br/>
			<label><?php echo($_SESSION["UserCompleteName"]) ?></label> -->
		</div>
		<div style="display:block; width:100%; text-align:center;  font-weight:400;">
			<button id="btnLogout" class="btn btn-link" style="margin:auto; font-size:30">Logout</a>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$("#btnLogout").click( function(){
			let url = "API/Accounts/Logout.php";
			$.get(url, function(res){
				window.location.href = "index.php";
			}, 'json');
		});
	});
</script>