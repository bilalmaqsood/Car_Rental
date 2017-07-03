<template>
    <div>
    <div v-show="!isBooking" class="car_detail_container">
        <div class="car_detail_clander">
            <ul>
                <li>
                    <div class="book_now_calender">
                        <p>Select first and last day of booking</p>
                        <div style="overflow:hidden;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" id="datetimepicker12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#tag_icon"></use>
                    </svg>
                    <span>promoGonal code</span>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                    </svg>
                    <span>Pick up from: 45, King William Street, London, Ec4r 9AN, UK. </span>
                </li>
                <li>
                    <div class="pickup_loction_map">
                        <iframe width="100%" height="450" frameborder="0" style="border:0" v-bind:src="'https://www.google.com/maps/embed/v1/place?q='+vehicle.location.split(',')[0]+','+vehicle.location.split(',')[1]+'&amp;key=AIzaSyDFkedYDgj286xDo9Sp9XRWsOiPfu9T3Ak'"></iframe>
                    </div>
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
            <button class="secodery_btn" @click="processBooking"  type="button" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                </svg>
                <span>Proceed to deposit</span>
            </button>
        </div>
    </div>
        <search-listing-card-details v-show="isBooking" :start_date="start_date" :end_date="end_date" :vehicle="vehicle"></search-listing-card-details>

    </div>
</template>

<script>
    export default {
        props: ['vehicle'],
        data() {
          return {
              isBooking: false,
              start_date: "",
              end_date: "",
             };
        },

        mounted() {
            var start_date="";
            var end_date="";
           window.vm=this;
          window.picker =  $('#datetimepicker12').datetimepicker({
                inline: true,
                sideBySide: false
            });

          picker.on("dp.change",function (event) {


              if(start_date.length<=0)
                  start_date = event.date.format("Y-M-D");
              else if(end_date.length<=0)
              end_date = event.date.format("Y-M-D");

              vm.start_date=start_date;
              vm.end_date=end_date;

                console.log("end_date"+end_date+"& start_date"+start_date);

          });
        },

        methods:{
            processBooking(){
                this.isBooking=true;
            }
        }
    }
</script>

<style>
    .table-condensed{
        width: 100%;
    }
</style>