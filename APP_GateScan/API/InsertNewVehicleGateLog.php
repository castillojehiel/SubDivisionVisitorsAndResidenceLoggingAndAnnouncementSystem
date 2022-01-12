<?php
    header("Access-Control-Allow-Origin: *");
    require 'Connection.php';
    $QRCode = $_POST["QRCode"];
    $Scanner = $_POST["ScannedByUser"];

    $query = "SELECT * FROM Vehicles WHERE QRCode = '$QRCode' AND isActive = 1";
    $sql = $conn -> query($query);

    if($sql -> num_rows > 0){
        $data = $sql -> fetch_assoc();
        $ID = $data["VehicleID"];
        //insert to log
        $query = "INSERT INTO gatepasslogs (DataCenterID, QRCode, ScannedBy, CreatedBy, CreatedDateTime, isVehicleLog)
                VALUES ('$ID', '$QRCode', '$Scanner', '$Scanner', CURRENT_TIMESTAMP, 1)";
        $conn -> query($query);

        echo json_encode(array("result" => true, "message" => "Valid QR Code"));
    }
    else{
        echo json_encode(array("result" => false, "message" => "Invalid QR Code"));
    }


    $conn -> close();