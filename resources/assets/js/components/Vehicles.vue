<template>
    <div class="search_map">
        <div class="vehicles_container">
            <div class="car_detail_container">
                <div class="detail_img">
                    <img src="/images/car_img.png" alt="">
                </div>
                <div class="booking_tab">
                    <ul class="nav nav-tabs">
                        <li>
                            <a data-toggle="tab" href="#car_inspection">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                add new
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#extend_cancel">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
                                </svg>
                                edit vehicle
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#chat_tab">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#delete_icon"></use>
                                </svg>
                                delete
                            </a>
                        </li>
                    </ul>

                    <vehicle-input-form></vehicle-input-form>
                </div>
                <div class="car_detail">
                    <div class="availablity_detail">
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li>
                                <p>Year: 2015 </p>
                                <p>Mileage: 35,044</p>
                                <p>Seats: 5 </p>
                                <p>Transmission: manual</p>
                            </li>
                            <li>
                                <p>Seats: 5 </p>
                                <p>Transmission: manual</p>
                            </li>
                            <li>
                                <p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p>
                            </li>
                        </ul>
                        <div class="availabe">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                            </svg>
                            <p>available from: <span>16.05.2017</span></p>
                        </div>
                    </div>
                    <div class="availablity_price">
                        <div class="availabe_item_price">
                            <h3>£ 320</h3>
                            <span>/week</span>
                            <span>insurance included</span>
                        </div>
                    </div>
                </div>
                <div class="pickup_loction">
                    <button class="secodery_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                    </button>
                    <ul>
                        <li><span>Pickup from:</span> 45, King William Street, London, EC4r 9AN, UK</li>
                        <li><span>Return to:</span> 45, King William Street, London, EC4r 9AN, UK</li>
                    </ul>
                </div>
                <div class="pickup_loction_map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4825851.352956702!2d-4.064941!3d53.800650999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2suk!4v1495513518623" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <p>Phasellus nisi leo, aliquet ac erat ut, moles2e ma3s enim. Proin sit amet tempor mi, a egestas tortor. Ves2bulum et congue urna. Nunc elementum por3tor
                        urna sed euismod. Curabitur bibendum leo iaculis pulvinar fringilla. Nullam eu interdum lectus. Duis posuere, enim at fermentum efficitur, magna nisl lobor2s
                        metus, in hendrerit est ante et magna. Ut ma3s, justo non por3tor suscipit, augue ipsum sodales justo, a rutrum.</p>
                </div>
                <div class="pickup_loction_datebox">
                    <div class="availabe">
                        <p>John Doe <span>16.05.2017</span></p>
                    </div>
                    <div class="ratting" data-score="1"></div>
                </div>
                <div class="pofile_content_wrapper">
                    <div class="img_box" style="background: url(images/car_img_1.png)">
                        <img src="/images/car_img_1.png" alt=""/>
                    </div>
                    <div class="profile_content">
                        <h3>Booking approved</h3>
                        <p><span>Mike Myers</span> approved your request to book</p>
                        <p>Toyota Prius 1.8 Hybrid</p>
                        <p>Contract start: 06.05.2017 </p>
                        <p>Contract end: 20.05.2017</p>
                        <p>
                            You can now check and sign the contract and set your
                            <span>Direct Debit.</span> A deposit of <span>£250.00</span> have been taken
                            from your card ending in <span>1234</span>
                        </p>
                    </div>
                </div>
                <div class="pofile_content_wrapper">
                    <div class="img_box" style="background: url(images/car_img_1.png)">
                        <img src="/images/car_img_1.png" alt=""/>
                    </div>
                    <div class="profile_content">
                        <h3>Booking approved</h3>
                        <p><span>Mike Myers</span> approved your request to book</p>
                        <p>Toyota Prius 1.8 Hybrid</p>
                        <p>Contract start: 06.05.2017 </p>
                        <p>Contract end: 20.05.2017</p>
                        <p>
                            You can now check and sign the contract and set your
                            <span>Direct Debit.</span> A deposit of <span>£250.00</span> have been taken
                            from your card ending in <span>1234</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['profileHeight'],

        data() {
            return {
                notifications: ''
            };
        },

        mounted() {
            let $scope = this;

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

            propExist(obj, prop){
                return obj.hasOwnProperty(prop);
            },

            date_format(date){
                return moment.utc(date.date).format("D.M.Y");
            }
        }
    }
</script>
