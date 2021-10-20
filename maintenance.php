<!DOCTYPE html>
<?php 
    include 'sidenav.php';
?>

<div class="mainContent">
	<h2 class="page-title"><i class="fas fa-users-cog"></i> Maintenance</h2>
	<hr/>

	<div class="row">
		<div class="col-2">
			<ul class="nav flex-column">
				<li class="nav-item maintenanceItem" id="maintenanceReportTypes">
					<a class="nav-link active " href="#">Report Types</a>
				</li>
				
			</ul>
		</div>
		<div class="col-10" id="maintenanceContent">
		</div>
	</div>

</div>

<!-- Report Type modals -->
<div class="modal fade" id="mdlNewReportType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">New Report Type</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="frmNewReportType">
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>Description:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="txtDescription" class="form-control" />
								<input type="hidden" name="txtID" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-10 offset-2">
								<input type="checkbox" name="chkIsActive" checked="checked" />
								<label>is Active</label>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" form="frmNewReportType" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="mdlEditReportType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">New Report Type</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="frmEditReportType">
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-2">
								<label>Description:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="txtDescription" class="form-control" />
								<input type="hidden" name="txtID" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group m-3">
						<div class="row">
							<div class="col-lg-10 offset-2">
								<input type="checkbox" name="chkIsActive" />
								<label>is Active</label>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" form="frmEditReportType" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<!-- End of Report Type modals -->

<script defer="true">
$(document).ready(function(){
    $(".maintenanceItem").click( function(){
        let ID = $(this).prop("id");
        SetMaintenanceContent(ID);
    });

    function SetMaintenanceContent(id){
        let url = "";
        switch(id){
            case "maintenanceReportTypes" :
                url = "maintenance_reporttype.php";
                break;
            default :
                url = "";
        }

        $.get(url, function(res){
            $("#maintenanceContent").html(res);
        })

    }

    
})
</script>

</html>