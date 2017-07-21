module.exports = function (value, type, format) {
    return typeof type !== 'undefined' ? (typeof type !== 'undefined' ? moment.utc(value)[type](format) : moment.utc(value)[type]()) : moment.utc(value).format('dddd, MMMM Do YYYY, h:mm:ss a');
};
