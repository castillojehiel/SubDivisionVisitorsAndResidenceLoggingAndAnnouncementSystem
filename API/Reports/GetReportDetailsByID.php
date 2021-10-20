<?php
    require '../Connection.php';
    $ID = $_GET["ID"];

    $query = "SELECT
                    rr.ReportID, 
                    CONCAT('REP', rr.ReportID) as ReportNo,
                    rr.ReporterID, 
                    rr.ReportTypeID, 
                    rr.ReportDetails, 
                    rr.ReportStatus, 
                    rr.ReportRemarks, 
                    rr.ReportAcknowledgementRemarks,
                    GetDataCenterCompleteName(rr.AcknowledgedBy) as AcknowledgedBy,
                    rr.AcknowledgedDateTime, 
                    rr.ReportResolveRemarks, 
                    GetDataCenterCompleteName(rr.ResolvedBy) as ResolvedBy, 
                    rr.ResolvedDateTime, 
                    rr.RejectionRemarks,
                    GetDataCenterCompleteName(rr.RejectedBy) as RejectedBy, 
                    rr.RejectedDateTime,
                    rr.isActive, 
                    GetDataCenterCompleteName(rr.CreatedBy) as CreatedBy,
                    rr.CreatedDateTime,
                    GetDataCenterCompleteName(rr.UpdatedBy) as UpdatedBy,
                    rr.UpdatedDateTime,
                    rt.Description as ReportType
                FROM residentreports rr
                LEFT JOIN reporttypes rt
                    ON rr.ReportTypeID = rt.ReportTypeID
                WHERE   rr.ReportID = '$ID'
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_assoc();

    echo json_encode($data);

    $conn -> close();