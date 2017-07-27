let statusTypes = [
    'Requested',
    'Confirmed',
    'Signed by client',
    'Signed by owner',
    'Accepted',
    'Cancel',
    'Canceled',
    'Extend',
    'Extended',
    'Close',
    'Disputed',
    'Resolved'
];

module.exports = function (value) {
    return statusTypes[value];
};
