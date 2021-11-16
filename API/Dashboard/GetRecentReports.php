<?php
    require '../Connection.php';
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
                    rt.Description as ReportType,
                    CASE 
                        WHEN ReportStatus = 'REJECT' OR ReportStatus = 'RESOLVED' OR ReportStatus = 'ACKNOWLEDGE' THEN false
                        ELSE true
                    END as isAllowUpdateStatus
                FROM residentreports rr
                LEFT JOIN reporttypes rt
                    ON rr.ReportTypeID = rt.ReportTypeID
                WHERE   rr.isActive = 1
                ORDER BY rr.ReportID
                LIMIT 10
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();