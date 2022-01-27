const vehiclesModel = require("../../models/residents/VehiclesModel");


exports.GetHouseHoldVehicles = (req, res) =>{
    vehiclesModel.GetHouseHoldVehicles(req.params.HouseHoldID, (err, visitors) =>{
        if(err){
            res.send(err);
        }
        else{
            console.log(visitors);
            res.send(visitors);
        }
    });
}
