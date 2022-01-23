const dbConn = require('../../../config/db.config');

let GateLogs = (gatelogs) =>{
    this.CreatedBy = gatepasslogs.CreatedBy;
    this.CreatedDateTime = gatepasslogs.CreatedDateTime
    this.DataCenterID = gatepasslogs.DataCenterID;
    this.GPLogID = gatepasslogs.GPLogID;
    this.isVehicleLog = gatepasslogs.isVehicleLog;
    this.LoggerType = gatepasslogs.LoggerType;
    this.LogType = gatepasslogs.LogType;
    this.PurposeOfLog = gatepasslogs.PurposeOfLog;
    this.QRCode = gatepasslogs.QRCode;
    this.ScannedBy = gatepasslogs.ScannedBy;
    this.TargetHouseHoldID = gatepasslogs.TargetHouseHoldID
    this.ReasonForVisit = gatepasslogs.ReasonForVisit
}

GateLogs.GetHouseHoldVisitationForApproval = (HouseHoldID, result) =>{
    dbConn.query(`SELECT
                    vl.VLID,
                    vl.VisitorID ,
                    dc.FirstName,
                    dc.MiddleName,
                    dc.LastName,
                    dc.Suffix,
                    dc.Gender,
                    dc.BirthDate,
                    dc.ContactNo,
                    dc.EmailAddress,
                    dc.HouseHoldID,
                    dc.QRCode,
                    dc.isActive,
                    CASE 
                        WHEN dc.isActive = 1 THEN 'Active'
                        ELSE 'Inactive'
                        END as RecordStatus,
                    dc.isResident,
                    GetDataCenterCompleteName(dc.CreatedBy) as CreatedBy,
                    dc.CreatedDateTime,
                    GetDataCenterCompleteName(dc.UpdatedBy) as UpdatedBy,
                    dc.UpdatedDateTime,
                    CONCAT(dc.FirstName, ' ', dc.MiddleName, ' ', dc.LastName, ' ', dc.Suffix) as VisitorName,
                    vl.ReasonForVisit
                FROM VisitorLogs vl
                LEFT JOIN DataCenter dc
                    ON vl.VisitorID = dc.DataCenterID
                WHERE   vl.HouseHoldID = '${HouseHoldID}'
                        AND IFNULL(isApproved,0) = 0
                        AND vl.isActive = 1
                        AND ( CONVERT(RequestDateTime, DATE) = CONVERT(CURRENT_TIMESTAMP, DATE) )
                GROUP BY vl.VisitorID 
                ORDER BY vl.RequestDateTime ASC `, (err, res) =>{
        if(err){
            console.log("Error..." , err);
            result(null, err);
        }
        else{
            console.log("Success", res);
            result(null, res);
        }
    });
}

GateLogs.ApproveVisitation = (params, result) => {
    dbConn.query(
        `UPDATE    visitorlogs
            SET 
                isApproved = 1,
                ApprovedBy = '${params.ApprovedBy}',
                ApprovedDateTime = CURRENT_TIMESTAMP
            WHERE VLID = '${params.VLID}'`,
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

GateLogs.RejectVisitation = (params, result) => {
    dbConn.query(
        `UPDATE    visitorlogs
            SET 
                isActive = 0
            WHERE VLID = '${params.VLID}'`,
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

module.exports = GateLogs;