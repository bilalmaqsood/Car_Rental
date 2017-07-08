const LocalProcess = {
    get(type) {
        let localData = LocalProcess.storage();

        return (localData && typeof localData[type] !== 'undefined') ? localData[type] : '';
    },

    storage() {
        let localData = localStorage.reloadData;

        if (localData)
            localData = JSON.parse(localData);

        return localData;
    }
};

export default LocalProcess;
