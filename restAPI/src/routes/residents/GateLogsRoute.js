const express = require('express');
const router = express.Router();

const GateLogsController = require(`../../controllers/residents/GateLogsController`);

//route test
router.get('/Visitors/ForApproval/:HouseHoldID', GateLogsController.GetHouseHoldVisitationForApproval);

router.post('/Visitors/ApproveVisitation', GateLogsController.ApproveVisitation);
router.post('/Visitors/RejectVisitation', GateLogsController.RejectVisitation);

module.exports = router;