var express = require('express');
var router = express.Router();

const middleware = require('../controllers/middleware');
const controllers = require('../controllers/apis-v1');

// router.use(middleware.middleware);
// router.get('/api/v1/api', controllers.api);

module.exports = router;
