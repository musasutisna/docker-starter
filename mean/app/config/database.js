const mongoose = require('mongoose');
const { Sequelize } = require('sequelize');

/**
 * Create mysql connection.
 */
const mysql = new Sequelize(
  process.env.MYSQL_DATABASE,
  process.env.MYSQL_USERNAME,
  process.env.MYSQL_PASSWORD,
  {
    host: process.env.MYSQL_HOST,
    port: process.env.MYSQL_PORT,
    dialect: 'mysql'
  }
);

/**
 * Start database connection.
 *
 * @param   callback
 * @return  void
 */
async function connect(cb) {
  try {
    await mongoose.connect(process.env.MONGO_STRING, {
      useNewUrlParser: true,
      useUnifiedTopology: true,
      user: process.env.MONGO_USERNAME,
      pass: process.env.MONGO_PASSWORD
    });

    await mysql.authenticate();

    cb();
  } catch (err) {
    console.error(err);
    process.exit(1);
  }
}

module.exports = {
  connect,
  mysql
};
