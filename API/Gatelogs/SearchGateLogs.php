<?php
    require '../Connection.php';

    $DateFrom = $_POST["txtDateFrom"];
    $DateTo = $_POST["txtDateTo"];
    $Keyword = $_POST["txtKeyword"];
    $Residents = false;
    $Visitors = false;
    $Vehicles = false;
    if(isset($_POST["chkResidents"])){
		$Residents = true;
	}
    if(isset($_POST["chkVisitors"])){
		$Visitors = true;
	}
    if(isset($_POST["chkCars"])){
		$Vehicles = true;
	}

    $query = "SELECT
                    gpl.*,
                    CASE 
                        WHEN gpl.isVehicleLog = 0 AND dc.isResident = 1 THEN
                            dcHH.HouseHoldName
                        WHEN gpl.isVehicleLog = 0 AND dc.isResident = 0 THEN
                            visitHH.HouseHoldName
                        ELSE
                            vHH.HouseHoldName
                    END as HouseHold,
                    CASE 
                        WHEN gpl.isVehicleLog = 0 THEN
                            CONCAT(dc.FirstName,' ', dc.MiddleName,' ', dc.LastName)
                        ELSE
                            CONCAT(v.Model, ' | ', v.PlateNumber)
                    END as LogDetails,
                    CASE 
                        WHEN gpl.isVehicleLog = 0 AND dc.isResident = 1 THEN
                            'RESIDENT'
                        WHEN gpl.isVehicleLog = 0 AND dc.isResident = 0 THEN
                            'VISITOR'
                        ELSE
                            'VEHICLE'
                    END as TypeOfDetail,
                    GetUserCompleteName(gpl.CreatedBy) as ScannedBy

                FROM gatepasslogs gpl
                LEFT JOIN DataCenter dc
                    ON gpl.DataCenterID = dc.DataCenterID
                LEFT JOIN Vehicles v
                    ON gpl.DataCenterID = v.VehicleID
                LEFT JOIN HouseHolds dcHH
                    ON dc.HouseHoldID = dcHH.HouseHoldID
                LEFT JOIN HouseHolds vHH
                    ON v.HouseHoldID = vHH.HouseHoldID
                LEFT JOIN HouseHolds visitHH
                    ON gpl.TargetHouseHoldID = visitHH.HouseHoldID
                WHERE 
                    (CONVERT(gpl.CreatedDateTime, DATE) >= '$DateFrom' AND CONVERT(gpl.CreatedDateTime, DATE) <= '$DateTo')
                    AND 
                    (
                        dc.QRCode LIKE '%$Keyword%'
                        OR CONCAT(dc.FirstName,' ', dc.LastName) LIKE '%$Keyword%'
                        OR v.Model LIKE '%$Keyword%'
                        OR v.PlateNumber LIKE '%$Keyword%'
                    )
                    AND 
                    (
                        ('$Residents' = 1 AND dc.isResident = 1)
                        OR ('$Visitors' = 1 AND dc.isResident = 0)
                        OR ('$Vehicles' = 1 AND gpl.isVehicleLog = 1)
                    )
                ";

    $sql = $conn -> query($query);

    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();