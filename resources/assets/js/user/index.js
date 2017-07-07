
import Vuex from 'vuex';
import mutations from './mutations';

const state = {
    auth: null,
    bookNow: false,
    searchView: false,
    authSection: false,
    showAdvance: false,
    detailsDisplay: false,
    searchResults: [],
    vehicleData: {},
    bookingData: {}
};

export default new Vuex.Store({
    state,
    mutations
});
