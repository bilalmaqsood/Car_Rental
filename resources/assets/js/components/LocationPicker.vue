<style>
    .pac-container.pac-logo{
            
                z-index: 9999 !important;
    }
</style>
<template>
<div class="modal is-active">
<div class="modal-background"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" @click="modelHiding" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click="modelHiding">Close</button>
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
            require('../locationpicker.jquery');
            var $this = this;
            // $('#myModal').on('hidden.bs.modal', function () {

                    $('#us3-address').val('');
            // });
            // $('#myModal').on('shown.bs.modal', function () {

                        $this.latitude = $this.location.split(",")[0]?$this.location.split(",")[0]:51.5073509;
                        $this.longitude = $this.location.split(",")[1]?$this.location.split(",")[1]:-0.12775829999998223;
                        FetchLocationName($this.latitude, $this.longitude , function (result) {
                            $("#us3-address").val(result);
                        });
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
                            
                                
                            // });
                            

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

            },

        modelHiding(){
             
             this.$parent.$emit("modelHiding");

            }

        }
    }
</script>

<style type="text/css">

.modal {
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  display: none;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  overflow: hidden;
  position: fixed;
  z-index: 20;
}

.modal.is-active {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
}

.modal-background {
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  background-color: rgba(10, 10, 10, 0.86);
}

.modal-content,
.modal-card {
  margin: 0 20px;
  max-height: calc(100vh - 160px);
  overflow: auto;
  position: relative;
  width: 100%;
}

@media screen and (min-width: 769px), print {
  .modal-content,
  .modal-card {
    margin: 0 auto;
    max-height: calc(100vh - 40px);
    width: 640px;
  }
}

.modal-close {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  -moz-appearance: none;
  -webkit-appearance: none;
  background-color: rgba(10, 10, 10, 0.2);
  border: none;
  border-radius: 290486px;
  cursor: pointer;
  display: inline-block;
  -webkit-box-flex: 0;
      -ms-flex-positive: 0;
          flex-grow: 0;
  -ms-flex-negative: 0;
      flex-shrink: 0;
  font-size: 1rem;
  height: 20px;
  max-height: 20px;
  max-width: 20px;
  min-height: 20px;
  min-width: 20px;
  outline: none;
  position: relative;
  vertical-align: top;
  width: 20px;
  background: none;
  height: 40px;
  position: fixed;
  right: 20px;
  top: 20px;
  width: 40px;
}

.modal-close:before, .modal-close:after {
  background-color: white;
  content: "";
  display: block;
  left: 50%;
  position: absolute;
  top: 50%;
  -webkit-transform: translateX(-50%) translateY(-50%) rotate(45deg);
          transform: translateX(-50%) translateY(-50%) rotate(45deg);
  -webkit-transform-origin: center center;
          transform-origin: center center;
}

.modal-close:before {
  height: 2px;
  width: 50%;
}

.modal-close:after {
  height: 50%;
  width: 2px;
}

.modal-close:hover, .modal-close:focus {
  background-color: rgba(10, 10, 10, 0.3);
}

.modal-close:active {
  background-color: rgba(10, 10, 10, 0.4);
}

.modal-close.is-small {
  height: 16px;
  max-height: 16px;
  max-width: 16px;
  min-height: 16px;
  min-width: 16px;
  width: 16px;
}

.modal-close.is-medium {
  height: 24px;
  max-height: 24px;
  max-width: 24px;
  min-height: 24px;
  min-width: 24px;
  width: 24px;
}

.modal-close.is-large {
  height: 32px;
  max-height: 32px;
  max-width: 32px;
  min-height: 32px;
  min-width: 32px;
  width: 32px;
}

.modal-card {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  max-height: calc(100vh - 40px);
  overflow: hidden;
}

.modal-card-head,
.modal-card-foot {
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  background-color: whitesmoke;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-negative: 0;
      flex-shrink: 0;
  -webkit-box-pack: start;
      -ms-flex-pack: start;
          justify-content: flex-start;
  padding: 20px;
  position: relative;
}

.modal-card-head {
  border-bottom: 1px solid #dbdbdb;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.modal-card-title {
  color: #363636;
  -webkit-box-flex: 1;
      -ms-flex-positive: 1;
          flex-grow: 1;
  -ms-flex-negative: 0;
      flex-shrink: 0;
  font-size: 1.5rem;
  line-height: 1;
}

.modal-card-foot {
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  border-top: 1px solid #dbdbdb;
}

.modal-card-foot .button:not(:last-child) {
  margin-right: 10px;
}

.modal-card-body {
  -webkit-overflow-scrolling: touch;
  background-color: white;
  -webkit-box-flex: 1;
      -ms-flex-positive: 1;
          flex-grow: 1;
  -ms-flex-negative: 1;
      flex-shrink: 1;
  overflow: auto;
  padding: 20px;
}

</style>