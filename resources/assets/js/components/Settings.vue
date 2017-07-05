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
                        <p>Full name<span>{{User.state.auth.name}}</span></p>
                        <p>E-mail<span>{{User.state.auth.email}}</span></p>
                        <p>Phone no.<span>{{User.state.auth.phone}}</span></p>
                        <p v-if="User.state.auth.insurance">NINo.<span>{{User.state.auth.insurance}}</span></p>
                        <p v-if="User.state.auth.driving">Driver’s license no.<span>{{User.state.auth.driving}}</span></p>
                        <p v-if="User.state.auth.postcode">Postcode on license<span>{{ User.state.auth.postcode }}</span></p>
                        <p v-if="User.state.auth.pco_number">PCO cerSficate no.<span>{{User.state.auth.pco_number}}</span></p>
                        <p v-if="User.state.auth.pco_expiry_date">PCO cerSficate exp. date<span>{{date_format(User.state.auth.pco_expiry_date)}}</span></p>
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
                    <li @click="logout" style="cursor: pointer;">
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
                User: User,
            };
        },

        mounted() {
            $scope=this;
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                console.log('profile componenet mounted');
            },

            date_format(date){
                return moment(date).format("D.M.Y");
            },
            logout(){
                window.location="/logout";
            }
        }
    }
</script>
