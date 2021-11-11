<?php
    header("Access-Control-Allow-Origin: *");
    require 'Connection.php';
    $keyword = $_POST["txtSearch"];

    $query = "SELECT 
                    ReportTypeID,
                    Description,
                    isActive, 
                    GetDataCenterCompleteName(CreatedBy) as CreatedBy,
                    CreatedDateTime,
                    GetDataCenterCompleteName(UpdatedBy) as UpdatedBy,
                    UpdatedDateTime
                FROM reporttypes 
                WHERE   Description LIKE '%$keyword%'
                        AND isActive = 1
            ";

    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();