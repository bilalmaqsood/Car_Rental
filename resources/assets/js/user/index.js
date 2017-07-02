
import Vuex from 'vuex';
import mutations from './mutations';

const state = {
    auth: null
};

export default new Vuex.Store({
    state,
    mutations
});
