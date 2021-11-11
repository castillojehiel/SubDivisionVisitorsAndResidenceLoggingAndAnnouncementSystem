<?php
    require 'Connection.php';
    $ID = $_GET["ID"];

    $query = "SELECT
                vl.*,
                hh.HouseHoldName,
                CASE 
                    WHEN vl.isApproved = 1 THEN 'APPROVED'
                    WHEN vl.isActive = 0 THEN 'REJECTED'
                    ELSE 'PENDING'
                END as VisitStatus
                FROM visitorlogs vl
                LEFT JOIN HouseHolds hh
                    ON vl.HouseHoldID = hh.HouseHoldID
                WHERE vl.VisitorID = '$ID'
                ORDER BY RequestDateTime DESC
                ";
    $sql = $conn -> query($query);

    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();