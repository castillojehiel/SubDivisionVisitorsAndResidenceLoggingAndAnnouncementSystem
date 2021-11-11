<?php
    header("Access-Control-Allow-Origin: *");
    require 'Connection.php';
    $ID = $_GET["ID"];
    $query = "  SELECT
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
                    CONCAT(dc.FirstName, ' ', dc.MiddleName, ' ', dc.LastName, ' ', dc.Suffix) as VisitorName,
                    CASE WHEN vw.VWID IS NOT NULL THEN true ELSE false END as isWhiteListed,
                    CASE WHEN vb.VBID IS NOT NULL THEN true ELSE false END as isBlackListed,
                    vw.VWID,
                    vb.VBID
                FROM VisitorLogs vl
                LEFT JOIN DataCenter dc
                    ON vl.VisitorID = dc.DataCenterID
                LEFT JOIN VisitorWhitelist vw
                    ON vl.VisitorID = vw.VisitorID
                LEFT JOIN VisitorBlackList vb
                    ON vl.VisitorID = vb.VisitorID
                WHERE vl.HouseHoldID = '$ID'
                GROUP BY vl.VisitorID 
                ORDER BY dc.FirstName, dc.MiddleName, dc.LastName ASC          
    ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();