const express = require('express');
const router = express.Router();

const PollingController = require(`../../controllers/residents/PollingController`);

router.get('/Visitors/ForApproval/:HouseHoldID', PollingController.VisitationForApproval);
router.get('/Visitors/WhiteListed/:HouseHoldID', PollingController.WhiteListedVisitations);
router.get('/Visitors/BlockListed/:HouseHoldID', PollingController.BlockListedVisitations);
router.get('/Announcements', PollingController.GetLastPublishedAnnouncement);

module.exports = router;