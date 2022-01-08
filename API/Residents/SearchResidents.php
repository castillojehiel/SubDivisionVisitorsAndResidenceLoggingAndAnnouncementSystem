<?php
    require '../Connection.php';
    $keyword = $_POST["txtSearch"];
    $isShowAll = true;
    if(isset($_POST["isShowAll"])){
		$isActive = $_POST["isShowAll"];
	}


    $query = "SELECT 
                    dc.DataCenterID,
                    dc.FirstName,
                    dc.MiddleName,
                    dc.LastName,
                    dc.Suffix,
                    dc.Gender,
                    dc.BirthDate,
                    dc.ContactNo,
                    dc.EmailAddress,
                    dc.HouseHoldID,
                    dc.QRCode,
                    CASE WHEN dc.isActive = 1 THEN true ELSE false END as isActive,
                    CASE 
                        WHEN dc.isActive = 1 THEN 'Active'
                        ELSE 'Inactive'
                        END as RecordStatus,
                    dc.isResident,
                    GetDataCenterCompleteName(dc.CreatedBy) as CreatedBy,
                    dc.CreatedDateTime,
                    GetDataCenterCompleteName(dc.UpdatedBy) as UpdatedBy,
                    dc.UpdatedDateTime,
                    h.HouseHoldName as HouseHold,
                    CONCAT(dc.FirstName, ' ', dc.MiddleName, ' ', dc.LastName, ' ', dc.Suffix) as ResidentName
                FROM DataCenter dc
                LEFT JOIN HouseHolds h
                    ON dc.HouseHoldID = h.HouseHoldID
                WHERE   dc.isResident = 1 
                        AND CONCAT(dc.FirstName, ' ', dc.LastName) LIKE '%$keyword%'
                        AND dc.isActive = (CASE WHEN '$isShowAll' = 1 THEN dc.isActive ELSE 1 END)
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data); 

    $conn -> close();