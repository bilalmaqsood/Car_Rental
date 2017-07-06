
import Vuex from 'vuex';
import mutations from './mutations';

const state = {
    auth: null,
    searchView: false,
    showAdvance: false,
    searchResults: []
};

export default new Vuex.Store({
    state,
    mutations
});
