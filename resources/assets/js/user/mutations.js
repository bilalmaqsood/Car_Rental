
export default {

    update (state, user) {
        state.auth = user;
    },

    listing (state, data) {
        state.searchResults = data;
    }

}
