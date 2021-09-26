<!DOCTYPE html>
<?php 
    include 'sidenav.php';
?>

<div class="mainContent" >

    <h2 class="page-title"><span class="fas fa-users"> </span> Residents</h2>
    <hr/>

    <div class="row">
        <form id="frmSearch" class="col">
			<div class="form-group row">
				<div class="col-lg-1">
					<label>Search:</label>
				</div>
				<div class="col-lg-6">
					<input type="text" name="txtSearch" class="form-control" placeholder="Name" />
				</div>
				<div class="col-lg-2">
					<button type="submit" class="btn btn-primary">
						<span class="fas fa-search" ></span>
						Search
					</button>
				</div>
				
				<div class="col-lg-2 offset-lg-1">
					<button id="btnNew" type="button" class="btn btn-success" style="float:right">
						<span class="fas fa-plus" ></span>
						New
					</button>
				</div>
			</div>
		</form>
    </div>
    <div class="row">
        <table id="tblList" class="table table-condensed table-striped table-bordered">
			<thead class="thead-dark">
				<th width="auto">Action</th>
				<th>HouseHold</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Birthdate</th>
				<th>Contact No</th>
				<th>Created By</th>
				<th>Created Date Time</th>
				<th>Updated By</th>
				<th>Updated Date Time</th>
			</thead>
			<tbody>
				<!-- <tr>
					<td>
						<button class="btn btn-primary">
							<span class="fas fa-eye" ></span>
							 View
						</button>
						<button class="btn btn-warning">
							<span class="fas fa-edit" ></span>
							 Edit
						</button>
					</td>
					<td>HouseHold</td>
					<td>Resident Name</td>
					<td>Male</td>
					<td>11-23-1998</td>
					<td>09123123</td>
					<td>Dev</td>
					<td>11-23-1998</td>
					<td></td>
					<td></td>
				</tr> -->
			</tbody>
		</table>
    </div>
	<div class="row">
        <div class="m-3">
            <label>Result Count : </label>
            <label id="lblResultCount"> 0</label>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="mdlNewResident" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Create New Resident</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="frmNewResident">
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>First Name:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="txtFirstName" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>Middle Name:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="txtMiddleName" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>Last Name:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="txtLastName" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>Suffix:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="txtSuffix" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>Birthdate:</label>
							</div>
							<div class="col-lg-10">
								<input type="date" name="txtBirthdate" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group m-3">
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
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>Contact No:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="txtContactNo" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>Email Address:</label>
							</div>
							<div class="col-lg-10">
								<input type="email" name="txtEmailAddress" class="form-control" />
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" form="frmNewResident" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
  </div>
<!-- End of Modals -->

<script defer="true">
    $(document).ready( function(){
		setTimeout( function(){
			$("#frmSearch").trigger('submit');
			$("#mdlNewResident").modal('show');
		}, 500);

		//-----------------------------

		$("#frmNewResident").submit( function(event){
			event.preventDefault();
			let frmData = $(this).serialize();
			let url = "API/Residents/CreateNewResident.php";
			$.post(url, frmData, function(res){
				if(res.result){
					msgPopUp("Saved!",  "New resident record has been successfully saved.", "success");
				}
				else{
					msgPopUp("Error!",  "Failed to save new resident record.", "warning");
				}
			}, 'json')
			.fail( function(xhr, status, message){
				msgPopUp("Error has occured", message, "danger");
			});
		})

		$("#frmSearch").submit( function(event){
			event.preventDefault();
			let frm = $(this).serialize();
			let url = "API/Residents/SearchResidents.php";
			$.post(url, frm, function(res){
				let $tbl = $("#tblList tbody");
				$tbl.html("");
				$("#lblResultCount").html(res.length);
				
				$.each(res, function(index, value){
					$tbl.append(
						`
						<tr>
							<td>
								<button class="btn btn-primary">
									<span class="fas fa-eye" ></span>
									View
								</button>
								<button class="btn btn-warning">
									<span class="fas fa-edit" ></span>
									Edit
								</button>
							</td>
							<td>`+ (value.HouseHold == undefined ? '' : value.HouseHold) +`</td>
							<td>`+ value.ResidentName +`</td>
							<td>`+ value.Gender +`</td>
							<td>`+ value.BirthDate+`</td>
							<td>`+ value.ContactNo +`</td>
							<td>` + value.CreatedBy + `</td>
							<td>` + value.CreatedDateTime + `</td>
							<td>` + (value.UpdatedBy == undefined ? '' : value.UpdatedBy) + `</td>
							<td>` + (value.UpdatedDateTime == undefined ? '' : value.UpdatedDateTime) + `</td>
						</tr>
						`
					);
				});
			}, 'json')
			.fail( function(xhr, status, message){
				msgPopUp("Error has occured", message, "danger");
			});
		});

	});
</script>

</html>