module.exports = function (value, type, format) {
    if(typeof type !== 'undefined' && moment().diff(value) < 86400000  &&  moment().diff(value)>0) //39651088
        return 'just now';
        else
    return typeof type !== 'undefined' ? (typeof type !== 'undefined' ? moment.utc(value)[type](format) : moment.utc(value)[type]()) : moment.utc(value).format('dddd, MMMM Do YYYY, h:mm:ss a');
};