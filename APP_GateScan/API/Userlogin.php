<?php
    header("Access-Control-Allow-Origin: *");
    require 'Connection.php';
    include 'sms.php';

    $Username = $_POST["txtUsername"];
    $UserPass = $_POST["txtPassword"];
    $query = "  SELECT
                    u.UserID ,
                    u.DataCenterID,
                    u.FirstName,
                    u.MiddleName,
                    u.LastName,
                    u.Suffix,
                    u.Gender,
                    u.BirthDate,
                    u.ContactNo,
                    u.EmailAddress,
                    u.QRCode,
                    u.isActive,
                    CASE 
                        WHEN u.isActive = 1 THEN 'Active'
                        ELSE 'Inactive'
                        END as RecordStatus,
                    GetDataCenterCompleteName(u.CreatedBy) as CreatedBy,
                    u.CreatedDateTime,
                    GetDataCenterCompleteName(u.UpdatedBy) as UpdatedBy,
                    u.UpdatedDateTime,
                    CONCAT(u.FirstName, ' ', u.MiddleName, ' ', u.LastName, ' ', u.Suffix) as UserCompleteName,
                    u.Username,
                    U.Userpass
                FROM useraccount u
                LEFT JOIN DataCenter dc
                    ON u.DataCenterID = dc.DataCenterID
                WHERE   u.isActive = 1  
                        AND u.Username = '$Username'
                        AND u.Userpass = '$UserPass'      
    ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_assoc();

    //SendSMS("09486502348", "Test Message");

    echo json_encode($data);

    $conn -> close();

