<?php
    require 'Connection.php';
    $VisitorID = $_POST["txtVisitorID"];
    $VisitorQRCode = $_POST["txtVisitorQRCode"];
    $HouseholdID = $_POST["txtHouseHoldID"];
    $Reason = $_POST["txtReasonForVisit"];
    $Scanner = $_POST["ScannedByUser"];

    $query = "INSERT INTO 
                VisitorLogs(
                        VisitorID, 
                        isApproved,
                        isActive,
                        RequestDateTime,
                        ScannedBy,
                        HouseHoldID,
                        ReasonForVist
                        )
                VALUES(
                        '$VisitorID',
                        0,
                        1,
                        CURRENT_TIMESTAMP,
                        '$Scanner',
                        '$HouseholdID',
                        '$Reason'
                    )
            ";

    $sql = $conn -> query($query);

    $query1 = "INSERT INTO ScannerLogs (Module, UserID, ScanValue, CreatedDateTime) VALUES ('GATEPASS', '$Scanner', '$VisitorQRCode', CURRENT_TIMESTAMP)";
        $conn -> query($query1);

    echo json_encode(array("result" => $sql));

    $conn -> close();