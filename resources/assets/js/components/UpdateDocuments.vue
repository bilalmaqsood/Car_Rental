<template>
<div id="updateModel" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> {{title}} </h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" >Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>
   <script>
    export default {
        props: ['propDoc','title'],
        data() {
            return {
                doc: this.propDoc,

            };
        },

        mounted() {
            

         
                            

        },
        watch: {
            // location: function(location) {
            //     console.log(location.split(",")[0]);
            //     console.log(location.split(",")[1]);
            //     this.latitude = location.split(",")[0]?location.split(",")[0]:51.5073509;
            //     this.longitude = location.split(",")[1]?location.split(",")[1]:-0.12775829999998223;
            // }
        },

        methods: {
            docUpdated(){
            //  let latitude = $("#us3-lat").val();
            //  let longitude = $("#us3-lon").val();
            //  $('#updateModel').modal('hide');
             this.$emit("docUpdate",this.doc);

            }

        }
    }
</script>
