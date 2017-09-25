
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./locationpicker.jquery');

window.Bloodhound = require('./typeahead');

require('./design');

require('jq-signature');

require('./FetchLocationName');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('pdf-document', require('./components/PDFDocument.vue'));
Vue.component('app-header', require('./components/Header.vue'));
Vue.component('home-page', require('./components/HomePage.vue'));
Vue.component('user-register', require('./components/Register.vue'));
Vue.component('user-profile', require('./components/Profile.vue'));
Vue.component('vehicles-search-form', require('./components/SearchForm.vue'));
Vue.component('advance-form', require('./components/AdvanceForm.vue'));
Vue.component('search-listing', require('./components/SearchListing.vue'));
Vue.component('search-listing-details', require('./components/SearchListingDetails.vue'));
Vue.component('contact-us-form', require('./components/ContactForm.vue'));
Vue.component('search-listing-booking', require('./components/BookVehicle.vue'));
Vue.component('top-vehicles-listing', require('./components/TopVehicleListing.vue'));
Vue.component('user-settings', require('./components/Settings.vue'));
Vue.component('vehicle-crud', require('./components/Vehicles.vue'));
Vue.component('vehicle-input-form', require('./components/VehiclesInputForm.vue'));
Vue.component('booking-listing', require('./components/BookingListing.vue'));
Vue.component('booking', require('./components/BookingDetail.vue'));
Vue.component('past-booking', require('./components/PastBookingDetail.vue'));
Vue.component('car-inspection', require('./components/CarInspection.vue'));
Vue.component('car-return-inspection', require('./components/CarReturnInspection.vue'));
Vue.component('booking-documents', require('./components/Documents.vue'));
Vue.component('chat-booking', require('./components/Chat.vue'));
Vue.component('extend-cancel-booking', require('./components/ExtendCancel.vue'));
Vue.component('early-cancel-booking', require('./components/EarlyCancelation.vue'));
Vue.component('payment-card-listing', require('./components/PaymentCards.vue'));
Vue.component('payment-card-form', require('./components/CardForm.vue'));
Vue.component('financial', require('./components/Financial.vue'));
Vue.component('vehicle-contract', require('./components/VehicleContract.vue'));
Vue.component('vehicle-timeslots', require('./components/VehicleTimeslots.vue'));
Vue.component('location-coordinates-picker', require('./components/LocationPicker.vue'));
Vue.component('sign-contract', require('./components/SignContract.vue'));
Vue.component('vehicle-location', require('./components/VehicleLocation.vue'));
Vue.component('register-terms', require('./components/RegisterTerms.vue'));
Vue.component('update-documents', require('./components/UpdateDocuments.vue'));
Vue.component('driver-profile', require('./components/DriverInfo.vue'));
Vue.component('vehicles-listing', require('./components/VehicleListing.vue'));
Vue.component('map-markers', require('./components/MapMarkers.vue'));

Vue.component('vehicle-input-form-copy', require('./components/VehiclesInputFormCopy.vue'));



/**
 * seprate components for notifications
 */
Vue.component('booking-request', require('./components/notifications/BookingRequest.vue'));
Vue.component('booking-request-pending', require('./components/notifications/BookingRequestPending.vue'));
Vue.component('booking-request-pending-driver', require('./components/notifications/BookingRequestPendingDriver.vue'));
Vue.component('booking-unsuccessfull', require('./components/notifications/BookingUnsuccessfull.vue'));
Vue.component('booking-approved', require('./components/notifications/BookingApproved.vue'));
Vue.component('booking-decline', require('./components/notifications/BookingDecline.vue'));
Vue.component('booking-closed', require('./components/notifications/BookingClosed.vue'));
Vue.component('booking-closing', require('./components/notifications/BookingClosing.vue'));
Vue.component('booking-extend', require('./components/notifications/BookingExtend.vue'));
Vue.component('booking-extended', require('./components/notifications/BookingExtended.vue'));
Vue.component('booking-extend-declined', require('./components/notifications/BookingExtendDeclined.vue'));
Vue.component('booking-cancel-request', require('./components/notifications/BookingCancelRequest.vue'));
Vue.component('booking-cancel-approved', require('./components/notifications/BookingCancelApproved.vue'));
Vue.component('booking-rating', require('./components/notifications/BookingRating.vue'));
Vue.component('booking-signature-client', require('./components/notifications/BookingSignatureClient.vue'));
Vue.component('booking-signature-owner', require('./components/notifications/BookingSignatureOwner.vue'));
Vue.component('booking-deposit', require('./components/notifications/BookingDeposit.vue'));
Vue.component('booking-deposit-return', require('./components/notifications/BookingDepositReturn.vue'));
Vue.component('booking-payment-made', require('./components/notifications/BookingPayment.vue'));




Vue.filter('date', require('./filters/date'));
Vue.filter('currency', require('./filters/currency'));
Vue.filter('bookingStatus', require('./filters/booking-status'));

const app = new Vue({
    el: '#app'
});
