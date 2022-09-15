const id = require('./id');

const locale = {
  ...id,
  trans: function (key, bind = {}) {
    if (this[key] && key !== 'trans') {
      let result = this[key];

      for (var key in bind) {
        result = result.replaceAll(':' + key, bind[key]);
      }

      return result;
    } else {
      return 'none';
    }
  }
};

module.exports = locale;
