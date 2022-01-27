const express = require('express');
const router = express.Router();

const VehiclesController = require(`../../controllers/residents/VehiclesController`);

router.get('/:HouseHoldID', VehiclesController.GetHouseHoldVehicles);

module.exports = router;