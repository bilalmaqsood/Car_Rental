<template>
    <div class="search_map">
        <div class="main_profile_container" :style="{ height: profileHeight + 'px' }">

            <div class="setting_wrapper">
                <ul>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                        </svg>
                        <span>Profile settings</span>
                        <p>Full name<span>John Doe</span></p>
                        <p>E-mail<span>Johndoe@e-mail.com</span></p>
                        <p>Phone no.<span>0123 456 7890</span></p>
                        <p>NINo.<span>SS01234567D</span></p>
                        <p>Driver’s license no.<span>DOEJ01233245756734R</span></p>
                        <p>Postcode on license<span>EC4r 9AN</span></p>
                        <p>PCO cerSficate no.<span>9817283561726543827</span></p>
                        <p>PCO cerSficate exp. date<span>01.05.2020</span></p>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                        </svg>
                        <span>Terms & Conditions</span>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                        </svg>
                        <span>Privacy Policy</span>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#log_out_icon"></use>
                        </svg>
                        <span>Log out</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>
    import User from '../user';

    var $scope;
    export default {
        props: ['profileHeight'],

        data() {
            return {
                notifications: "",
                User: User,
            };
        },

        mounted() {
            console.log(User.state);
            $scope=this;
            console.log(this.profileHeight);
            this.prepareComponent();
            axios.get('/api/notifications')
                .then(function (response) {
                    $scope.notifications = response.data.success;
                });
        },

        methods: {
            prepareComponent() {
                console.log('profile componenet mounted');
            },
            isBooking(notification){
                return notification.data.type=='Booking';
            },
            date_format(date){
                return moment(date.date).format("D.M.Y");
            }
        }
    }
</script>
