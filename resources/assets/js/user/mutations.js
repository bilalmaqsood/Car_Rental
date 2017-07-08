
export default {

    updateAuthView (state) {
        state.authSection = !state.authSection;
    },

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
    },

    vehicle (state, data) {
        state.vehicleData = data;
    },

    location (state, data) {
        state.vehicleData[data.type] = data.value;
    },

    saveBooking (state, data) {
        state.bookingData = data;
    }
}
