const dbConn = require('../../../config/db.config');

let Resident = (resident) =>{
    this.BirthDate = resident.BirthDate;
    this.ContactNo = resident.ContactNo;
    this.CreatedBy = resident.CreatedBy;
    this.CreatedDateTime = resident.CreatedDateTime;
    this.DataCenterID = resident.DataCenterID;
    this.DataCenterPhoto = resident.DataCenterPhoto;
    this.EmailAddress = resident.EmailAddress;
    this.FirstName = resident.FirstName;
    this.Gender = resident.Gender;
    this.HouseHoldID = resident.HouseHoldID;
    this.isActive = resident.isActive;
    this.isResident = resident.isResident;
    this.LastName = resident.LastName;
    this.MiddleName = resident.MiddleName;
    this.PhotoExt = resident.PhotoExt;
    this.QRCode = resident.QRCode;
    this.ResidentPassword = resident.ResidentPassword
    this.Suffix = resident.Suffix;
    this.UpdatedBy = resident.UpdatedBy;
    this.UpdatedDateTime = resident.UpdatedDateTime;
    this.Userpass = resident.Userpass;
    this.ResidentName = resident.ResidentName;
    this.isHouseHoldContactPerson = resident.isHouseHoldContactPerson;

}

Resident.residentLogin = (ResidentDetails, result) =>{
    console.log(ResidentDetails);
    dbConn.query(`SELECT 
                    dc.DataCenterID,
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
                    dc.isResident,
                    GetDataCenterCompleteName(dc.CreatedBy) as CreatedBy,
                    dc.CreatedDateTime,
                    GetDataCenterCompleteName(dc.UpdatedBy) as UpdatedBy,
                    dc.UpdatedDateTime,
                    h.HouseHoldName as HouseHold,
                    CONCAT(dc.FirstName, ' ', dc.MiddleName, ' ', dc.LastName, ' ', dc.Suffix) as ResidentName,
                    dc.Userpass,
                    CASE WHEN hhcp.HCPID IS NOT NULL THEN True ELSE False END as isHouseHoldContactPerson,
                    dc.DataCenterPhoto,
                    dc.PhotoExt
                FROM DataCenter dc
                LEFT JOIN HouseHolds h
                    ON dc.HouseHoldID = h.HouseHoldID
                LEFT JOIN householdcontactpersons hhcp
                    ON dc.DataCenterID = hhcp.ResidentID
                WHERE   dc.isActive = 1
                        AND dc.isResident = 1   
                        AND (dc.QRCode = '${ResidentDetails.Username}')
                        AND dc.UserPass = '${ResidentDetails.Password}'
                LIMIT 1`, (err, res) =>{
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

Resident.UpdateProfileImage = (Resident, result) =>{
    console.log(Resident);
    dbConn.query(
        `UPDATE DataCenter
                SET
                    DataCenterPhoto = '${Resident.DataCenterPhoto}',
                    PhotoExt = '${Resident.PhotoExt}'
            WHERE DataCenterID = '${Resident.DataCenterID}'`, 
        (err, res) =>{
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

Resident.UpdatePassword = (Resident, result) =>{
    console.log(Resident);
    dbConn.query(
        `UPDATE DataCenter
            SET 
                Userpass = '${Resident.Userpass}'
        WHERE DataCenterID = '${Resident.DataCenterID}'`, 
        (err, res) =>{
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

Resident.RegisterNewHouseholdMember = (Resident, result) =>{
    console.log(Resident);
    dbConn.query(
        `INSERT INTO Datacenter (FirstName, MiddleName, LastName, Suffix, Gender, Birthdate, ContactNo, EmailAddress, isActive, isResident, CreatedBy, CreatedDateTime, HouseHoldID, Userpass)
            VALUES(
                    '${Resident.FirstName}',
                    '${Resident.MiddleName}',
                    '${Resident.LastName}',
                    '${Resident.Suffix}',
                    '${Resident.Gender}',
                    '${Resident.BirthDate}',
                    '${Resident.ContactNo}',
                    '${Resident.EmailAddress}',
                    1,
                    1,
                    '${Resident.CreatedBy}',
                    CURRENT_TIMESTAMP(),
                    '${Resident.HouseHoldID}',
                    '${Resident.FirstName}'
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
        });
}

Resident.UpdateNewResidentQRCode = (DataCenterID, result) =>{
    var pad = "00000000";
    var qrcode = "RES" + (pad+DataCenterID).slice(-pad.length);
    dbConn.query(
        `UPDATE DataCenter SET QRCode = '${qrcode}' WHERE DataCenterID = '${DataCenterID}'`, 
        (err, res) =>{
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


Resident.GetHouseHoldMembers = (DataCenterID, result) =>{
    console.log(Resident);
    dbConn.query(
        `SELECT
            mem.*,
            CONCAT(mem.FirstName, ' ', mem.MiddleName, ' ', mem.LastName, ' ', mem.Suffix) as HouseHoldMemberName
            FROM DataCenter dc
            LEFT JOIN Households hh
                ON dc.HouseHoldID = hh.HouseHoldID
            LEFT JOIN Datacenter mem
                ON hh.HouseHoldID = mem.HouseHoldID
            WHERE dc.isActive = 1
                AND dc.DataCenterID = '${DataCenterID}'`, 
        (err, res) =>{
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



module.exports = Resident;