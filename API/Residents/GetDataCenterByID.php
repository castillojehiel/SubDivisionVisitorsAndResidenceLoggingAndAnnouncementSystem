<?php
    require '../Connection.php';
    $ID = $_GET["DataCenterID"];

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
                    dc.isResident,
                    GetDataCenterCompleteName(dc.CreatedBy) as CreatedBy,
                    dc.CreatedDateTime,
                    GetDataCenterCompleteName(dc.UpdatedBy) as UpdatedBy,
                    dc.UpdatedDateTime,
                    h.HouseHoldName as HouseHold,
                    CONCAT(dc.FirstName, ' ', dc.MiddleName, ' ', dc.LastName, ' ', dc.Suffix) as ResidentName,
                    dc.DataCenterPhoto,
                    dc.PhotoExt
                FROM DataCenter dc
                LEFT JOIN HouseHolds h
                    ON dc.HouseHoldID = h.HouseHoldID
                WHERE   dc.DataCenterID = '$ID'
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_assoc();

    echo json_encode($data); 

    $conn -> close();