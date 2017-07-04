<template>
    <div class="search_map">
        <div class="main_profile_container text-left" :style="{ height: profileHeight + 'px' }">
            <div class="profile_top_content">
                <img src="/images/hero-img.jpg" alt="">
                <div class="update_ropfile">
                    <h3>Andrei Stanescu</h3>
                    <p><span>Age: <i>29</i></span><span> Uber ra5ng: <i>4.6</i></span><span>07402046843</span></p>
                    <button class="secodery_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="pofile_content_wrapper">
                <div class="img_box" style="background: url(/images/car_img_1.png)">
                    <img src="/images/car_img_1.png" alt="">
                </div>
                <div class="profile_content">
                    <h3>Booking approved</h3>
                    <p><span>Mike Myers</span> approved your request to book</p>
                    <p>Toyota Prius 1.8 Hybrid</p>
                    <p>Contract start: 06.05.2017 </p>
                    <p>Contract end: 20.05.2017</p>
                    <p>You can now check and sign the contract and set your <span>Direct Debit.</span> A deposit of <span>£250.00</span> have been taken from your card ending in <span>1234</span></p>
                </div>
            </div>
            <div class="pofile_content_wrapper oring_border">
                <div class="profile_content">
                    <h3>Contract ending</h3>
                    <p>Your contract for <span>Toyota Prius 1.8 Hybrid</span> will end in <span>1 day(s) - Contract ending:</span> 06.05.2017</p>
                    <p>You can request to extend or renew the contract. If you do not take any acHons, then please return the vehicle at the pre-set date and locaHon.</p>
                </div>
            </div>
            <div class="pofile_content_wrapper green_border">
                <div class="profile_content">
                    <h3>You have new messages</h3>
                    <p>On 05.05.2017 <span>Mike Myers</span> wrote:</p>
                    <p>Hello Andrei. I made the required changes to the contract and it is ready for you to sign it. If you have any further inquiries, do not hesitate to get in touch. </p>
                </div>
            </div>
            <div class="pofile_content_wrapper white_boredr">
                <div class="img_box" style="background: url(/images/car_img_1.png)">
                    <img src="/images/car_img_1.png" alt="">
                </div>
                <div class="profile_content">
                    <h3>Request unsuccessfull</h3>
                    <p>Unfortunately, your request to book</p>
                    <p><span>Toyota Prius 1.8 Hybrid </span></p>
                    <p>has beenunsuccessful.</p>
                    <p>Please check our vehicles database for a similar vehicle that you can book.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['profileHeight'],

        data() {
            return {};
        },

        mounted() {
            console.log(this.profileHeight);
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                console.log('profile componenet mounted');
            }
        }
    }
</script>
