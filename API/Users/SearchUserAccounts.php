<?php
    require '../Connection.php';
    $keyword = $_POST["txtSearch"];

    $query = "SELECT 
                    ua.UserID,
                    ua.DataCenterID,
                    ua.FirstName,
                    ua.MiddleName,
                    ua.LastName,
                    ua.Suffix,
                    ua.Gender,
                    ua.BirthDate,
                    ua.ContactNo,
                    ua.EmailAddress,
                    ua.HouseHoldID,
                    ua.QRCode,
                    ua.isActive,
                    CASE 
                        WHEN ua.isActive = 1 THEN 'Active'
                        ELSE 'Inactive'
                        END as RecordStatus,
                    CASE 
                        WHEN IFNULL(ua.DataCenterID,0) = 0 THEN 'Non-Resident'
                        ELSE 'Resident'
                    END as Residency,
                    GetDataCenterCompleteName(ua.CreatedBy) as CreatedBy,
                    ua.CreatedDateTime,
                    GetDataCenterCompleteName(ua.UpdatedBy) as UpdatedBy,
                    ua.UpdatedDateTime,
                    CONCAT(ua.FirstName, ' ', ua.MiddleName, ' ', ua.LastName, ' ', ua.Suffix) as UserCompleteName,
                    ua.Username,
                    ua.Userpass
                FROM useraccount ua
                
                WHERE   ua.isActive = 1
                        AND CONCAT(ua.FirstName, ' ', ua.LastName) LIKE '%$keyword%'
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data); 

    $conn -> close();