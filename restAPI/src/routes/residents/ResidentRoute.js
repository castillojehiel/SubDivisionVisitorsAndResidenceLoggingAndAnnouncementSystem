const express = require('express');
const router = express.Router();

const ResidentController = require(`../../controllers/residents/ResidentController`);

//route test
router.get('/Login/:Username/:Password', ResidentController.ResidentLogin);

module.exports = router;