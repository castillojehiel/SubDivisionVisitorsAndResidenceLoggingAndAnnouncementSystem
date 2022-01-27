const dbConn = require('../../../config/db.config');

let Vehicle = (vehicles) =>{
    this.Color = vehicles.Color;
    this.CreatedBy = vehicles.CreatedBy;
    this.CreatedDateTime = vehicles.CreatedDateTime;
    this.HouseHoldID = vehicles.HouseHoldID;
    this.isActive = vehicles.isActive;
    this.Model = vehicles.Model;
    this.PlateNumber = vehicles.PlateNumber;
    this.QRCode = vehicles.QRCode;
    this.VehicleID = vehicles.VehicleID;
}

Vehicle.GetHouseHoldVehicles = (HouseHoldID, result) =>{
    dbConn.query(
        `SELECT * FROM vehicles WHERE HouseHoldID = '${HouseHoldID}' AND isActive = 1`, 
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

module.exports = Vehicle;