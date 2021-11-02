<?php
    require '../Connection.php';
    $keyword = $_POST["txtSearch"];

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
                WHERE   (
                            CONCAT('REP', ReportID) LIKE '%$keyword%'
                            OR
                            GetDataCenterCompleteName(rr.CreatedBy) LIKE '%$keyword%'
                        )
                ";
    $sql = $conn -> query($query);
    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();