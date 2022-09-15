const { Sequelize } = require('sequelize');

/**
 * Create postgres connection.
 */
const postgres = {
  sup: new Sequelize(
    process.env.POSTGRES_DATABASE,
    process.env.POSTGRES_USERNAME,
    process.env.POSTGRES_PASSWORD,
    {
      host: process.env.POSTGRES_HOST,
      port: process.env.POSTGRES_PORT,
      dialect: 'postgres',
      logging: process.env.NODE_ENV !== 'production' ? console.log : false,
      dialectOptions: {
        typeCast: function (field, next) {
          if (field.type === 'DATETIME' || field.type === 'DATE') {
            return field.string()
          } else {
            return next()
          }
        }
      }
    }
  )
};

/**
 * Start database connection.
 *
 * @param   callback
 * @return  void
 */
async function connect(cb = null, {
  connectSUP = true
} = {}) {
  try {
    if (connectSUP) {
      await postgres.sup.authenticate();

      postgres.supQuery = async function (query, options) {
        try {
          const result = await postgres.sup.query(query, options);

          return result;
        } catch (err) {
          return [];
        }
      }
    }

    if (cb) cb();
  } catch (err) {
    console.error(err);
    process.exit(1);
  }
}

/**
 * Close all connection.
 *
 * @return  void
 */
async function close() {
  await postgres.sp.close();
}

module.exports = {
  connect,
  close,
  postgres
};
