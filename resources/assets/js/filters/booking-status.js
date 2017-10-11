let statusTypes = [
    'Requested',
    'Accepted',
    'Signed by owner',
    'Signed by client',
    'Active (on going)',
    'Early cancel requested',
    'Terminated',
    'Extention requested',
    'Extended',
    'Close',
    'Disputed',
    'Resolved'
];

module.exports = function (value) {
    return statusTypes[value];
};
