module.exports =  function(value, type) {
    return typeof type !== 'undefined' ? moment(value)[type]() : moment(value).format('dddd, MMMM Do YYYY, h:mm:ss a');
};
