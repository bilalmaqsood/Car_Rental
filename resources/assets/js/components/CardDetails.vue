<template>
    <div class="car_detail_container">
        <div class="fill_card">

        </div>
        <div class="card_recured">
            <ul>
                <li>
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                        </svg>
                        <input type="text" class="form-control" placeholder="name on card">
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                        </svg>
                        <input type="text" class="form-control" placeholder="card number">
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                        <input type="text" class="form-control" placeholder="card expira/on date">
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                        </svg>
                        <input type="password" class="form-control" placeholder="password">
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                        <input type="text" class="form-control" placeholder="billing address">
                    </div>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                    </svg>
                    <p>I have read and understood the</p>
                    <a href="#">Terms & Conditions</a>
                </li>
            </ul>
        </div>
        <div class="car_cost_tabel">
            <ul>
                <li>
                    <p><label>Rental cost </label><label>£649.60</label></p>
                    <span>14 days * £46.40</span>
                </li>
                <li>
                    <p><label>Insurance</label><label>£318.92</label></p>
                    <span>14 days * £22.78</span>
                </li>
                <li>
                    <p><label>Deposit</label><label>£250.00</label></p>
                    <span>will be paid when placing the request</span>
                </li>
                <li>
                    <p><label>Total</label><label>£1218.52</label></p>
                    <span>amount that will be paid by the end of the contract</span>
                </li>
            </ul>
            <button class="secodery_btn" onclick="location.href='profile.html'"  type="button" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                </svg>
                <span>Confirm deposit payment</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['vehicle','start_date','end_date',],
        data() {
          return {
              isBooking: false,

             };
        },

        mounted() {

        },

        methods:{

        }
    }
</script>
