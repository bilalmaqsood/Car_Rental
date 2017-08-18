
import Vuex from 'vuex';
import mutations from './mutations';

const state = {
    auth: null,
    home: true,
    bookNow: false,
    menuView: false,
    searchView: false,
    authSection: false,
    showAdvance: false,
    detailsDisplay: false,
    searchResults: [],
    vehicleData: {},
    bookingData: {},
    currentBook: null
};

export default new Vuex.Store({
    state,
    mutations
});
