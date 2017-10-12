
export default {

    updateCurrentBook (state, id) {
        state.currentBook = id;
    },

    updateAuthView (state) {
        state.authSection = !state.authSection;
    },

    update (state, user) {
        state.auth = user;
    },

    home (state, show) {
        state.home = show;
    },

    view (state, show) {
        state.searchView = show;
    },

    menuView (state, viewName) {
        state.menuView = viewName;
    },

    advance (state) {
        state.showAdvance = !state.showAdvance;
    },
    oldView(state,viewName){
        state.oldView = viewName;
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
    },
    highlight (state, data) {
        state.highlighted = data;
    },
    cleanChatMessage (state, index) {
        state.chatUsers[index].messages = [];
    },

    addChatMessage (state, data) {
        state.chatUsers[data.chatIndex].messages.push(data.message);
    },

    addChatUser (state, user) {
        state.chatUsers.push(user);
    },

    delChatUser (state, index) {
        state.chatUsers.splice(index, 1);
    },
}
