
export const DateValidator = (value) => {
    return !value || moment.utc(value, 'MM/DD/YYYY', true).isValid();
};

export const AlphaSpaceValidator = (value) => {
    return /^[a-zA-Z ]*$/.test(value);
};

export const Boolean = (value) => {
    return !!value;
};
