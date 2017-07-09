module.exports = function (value, type) {
    return typeof type !== 'undefined' ? moment.utc(value)[type]() : moment.utc(value).format('dddd, MMMM Do YYYY, h:mm:ss a');
};
