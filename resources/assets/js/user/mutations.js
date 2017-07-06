
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

    details (state, bool) {
        if (!bool)
            state.bookNow = false;

        state.detailsDisplay = bool;
    },

    booking (state, bool) {
        state.bookNow = bool;
    },

    listing (state, data) {
        state.searchResults = data;
    }

}
