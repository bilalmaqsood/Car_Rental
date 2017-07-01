
import Vuex from 'vuex';

const states = {
    count: 0
};

export default new Vuex.Store({
    state: states,
    mutations: {
        increment (state) {
            state.count++
        }
    }
});
