<template>
<div>
 
    <div class="driver-profile-wrap" v-if="info">
        <div class="driver-profile-content-wrap">
            <div class="driver-profile-img">
                <img :src="info.avatar" alt="" style="width: auto;">
            </div>
            <div class="driver-status">
                <h3>{{info.name}}</h3>
                <p><span>Age: <i>{{ age }}</i></span><span> Uber rating: <i>4.6</i></span><span>{{info.phone }}</span></p>
            </div>
        </div>
        <div class="driver-detail-wrap">
            <ul>
                <li>
                    <div class="driver-detail-text">
                        <p>Date of birth</p>
                        <h5>{{ info.client.dob | date('format', 'MMMM DD YYYY') }}</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>NINo</p>
                        <h5>{{ info.client.insurance?info.client.insurance:"N/A" }}</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use></svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>PCO cert. no.</p>
                        <h5>{{ info.client.pco_number?info.client.pco_number:"N/A" }}</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use></svg> 
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>PCO cert. release</p>
                        <h5>{{ info.client.pco_release_date | date('format', 'dd mm YYYY') }}</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>PCO cert. exp.</p>
                        <h5>{{ info.client.pco_expiry_date | date('format', 'dd mm YYYY') }}</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>Driver license</p>
                        <h5>{{ info.client.driving }}</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                        </svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>Postcode on license</p>
                        <h5> {{ info.postcode }}</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                    </span>
                </li>
                <h1>Dcouments</h1>
                <li v-for="d in info.client.documents">
                    <div class="driver-detail-text">
                        <h5> {{ d.title }}</h5>
                    </div>
                    <span @click="edit(d)" class="clickable">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use></svg>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <update-documents :doc="doc"  @modelHiding="hideModal" ></update-documents>
</div>
</template>

<script>
    import Form from '../vehicle-fields';
    import User from '../user';

    var $scope;
    export default {
        props: ["booking_id"],
        data() {
            return {
                info: false,
                doc: false,
            };
        },
        computed:{
            age(){
                return moment.utc().diff(moment.utc(this.info.client.dob, 'YYYY-MM-DD H:m:s', true), 'years');
            }
        },
        created: function() {

        },
        mounted() {
            $scope = this;
            $('#sideLoader').show();
            this.prepareComponent();
            setTimeout(function() { $('#sideLoader').hide(); }, 1000);
            
        },

        methods: {
            prepareComponent() {
               axios.get('/api/booking/'+this.booking_id+"/user-profile").then(this.profileCallback);
            },
            profileCallback(r) {
                this.info = r.data.success;
            },
            hideModal(){
                // this.doc = null;

            },
            edit(doc){
                this.doc = doc;
                $('#updateModel').modal('show');

            },
        }
    }
</script>
