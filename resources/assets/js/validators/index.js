
export const DateValidator = (value, component) => {
    return moment(value, 'MM/DD/YYYY', true).isValid();
};

export const AlphaSpaceValidator = (value, component) => {
    return /^[a-zA-Z ]*$/.test(value);
};
