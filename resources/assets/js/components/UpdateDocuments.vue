<template>
<div id="updateModel" class="modal fade in">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button @click="closeModel" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> {{title}} </h4>
                </div>
                <div class="modal-body">

                    <object v-if="type=='pdf'" type="application/pdf" style="height: 110vh;" width="100%" :data="path"></object>
                        <img v-else :src="path" class="img-responsive" alt="">
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
        props: ['doc'],
        data() {
            return {
                path: false,
                type: false,
                title: false,
            };
        },

        mounted() {
              this.prepareComponent();
             $('#updateModel').appendTo("body");
        },
        watch: {
            doc: function(doc) {
                 this.path = doc.path;
                this.type =  doc.type;
                this.title = doc.title;
            },
        },

        methods: {
            prepareComponent(){
                 this.path = this.doc.path;
                this.type =  this.doc.type;
                this.title = this.doc.title;  
            },
            docUpdated(){
             this.$emit("docUpdate",this.doc);

            },
            closeModel(){
                this.$emit("modelHiding");
                
            }

        }
    }
</script>
