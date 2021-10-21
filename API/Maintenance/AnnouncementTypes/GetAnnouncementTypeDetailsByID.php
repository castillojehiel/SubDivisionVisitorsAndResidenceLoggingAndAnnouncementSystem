<?php
    require '../../Connection.php';
    $ID = $_GET["ID"];

    $query = "SELECT 
                    ATID,
                    Description,
                    isActive, 
                    GetDataCenterCompleteName(CreatedBy) as CreatedBy,
                    CreatedDateTime,
                    GetDataCenterCompleteName(UpdatedBy) as UpdatedBy,
                    UpdatedDateTime
                FROM AnnouncementTypes 
                WHERE ATID = '$ID'
            ";

    $sql = $conn -> query($query);
    $data = $sql -> fetch_assoc();

    echo json_encode($data);

    $conn -> close();