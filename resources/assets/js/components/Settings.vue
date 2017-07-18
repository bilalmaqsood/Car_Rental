<template>
    <div class="main_profile_container">
        <div class="setting_wrapper">
            <ul>
                <li class="settings-form">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                    </svg>
                    <span>Profile settings</span>
                    <p>
                        Full name<span v-on:click="activateInEditMode('name')" v-show="isEditing!=='name'">{{User.state.auth.name}}</span>
                        <span v-show="isEditing=='name'">
                            <input v-model="User.state.auth.name" type="text" class="form-control name" @blur="activateInEditMode(null)" @keyup="track">
                        </span>
                    </p>
                    <p>E-mail<span>{{User.state.auth.email}}</span></p>
                    <p>
                        Phone no.<span v-on:click="activateInEditMode('phone')" v-show="isEditing!=='phone'">{{User.state.auth.phone ? User.state.auth.phone : 'no data'}}</span>
                        <span v-show="isEditing=='phone'">
                             <input v-model="User.state.auth.phone" type="text" class="form-control phone" @blur="activateInEditMode(null)" v-on:keyup="track('phone')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.insurance !== 'undefined'">NINo.
                        <span v-on:click="activateInEditMode('NINo')" v-show="isEditing!=='NINo'">{{User.state.auth.insurance ? User.state.auth.insurance : 'no data'}}</span>
                        <span v-show="isEditing=='NINo'">
                             <input v-model="User.state.auth.insurance" type="text" class="form-control insurance" @blur="activateInEditMode(null)" v-on:keyup="track('insurance')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.driving !== 'undefined'">Driver’s license no.
                        <span v-on:click="activateInEditMode('driving')" v-show="isEditing!=='driving'">{{User.state.auth.driving ? User.state.auth.driving : 'no data'}}</span>
                        <span v-show="isEditing=='driving'">
                             <input v-model="User.state.auth.driving" type="text" class="form-control driving" @blur="activateInEditMode(null)" v-on:keyup="track('driving')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.postcode !== 'undefined'">Postcode {{User.state.auth.type == 'client' ? 'on license' : ''}}
                        <span v-on:click="activateInEditMode('postcode')" v-show="isEditing!=='postcode'">{{ User.state.auth.postcode ? User.state.auth.postcode : 'no data'}}</span>
                        <span v-show="isEditing=='postcode'">
                             <input v-model="User.state.auth.postcode" type="text" class="form-control postcode" @blur="activateInEditMode(null)" v-on:keyup="track('postcode')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.pco_number !== 'undefined'">PCO certificate no.
                        <span v-on:click="activateInEditMode('pco_number')" v-show="isEditing!=='pco_number'">{{User.state.auth.pco_number ? User.state.auth.pco_number : 'no data'}}</span>
                        <span v-show="isEditing=='pco_number'">
                             <input v-model="User.state.auth.pco_number" type="text" class="form-control pco_number" @blur="activateInEditMode(null)" v-on:keyup="track('pco_number')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.company !== 'undefined'">Company
                        <span v-on:click="activateInEditMode('company')" v-show="isEditing!=='company'">{{User.state.auth.company ? User.state.auth.company : 'no data'}}</span>
                        <span v-show="isEditing=='company'">
                             <input v-model="User.state.auth.company" type="text" class="form-control company" @blur="activateInEditMode(null)" v-on:keyup="track('company')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.street !== 'undefined'">Street
                        <span v-on:click="activateInEditMode('street')" v-show="isEditing!=='street'">{{User.state.auth.street ? User.state.auth.street : 'no data'}}</span>
                        <span v-show="isEditing=='street'">
                             <input v-model="User.state.auth.street" type="text" class="form-control street" @blur="activateInEditMode(null)" v-on:keyup="track('street')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.address !== 'undefined'">Address
                        <span v-on:click="activateInEditMode('address')" v-show="isEditing!=='address'">{{User.state.auth.address ? User.state.auth.address : 'no data'}}</span>
                        <span v-show="isEditing=='address'">
                             <input v-model="User.state.auth.address" type="text" class="form-control address" @blur="activateInEditMode(null)" v-on:keyup="track('address')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.town !== 'undefined'">Town
                        <span v-on:click="activateInEditMode('town')" v-show="isEditing!=='town'">{{User.state.auth.town ? User.state.auth.town : 'no data'}}</span>
                        <span v-show="isEditing=='town'">
                             <input v-model="User.state.auth.town" type="text" class="form-control town" @blur="activateInEditMode(null)" v-on:keyup="track('town')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.country !== 'undefined'">Country
                        <span v-on:click="activateInEditMode('country')" v-show="isEditing!=='country'">{{User.state.auth.country ? User.state.auth.country : 'no data'}}</span>
                        <span v-show="isEditing=='country'">
                             <input v-model="User.state.auth.country" type="text" class="form-control country" @blur="activateInEditMode(null)" v-on:keyup="track('country')">
                        </span>
                    </p>
                    <p v-if="typeof User.state.auth.pco_expiry_date !== 'undefined'">PCO certificate exp. date
                        <span v-on:click="activateInEditMode('pco_expiry')" v-show="isEditing!=='pco_expiry'">
                                {{User.state.auth.pco_expiry_date | date}}
                        </span>
                        <span v-show="isEditing=='pco_expiry'">
                             <input v-model="User.state.auth.pco_expiry_date" type="text" class="form-control pco_expiry" @blur="activateInEditMode(null)" v-on:keyup="track('pco_expiry_date')">
                        </span>
                    </p>
                </li>
                <li v-if="verifyAuth">
                    <button type="button" class="btn btn-success btn-block" @click="updateSettings"> Update Settings</button>
                </li>
                <li @click="terms = !terms" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                    </svg>
                    <span>Terms &amp; Conditions</span>
                </li>
                <transition name="flip">
                    <li v-if="terms">
                        <p>{{termsContent}}</p>
                    </li>
                </transition>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                    </svg>
                    <span>Privacy Policy</span>
                </li>
                <li @click="logout" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#log_out_icon"></use>
                    </svg>
                    <span>Log out</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import User from '../user';

    export default {
        data() {
            return {
                User: User,
                terms: false,
                termsContent: '',
                isEditing: false,
                track: [],
                clone: JSON.stringify(User.state.auth)
            };
        },

        computed: {
            verifyAuth() {
                return this.clone !== JSON.stringify(User.state.auth);
            }
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                console.log('profile componenet mounted');
                axios.get('/api/terms/app').then(this.termsPlaced);
            },

            termsPlaced(r) {
                this.termsContent = r.data.success;
            },

            logout() {
                window.location.href = '/logout';
            },

            activateInEditMode(param) {
                this.isEditing = param;

                if (param)
                    setTimeout(function () {
                        $('.form-control.' + param).focus();
                    }, 90);
            },

            deActivateInEditMode() {
                this.isEditing = false
            },

            track() {
                console.log("hal");
            },

            updateSettings() {
                let $scope = this;
                axios.patch(
                    '/api/profile/' + User.state.auth.type,
                    this.params()
                ).then(function (r) {
                    $scope.isEditing = false;
                });
            },

            params() {
                let params = {};

                _.each(User.state.auth, function (v, k) {
                    if (
                        k !== 'email' &&
                        k !== 'device_id' &&
                        k !== 'created_at' &&
                        k !== 'type' &&
                        k !== 'accounts' &&
                        k !== 'credit_cards' &&
                        v
                    )
                        params[k] = v;
                });

                return params;
            }
        }
    }
</script>
