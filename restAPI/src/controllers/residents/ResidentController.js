const residentModel = require("../../models/residents/ResidentModel");

exports.ResidentLogin = (req, res) =>{
    residentModel.residentLogin(req.params, (err, resident) =>{
        if(err){
            res.send(err);
        }
        else{
            console.log(resident);
            res.send(resident);
        }
    });
}