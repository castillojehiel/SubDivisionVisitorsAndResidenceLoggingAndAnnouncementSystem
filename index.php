<?php
    require 'dependency.php';
?>

<style>
#mainCard{
	width:500;
	height: auto;
	top:2vh;
	margin: auto;
	background : rgba(255,255,255,0.7);
	display:block;
	padding:20;
	text-align:center;
}
</style>

<body style="background:url('Resources/Images/bg1.jpg'); background-size:cover">
	<div class="card" id="mainCard" >
		<img src="Resources/Images/FiestaHomesLogo.png" style="width:50%; margin:0 auto; display:block"/>
		<h2>Fiesta Homes Gate Pass and Announcement System</h2>
		<hr>
		<form id="frmLogin" style="width:80%; margin:auto" >
			<div class="mb-3">
				<label for="" style="float:left">Username:</label>
				<input type="text" class="form-control" name="txtUsername" required value="dev" >
			</div>
			<div class="mb-3">
				<label for="" style="float:left">Password:</label>
				<input type="password" class="form-control" name="txtPassword" required value="dev" >
			</div>
            <div class="mb-3">
                <button class="btn btn-secondary">
                    <span class="fas fa-login"></span>
                    Login
                </button>
			</div>
			
		</form>
		
		
	</div>
</body>

<div class=" modal fade" id="mdlNewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Create New User</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form id="frmNewUser">
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-10">
							<span>It seems like it is the first time you boot the system. Please create first user.</span>
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>First Name:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" name="txtFirstName" class="form-control" />
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>Middle Name:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" name="txtMiddleName" class="form-control" />
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>Last Name:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" name="txtLastName" class="form-control" />
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>Gender:</label>
						</div>
						<div class="col-lg-10">
							<div style ="display:inline-block">
								<input type="radio" name="txtGender" value="Male" />
								<label>Male</label>
								<input type="radio" name="txtGender" value="Female" />
								<label>Female</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>Birthdate:</label>
						</div>
						<div class="col-lg-10">
							<input type="date" name="txtBirthdate" class="form-control" />
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>Contact No:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" name="txtContactNo" class="form-control" />
						</div>
					</div>
				</div>
				
				<hr>

				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>Account Type:</label>
						</div>
						<div class="col-lg-10">
							<select name="cboType" class="form-control" >
								<option value="ADMIN">ADMIN</option>
								<option value="CASHIER">CASHIER</option>
								<option value="INVENTORY STAFF">INVENTORY STAFF</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>Username:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" name="txtUsername" class="form-control" />
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-lg-2">
							<label>Password:</label>
						</div>
						<div class="col-lg-10">
							<input type="password" name="txtPassword" class="form-control" />
						</div>
					</div>
				</div>
			</form>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button form="frmNewUser" type="submit" class="btn btn-primary">Save changes</button>
		</div>
		</div>
	</div>
</div>
