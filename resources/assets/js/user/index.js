
import Vuex from 'vuex';
import mutations from './mutations';

const state = {
    auth: null,
    searchResults: []
};

export default new Vuex.Store({
    state,
    mutations
});
