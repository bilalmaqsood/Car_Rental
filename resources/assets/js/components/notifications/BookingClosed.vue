<template>
    <div class="booking-request-actions notification-shadow">
        <div class="inlane-btn-wrap inlane-btn-wrap-btn3">
            <ul class="three-btn-inlane">
                <li>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg>
                        view driver
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                        </svg>
                        approve
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close_icon"></use></svg>
                        decline
                    </a>
                </li>
            </ul>
        </div>
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_successfull">
            <div class="driver-profile-text">
                <h3>Booking terminated</h3>
                <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p>
                <p><b>Contract start:</b> 20.8.2017 </p>
                <p><b>Contract end:</b> 26.8.2017</p>
            </div>
        </div>
    </div>
</template>

<script>
    import User from '../../user';

    export default {
        data() {
            return {

            };
        },

        computed: {

        },

        mounted() {

            this.prepareComponent();
        },

        methods: {

        }
    }
</script>
