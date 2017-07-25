<style>
    .pac-container.pac-logo{
            
                z-index: 9999 !important;
    }
</style>
<template>
<div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select vehicle location</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal" style="width: 550px">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Location:</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="us3-address" />
                            </div>
                        </div>
                        <div id="us3" style="width: 100%; height: 400px;"></div>
                        <div class="clearfix">&nbsp;</div>
                            
                                <input type="hidden" class="form-control" style="width: 110px" id="us3-lat" />
                                <input type="hidden" class="form-control" style="width: 110px" id="us3-lon" />
                    
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="emitCoordinates">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>
   <script>
    export default {
        props: ['location'],
        data() {
            return {
                latitude: '',
                longitude: '',

            };
        },

        mounted() {
            var $this = this;
            $('#myModal').on('hidden.bs.modal', function () {

                    $('#us3-address').val('');
            });
            $('#myModal').on('shown.bs.modal', function () {

                        $this.latitude = $this.location.split(",")[0]?$this.location.split(",")[0]:51.5073509;
                        $this.longitude = $this.location.split(",")[1]?$this.location.split(",")[1]:-0.12775829999998223;

                             $('#us3').locationpicker({
                                location: {
                                    latitude: $this.latitude,
                                    longitude: $this.longitude
                                },
                                radius: 0,
                                inputBinding: {
                                    latitudeInput: $("#us3-lat"),
                                    longitudeInput: $("#us3-lon"),
                                    locationNameInput: $('#us3-address'),
                                },
                                enableAutocomplete: true,
                            });
                            
                                
                            });
                            

        },
        watch: {
            location: function(location) {
                console.log(location.split(",")[0]);
                console.log(location.split(",")[1]);
                this.latitude = location.split(",")[0]?location.split(",")[0]:51.5073509;
                this.longitude = location.split(",")[1]?location.split(",")[1]:-0.12775829999998223;
            }
        },

        methods: {
            emitCoordinates(){
             let latitude = $("#us3-lat").val();
             let longitude = $("#us3-lon").val();
             $('#myModal').modal('hide');
             this.$emit("locationEvent",latitude+","+longitude);

            }

        }
    }
</script>
