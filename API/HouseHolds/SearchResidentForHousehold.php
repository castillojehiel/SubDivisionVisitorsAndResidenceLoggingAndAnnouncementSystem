<?php
    require '../Connection.php';
    $keyword = $_POST["txtSearch"];

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
                    GetDataCenterCompleteName(dc.CreatedBy) as CreatedBy,
                    dc.CreatedDateTime,
                    GetDataCenterCompleteName(dc.UpdatedBy) as UpdatedBy,
                    dc.UpdatedDateTime,
                    CONCAT(dc.FirstName, ' ', dc.MiddleName, ' ', dc.LastName, ' ', dc.Suffix) as ResidentName,
                    FALSE as isContactPerson
                FROM DataCenter dc
                LEFT JOIN HouseHolds h
                    ON dc.HouseHoldID = h.HouseHoldID
                WHERE   dc.isResident = 1 
                        AND dc.isActive = 1
                        AND CONCAT(dc.FirstName, ' ', dc.LastName) LIKE '%$keyword%'
                        AND h.HouseHoldID IS NULL
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data); 

    $conn -> close();