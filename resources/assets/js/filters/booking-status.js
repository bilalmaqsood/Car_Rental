let statusTypes = [
    'Requested',
    'Approved',
    'Signed by client',
    'Signed by owner',
    'Accepted',
    'Termination',
    'Terminated',
    'Extend',
    'Extended',
    'Close',
    'Disputed',
    'Resolved'
];

module.exports = function (value) {
    return statusTypes[value];
};
