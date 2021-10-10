<?php
    require '../Connection.php';
    $id = $_GET["ID"];

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
                WHERE HouseHoldID = '$id'
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_assoc();

    echo json_encode($data); 

    $conn -> close();