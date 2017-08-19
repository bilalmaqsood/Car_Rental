<template>
    <transition name="slide-fade" mode="out-in">
        <div v-if="storage.state.home && !details" key="home-page">
            <div class="slide_wrapper">
                <div class="top_location">
                    <vehicles-search-form @showListing="switchToListing"></vehicles-search-form>
                </div>
            </div>


            <top-vehicles-listing @vehicleSelect="itemDetails"></top-vehicles-listing>

            <div class="about_section_wrapper" id="about_section_wrapper">
                <h2>About Qwik<span>k</span>ar</h2>
                <div class="about_content_section">
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis convallis iactulis commodo. Nam augue lacus, tempor id metus sed, dignissim imperdiet nunc. Cras preEum
                        tellus sit amet congue vehicula. Nunc commodo molesEe elit at consectetur. Fusce varius justo sed sagiHs consequat. Nulla eget lacus id odio Encidunt mollis gravida
                        sagiHs enim. Duis preEum nulla augue, pulvinar placerat nulla consectetur ut. Nulla vitae purus ante. Praesent nec dui nunc. Suspendisse potenE.</p>
                    <p>Nunc volutpat vehicula erat at facilisis. Quisque congue et turpis non maHs. Quisque egestas eleifend purus, eu finibus magna. In cursus fringilla leo consequat sollicitudin.
                        Nunc in massa orci. Aenean pulvinar egestas rutrum. Aliquam elit libero, porta ac neque ut, fringilla laoreet lectus. Sed ut metus vitae risus iaculis vulputate. Curabitur
                        preEum turpis nec velit commodo, nec egestas quam fringilla. Cras molesEe turpis eu lacus fringilla sodales. EEam a vesEbulum felis. Suspendisse laoreet dignissim nibh in
                        posuere. Aenean a nisl dignissim, hendrerit magna vitae, interdum nisi. Suspendisse volutpat tortor vel libero dignissim, a viverra ex gravida.</p>
                </div>
            </div>

            <contact-us-form></contact-us-form>

            <div class="footer_wrapper">
                <p>Copyright 2017 @ qwikkar ltd. All rights reserved</p>
            </div>
        </div>

        <search-listing key="search-listing" v-else></search-listing>
    </transition>
</template>

<script>
    import Local from '../local';
    import User from '../user';

    export default {
        data() {
            return {
                details: false,
                storage: User
            };
        },

        mounted() {
        },

        methods: {
            prepareComponent() {
                console.log('home page componenet');
                let searchResults = Local.get('searchResults');
                if (searchResults && searchResults.length) {
                    User.commit('listing', searchResults);
                    this.switchToListing();
                } else
                    localStorage.removeItem('reloadData');
            },

            switchToListing() {
                User.commit('home', false);
            },
        
        itemDetails(item) {
                User.commit('details', false);
                let $t = this;
                let $s = $('#sideLoader').show();
                axios
                    .get('/api/vehicle/' + item.id)
                    .then(response => {
                        setTimeout(function () {
                            $s.hide();
                            $t.details = true;
                        }, 500);
                        User.commit('view', true);
                        User.commit('listing', [response.data.success]);
                    });
            }
        }
    }
</script>
