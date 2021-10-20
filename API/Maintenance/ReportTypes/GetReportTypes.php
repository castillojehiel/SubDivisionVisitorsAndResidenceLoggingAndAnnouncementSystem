<?php
    require '../../Connection.php';
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
                WHERE Description LIKE '%$keyword%'
            ";

    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();