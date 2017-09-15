
import Vuex from 'vuex';
import mutations from './mutations';

const state = {
    auth: null,
    home: true,
    bookNow: false,
    menuView: false,
    searchView: false,
    oldView: false,
    authSection: false,
    showAdvance: false,
    detailsDisplay: false,
    searchResults: [],
    vehicleData: {},
    bookingData: {},
    currentBook: null,
    highlighted: null,
};

export default new Vuex.Store({
    state,
    mutations
});
