<!DOCTYPE html>
<?php 
    include 'sidenav.php';
?>


<div class="mainContent" >

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card ">
                        <div class="card-body" id="cardResidentCount">
                            <h5 class="card-title">Residents Count:</h5>
                            <h1>100</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body" id="cardHouseHoldCount">
                            <h5 class="card-title">HouseHolds Count:</h5>
                            <h1>100</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body" id="cardVisitorCount">
                            <h5 class="card-title">Visitors Count:</h5>
                            <h1>100</h1>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="card" >
                        <div class="card-header" style="background-color: #121235">
                            <h4 style="color:white">Resident Reports Statistics</h4>
                        </div>
                        <br>
                        <div class="row">
                            <form id="frmGenerateReportStatistics">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <input type="date" name="txtDateFrom" class="form-control" required placeholder="Date From" 
                                        value="<?php echo date('Y-m-d',strtotime(date("Y/m/d", strtotime('-7 days')))) ?>" />
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="date" name="txtDateTo" class="form-control" required placeholder="Date To" 
                                        value="<?php echo date('Y-m-d',strtotime(date("Y/m/d"))) ?>" />
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-primary" type="submit">
                                            Generate Report
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <canvas id="cvsReportsGraph">

                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="background-color: #121235">
                            <h5 class="card-title" style="color:white">Recent Announcement</h5>
                        </div>
                        <!-- <div class="card-body">
                        </div> -->
                        <ul id="listRecentAnnouncement" class="list-group list-group-flush">
                            <!-- <li class="list-group-item">
                                <h6>Announcement title</h6>
                                <i style="font-size:12px">Date of Publish</i>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="background-color: #121235">
                            <h5 class="card-title" style="color:white">Reports</h5>
                        </div>
                        <!-- <div class="card-body">
                        </div> -->
                        <ul id="listRecentReports" class="list-group list-group-flush">
                            <!-- <li class="list-group-item">
                                <h6>Report Type</h6>
                                <div class="row m-0">
                                    <div class="col-6 m-0">
                                        <i style="font-size:12px">Status : </i>
                                    </div>
                                    <div class="col-6 m-0">
                                        <i style="font-size:12px">Date of Report : </i>
                                    </div>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<script defer="true">
    $(document).ready( function(){

        

        $("#frmGenerateReportStatistics").submit( function(event){
            event.preventDefault();
            let data = $(this).serialize();
            let url = "API/Dashboard/GetresidentReportStatistics.php";
            $.post(url, data, function(res){
                let xValues = [];
                let allReportsValues =[];
                let pendingReportsValues =[];
                let resolvedReportsValues =[];
                let acknowledgedReportsValues =[];
                let rejectedReportsValues =[];

                $.each(res, function(indx,value){
                    xValues.push(value.x);
                    allReportsValues.push(value.AllReports);
                    pendingReportsValues.push(value.PendingReports);
                    resolvedReportsValues.push(value.ResolvedReports);
                    acknowledgedReportsValues.push(value.AcknowledgedReports);
                    rejectedReportsValues.push(value.RejectedReports);
                });

                var myChart = new Chart("cvsReportsGraph", {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [
                            {
                                label : "All Reports",
                                borderColor: "rgba(0,0,0,0.1)",
                                data: allReportsValues,
                                fill:false
                            },
                            {
                                label : "Pending Reports",
                                borderColor: "gray",
                                data: pendingReportsValues,
                                fill:false
                            },
                            {
                                label : "Acknowledged Reports",
                                borderColor: "blue",
                                data: acknowledgedReportsValues,
                                fill:false
                            },
                            {
                                label : "Resolved Reports",
                                borderColor: "green",
                                data: resolvedReportsValues,
                                fill:false
                            },
                            {
                                label : "Rejected Reports",
                                borderColor: "red",
                                data: rejectedReportsValues,
                                fill:false
                            }
                        ]
                    },
                    labelsFilter: function (value, index) {
                        return (index + 1) % 5 !== 0;
                    },
                    options: {}
                    });
            }, 'json')
            .fail( function(xhr, status, message){
				msgPopUp("Error has occured", message, "danger");
			});
        });

        //load summaries
        $.get("API/Dashboard/DashboardSummaries.php", function(res){
            $("#cardResidentCount h1").html(res.ResidentCount);
            $("#cardHouseHoldCount h1").html(res.HouseholdCount);
            $("#cardVisitorCount h1").html(res.VisitorCount);
        }, 'json')

        //loadRecent announcements
        $.get("API/Dashboard/GetRecentAnnouncements.php", function(res){
            let $list = $("#listRecentAnnouncement");
            $list.html("");
            $.each(res, function(indx, value){
                if(indx != 10){
                    $list.append(`
                            <li class="list-group-item">
                                <h6>`+ value.Title +`</h6>
                                <i style="font-size:12px">Published Date : `+ value.PublishedDateTime +`</i>
                            </li>
                    `)
                }
            })
        }, 'json')

        //loadRecent REports
        $.get("API/Dashboard/GetRecentReports.php", function(res){
            let $list = $("#listRecentReports");
            $list.html("");
            $.each(res, function(indx, value){
                if(indx != 10){
                    $list.append(`
                            <li class="list-group-item">
                                <h6>`+ value.ReportType +`</h6>
                                <div class="row m-0">
                                    <div class="col-6 m-0">
                                        <i style="font-size:12px">Status :`+ value.ReportStatus +` </i>
                                    </div>
                                    <div class="col-6 m-0">
                                        <i style="font-size:12px">Date of Report : `+ value.CreatedDateTime +` </i>
                                    </div>
                                </div>
                            </li>
                    `)
                }
            })
        }, 'json')

    })
</script>
</DOCTYPE html>