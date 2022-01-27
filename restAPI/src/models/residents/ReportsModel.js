const dbConn = require('../../../config/db.config');

const Reports = (report) =>{
    this.AcknowledgedBy = residentreports.AcknowledgedBy;
    this.AcknowledgedDateTime = residentreports.AcknowledgedDateTime;
    this.CreatedBy = residentreports.CreatedBy;
    this.CreatedDateTime = residentreports.CreatedDateTime;
    this.isActive = residentreports.isActive;
    this.RejectedBy = residentreports.RejectedBy;
    this.RejectedDateTime = residentreports.RejectedDateTime;
    this.RejectionRemarks = residentreports.RejectionRemarks;
    this.ReportAcknowledgementRemarks = residentreports.ReportAcknowledgementRemarks;
    this.ReportDetails = residentreports.ReportDetails;
    this.ReporterID = residentreports.ReporterID;
    this.ReportID = residentreports.ReportID;
    this.ReportRemarks = residentreports.ReportRemarks;
    this.ReportResolveRemarks = residentreports.ReportResolveRemarks;
    this.ReportStatus = residentreports.ReportStatus;
    this.ReportTypeID = residentreports.ReportTypeID;
    this.ResolvedBy = residentreports.ResolvedBy;
    this.ResolvedDateTime = residentreports.ResolvedDateTime;
    this.UpdatedBy = residentreports.UpdatedBy;
    this.UpdatedDateTime = residentreports.UpdatedDateTime;

}

Reports.GetReportTypes = (keyword, result) => {
    console.log(keyword);
    dbConn.query(
        `SELECT 
            ReportTypeID,
            Description,
            isActive, 
            GetDataCenterCompleteName(CreatedBy) as CreatedBy,
            CreatedDateTime,
            GetDataCenterCompleteName(UpdatedBy) as UpdatedBy,
            UpdatedDateTime
        FROM reporttypes 
        WHERE   Description LIKE '%${(keyword == undefined ? "" : keyword)}%'
                AND isActive = 1`,
        (err, res) =>{
            if(err){
                console.log("Error..." , err);
                result(null, err);
            }
            else{
                console.log("Success", res);
                result(null, res);
            }
        }
    );
}

Reports.SearchResidentReports = (Reports, result) =>{
    console.log(Reports);
    dbConn.query(
        `SELECT
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
        WHERE   rr.ReporterID = '${Reports.DataCenterID}'
                AND (
                    CONCAT('REP', rr.ReportID) LIKE '%${(Reports.Keyword == undefined) ? "" : Reports.Keyword}%'
                    OR
                    rr.ReportDetails LIKE '%${(Reports.Keyword == undefined) ? "" : Reports.Keyword}%'
                )
                AND rr.ReportTypeID = (CASE WHEN '${Reports.ReportType}' > 0 THEN '${Reports.ReportType}' ELSE rr.ReportTypeID END)
                AND (CONVERT(rr.CreatedDateTime, DATE) >= CONVERT('${Reports.DateFrom}', DATE) AND CONVERT(rr.CreatedDateTime, DATE) <= CONVERT('${Reports.DateTo}', DATE) )
                AND rr.isActive = 1`,
        (err, res) =>{
            if(err){
                console.log("Error..." , err);
                result(null, err);
            }
            else{
                console.log("Success", res);
                result(null, res);
            }
        }
    );
}

Reports.CreateNewReport = (report, result) =>{
    dbConn.query(
        `INSERT INTO residentreports(
            ReporterID,
            ReportTypeID,
            ReportDetails,
            ReportStatus,
            CreatedBy,
            CreatedDateTime,
            isActive
        )
        VALUES(
            '${report.CreatedBy}',
            '${report.ReportTypeID}',
            '${report.ReportDetails}',
            'PENDING',
            '${report.CreatedBy}',
            CURRENT_TIMESTAMP,
            1
        )`,
        (err, res) =>{
            if(err){
                console.log("Error..." , err);
                result(null, err);
            }
            else{
                console.log("Success", res);
                result(null, res);
            }
        }
    );
}

Reports.UpdateReport = (report, result) =>{
    console.log("------- params ------");
    console.log(report);
    console.log("------- end params ------");
    dbConn.query(
        `UPDATE residentreports
        SET
            ReportTypeID = '${report.ReportTypeID}',
            ReportDetails = '${report.ReportDetails}',
            UpdatedBy = '${report.UpdatedBy}',
            UpdatedDateTime = CURRENT_TIMESTAMP,
            isActive = '${report.isActive}'
        WHERE   ReportID = '${report.ReportID}'`,
        (err, res) =>{
            if(err){
                console.log("Error..." , err);
                result(null, err);
            }
            else{
                console.log("Success", res);
                result(null, res);
            }
        }
    );
}

module.exports = Reports;