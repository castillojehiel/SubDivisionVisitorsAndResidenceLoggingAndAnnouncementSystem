<?php
    require 'Connection.php';
    $ID = $_GET["ID"];
    $query = "  SELECT
                    vl.VLID,
                    vl.VisitorID ,
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
                    dc.isActive,
                    CASE 
                        WHEN dc.isActive = 1 THEN 'Active'
                        ELSE 'Inactive'
                        END as RecordStatus,
                    dc.isResident,
                    GetDataCenterCompleteName(dc.CreatedBy) as CreatedBy,
                    dc.CreatedDateTime,
                    GetDataCenterCompleteName(dc.UpdatedBy) as UpdatedBy,
                    dc.UpdatedDateTime,
                    CONCAT(dc.FirstName, ' ', dc.MiddleName, ' ', dc.LastName, ' ', dc.Suffix) as VisitorName
                FROM VisitorLogs vl
                LEFT JOIN DataCenter dc
                    ON vl.VisitorID = dc.DataCenterID
                WHERE   vl.HouseHoldID = '$ID'
                        AND IFNULL(isApproved,0) = 0
                        AND vl.isActive = 1
                        AND ( CONVERT(RequestDateTime, DATE) = CONVERT(CURRENT_TIMESTAMP, DATE) )
                GROUP BY vl.VisitorID 
                ORDER BY vl.RequestDateTime ASC          
    ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();