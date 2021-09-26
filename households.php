<!DOCTYPE html>
<?php 
    include 'sidenav.php';
?>

<div class="mainContent" >

    <h2 class="page-title"><span class="fas fa-house-user"> </span> Households</h2>
    <hr/>

    <div class="row">
        <form id="frmSearch" class="col">
			<div class="form-group row">
				<div class="col-lg-1">
					<label>Search:</label>
				</div>
				<div class="col-lg-6">
					<input type="text" name="txtSearch" class="form-control" required placeholder="Name" />
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
				<th>Description</th>
				<th>HouseNo</th>
				<th>Block</th>
				<th>Street</th>
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

</html>