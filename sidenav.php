<?php
	include 'dependency.php';
?>


<div id="sideNavBody">
	<img src="Resources/Images/FiestaHomesLogo.png" style="width:80%; display:block; margin:10px auto 10px auto"  />
	<h6 style="color:white; text-align:center">Fiesta Homes Gate Pass and Announcement System</h6>
	<hr style="margin: 20; border-color:white"/>

	<div style="min-height:300; overflow: auto">
		<ul class="navigationV" style="background:transparent; ">
			<li>
				<a href="dashboard.php"> <i class="fas fa-home"></i> Dashboard</a>
			</li>
			<li>
				<a href="households.php"> <i class="fas fa-house-user"></i> Households</a>
			</li>
			<li>
				<a href="residents.php"> <i class="fas fa-users"></i> Residents</a>
			</li>
			<li>
				<a href="visitors.php"> <i class="fas fa-users"></i> Visitors</a>
			</li>
			<li>
				<a href="#"> <i class="fas fa-car"></i> Vehicle Registration</a>
			</li>
			<li>
				<a href="maintenance.php"> <i class="fas fa-tools"></i> Maintenance</a>
			</li>
			<li>
				<a href="reports.php"> <i class="fas fa-flag"></i> Reports</a>
			</li>
			<li>
				<a href="announcements.php"> <i class="fas fa-comments"></i> Announcements</a>
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