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
                        <p>Full name<span v-on:click="activateInEditMode('name')" v-show="isEditing!=='name'">{{User.state.auth.name}}</span>
                            <span v-show="isEditing=='name'" >
                             <input v-model="User.state.auth.name" type="text" class="form-control" @blur="activateInEditMode(undefined)" @keyup="track">
                            </span>
                        </p>
                        <p>E-mail<span>{{User.state.auth.email}}</span></p>
                        <p>Phone no.<span v-on:click="activateInEditMode('phone')" v-show="isEditing!=='phone'">{{User.state.auth.phone}}</span>
                            <span v-show="isEditing=='phone'" >
                             <input v-model="User.state.auth.phone" type="text" class="form-control" @blur="activateInEditMode(undefined)" v-on:keyup="track('phone')">
                            </span>
                        </p>
                        <p v-if="User.state.auth.insurance">NINo.
                            <span v-on:click="activateInEditMode('NINo')" v-show="isEditing!=='NINo'">{{User.state.auth.insurance}}</span>
                            <span v-show="isEditing=='NINo'" >
                             <input v-model="User.state.auth.insurance" type="text" class="form-control" @blur="activateInEditMode(undefined)" v-on:keyup="track('insurance')">
                            </span>
                        </p>
                        <p v-if="User.state.auth.driving">Driver’s license no.
                            <span v-on:click="activateInEditMode('driving')" v-show="isEditing!=='driving'">{{User.state.auth.driving}}</span>
                            <span v-show="isEditing=='driving'" >
                             <input v-model="User.state.auth.driving" type="text" class="form-control" @blur="activateInEditMode(undefined)" v-on:keyup="track('driving')">
                            </span>
                        </p>
                        <p v-if="User.state.auth.postcode">Postcode on license
                            <span v-on:click="activateInEditMode('postcode')" v-show="isEditing!=='postcode'">{{ User.state.auth.postcode }}</span>
                            <span v-show="isEditing=='postcode'" >
                             <input v-model="User.state.auth.postcode" type="text" class="form-control" @blur="activateInEditMode(undefined)" v-on:keyup="track('postcode')">
                            </span>
                        </p>
                        <p v-if="User.state.auth.pco_number">PCO cerSficate no.
                            <span v-on:click="activateInEditMode('pco_number')" v-show="isEditing!=='pco_number'">{{User.state.auth.pco_number}}</span>
                            <span v-show="isEditing=='pco_number'" >
                             <input v-model="User.state.auth.pco_number" type="text" class="form-control" @blur="activateInEditMode(undefined)" v-on:keyup="track('pco_number')">
                            </span>
                        </p>
                        <p v-if="User.state.auth.pco_expiry_date">PCO cerSficate exp. date
                            <span v-on:click="activateInEditMode('pco_expiry')" v-show="isEditing!=='pco_expiry'">
                                {{date_format(User.state.auth.pco_expiry_date)}}
                            </span>
                            <span v-show="isEditing=='pco_expiry'" >
                             <input v-model="User.state.auth.pco_expiry_date" type="text" class="form-control" @blur="activateInEditMode(undefined)" v-on:keyup="track('pco_expiry_date')">
                            </span>
                        </p>
                    </li>
                    <li v-if="isEditing===undefined">
                        <button type="button" class="btn btn-success btn-block" @click="updateSettings"> Update Settings</button>
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
                isEditing: false,
                track: [],
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
                return moment.utc(date).format("D.M.Y");
            },
            logout(){
                window.location="/logout";
            },
            activateInEditMode(param) {
                this.isEditing = param
            },
            deActivateInEditMode() {
                this.isEditing = false
            },
            track(){
                console.log("hal");
            },
            updateSettings(){
                axios.patch(
                    '/api/profile/'+User.state.auth.type,
                    this.params()
                ).then(function (r) {
                    $scope.isEditing=false;
                });
            },
            params(){
               var params = User.state.auth;
               delete params.email;
               return params;
            }
        }
    }
</script>
