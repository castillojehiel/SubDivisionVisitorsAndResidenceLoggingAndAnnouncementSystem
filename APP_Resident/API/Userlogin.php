<?php
    header("Access-Control-Allow-Origin: *");
    require 'Connection.php';
    $Username = $_POST["txtUsername"];
    $UserPass = $_POST["txtPassword"];
    $query = " SELECT
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
                    dc.isActive,
                    dc.isResident,
                    GetDataCenterCompleteName(dc.CreatedBy) as CreatedBy,
                    dc.CreatedDateTime,
                    GetDataCenterCompleteName(dc.UpdatedBy) as UpdatedBy,
                    dc.UpdatedDateTime,
                    h.HouseHoldName as HouseHold,
                    CONCAT(dc.FirstName, ' ', dc.MiddleName, ' ', dc.LastName, ' ', dc.Suffix) as ResidentName,
                    dc.Userpass,
                    CASE WHEN hhcp.HCPID IS NOT NULL THEN true ELSE false END as isHouseHoldContactPerson,
                    dc.DataCenterPhoto,
                    dc.PhotoExt
                FROM DataCenter dc
                LEFT JOIN HouseHolds h
                    ON dc.HouseHoldID = h.HouseHoldID
                LEFT JOIN householdcontactpersons hhcp
                    ON dc.DataCenterID = hhcp.ResidentID
                WHERE   dc.isActive = 1
                        AND dc.isResident = 1   
                        AND (dc.QRCode = '$Username' OR dc.EmailAddress = '$Username')
                        AND dc.UserPass = '$UserPass'
    ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_assoc();

    echo json_encode($data);

    $conn -> close();