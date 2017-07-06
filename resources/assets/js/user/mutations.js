
export default {

    update (state, user) {
        state.auth = user;
    },

    view (state) {
        state.searchView = !state.searchView;
    },

    advance (state) {
        state.showAdvance = !state.showAdvance;
    },

    listing (state, data) {
        state.searchResults = data;
    }

}
