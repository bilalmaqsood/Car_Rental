
import Vuex from 'vuex';
import mutations from './mutations';

const state = {
    auth: null
};

export const User = new Vuex.Store({
    state,
    mutations
});

export const App = new Vuex.Store({
    state: window.Qwikkar
});
