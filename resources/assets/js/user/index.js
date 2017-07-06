
import Vuex from 'vuex';
import mutations from './mutations';

const state = {
    auth: null,
    bookNow: false,
    searchView: false,
    showAdvance: false,
    detailsDisplay: false,
    searchResults: []
};

export default new Vuex.Store({
    state,
    mutations
});
