module.exports = function (value, format) {
    return '£ ' + numeral(value).format(typeof format === 'undefined' ? '0,0.0' : format);
};
