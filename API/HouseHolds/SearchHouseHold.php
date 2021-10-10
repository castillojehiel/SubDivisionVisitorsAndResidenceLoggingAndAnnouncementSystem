<?php
    require '../Connection.php';
    $keyword = $_POST["txtSearch"];

    $query = "SELECT 
                HouseHoldID, 
                HouseHoldName, 
                HouseNo, 
                Street, 
                isActive, 
                CASE 
                    WHEN isActive = 1 THEN 'Active'
                    ELSE 'Inactive'
                END as RecordStatus,
                GetDataCenterCompleteName(CreatedBy) as CreatedBy,
                CreatedDateTime,
                GetDataCenterCompleteName(UpdatedBy) as UpdatedBy,
                UpdatedDateTime
                FROM HouseHolds
                WHERE HouseHoldName LIKE'%$keyword%'
                    AND isActive = 1
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data); 

    $conn -> close();