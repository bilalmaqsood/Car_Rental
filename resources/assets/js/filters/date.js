module.exports = function (value, type, format) {
    if(type && typeof type !== 'undefined' && moment().diff(value) < 86400000  &&  moment().diff(value)>0) //39651088
        return 'Today';
        else
    return moment.utc(value).format('DD.MM.Y');
};