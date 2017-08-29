<template>
<div id="updateModel" class="modal fade in">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> {{doc.title}} </h4>
                </div>
                <div class="modal-body">

                    <object v-if="doc.type=='pdf'" type="application/pdf" style="height: 110vh;" width="100%" :data="doc.path"></object>
                        <img v-else :src="doc.path" class="img-responsive" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click="closeModel">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>
   <script>
    export default {
        props: ['doc','title'],
        data() {
            return {
           
            };
        },

        mounted() {
             $('#updateModel').appendTo("body");
        },
        watch: {
          
        },

        methods: {
            docUpdated(){
             this.$emit("docUpdate",this.doc);

            },
            closeModel(){
                this.$emit("modelHiding");
                
            }

        }
    }
</script>
