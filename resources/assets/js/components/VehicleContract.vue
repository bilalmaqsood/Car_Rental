<template>
    <div class="tab-content booking_tab_content">
        <div id="documents" class="tab-pane fade active in">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download_icon"></use>
                                </svg>
                                Contract
                            </a>
                        </h4>
                    </div>


                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
							  	  <span>
									  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
									  </svg>
                                        <svg @click="updateContract" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="clickable svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                        </svg>
                                      </span>
                            <textarea class="contract-area" v-model="contractTemplate" ></textarea>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>

    var $scope;
    export default {
        props: ["vehicle"],
        data() {
            return {
                contractTemplate: false,
            };
        },

        mounted() {
            $scope = this;
            axios.get('/api/vehicle/'+this.vehicle.id+'/contract-template')
                .then(function (r) {
                    $scope.contractTemplate = r.data;
                });
        },

        methods: {
            updateContract(){
                axios.post('/api/vehicle/'+this.vehicle.id+'/contract-template',this.contractTemplate)
                    .then(function (r) {
                        new Noty({
                            type: 'success',
                            text: r.data.success,
                        }).show();
                    });
            },
        }
    }
</script>
