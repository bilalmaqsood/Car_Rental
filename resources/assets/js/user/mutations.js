
export default {

    updateAuthView (state) {
        state.authSection = !state.authSection;
    },

    update (state, user) {
        state.auth = user;
    },

    home (state) {
        state.home = !state.home;
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
    },

    vehicle (state, data) {
        state.vehicleData = data;
    },

    saveBooking (state, data) {
        state.bookingData = data;
    }
}
