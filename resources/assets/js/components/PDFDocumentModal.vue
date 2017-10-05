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


<template>

<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
        <div class="modal-header">
                    <button @click="closeModel" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> {{title}} </h4>
                </div>
                <div class="modal-body">

                    <span>
                    <svg v-if="!isEdit" @click="editContract" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
                    </svg>
                                        
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download_icon"></use>
                                </svg>
                                <svg v-if="isEdit" @click="updateContract" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="clickable svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                        </svg>
                                      </span>
                            <textarea v-if="isEdit" class="contract-area" v-model="contractTemplate" ></textarea>
                            <div v-else>
                          <object v-if="type=='pdf'" type="application/pdf" style="height: 110vh;" width="100%" :data="path"></object>
                          <img v-else :src="path" class="img-responsive" alt="">
                          </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click="closeModel">Close</button>
                </div>
        </div>
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>
</template>
   <script>
    export default {
        props: ['doc',"booking"],
        data() {
            return {
                path: false,
                type: false,
                title: false,
                isEdit: false,
                contractTemplate: '',
            };
        },

        mounted() {
                $('#sideLoader').show();
              this.prepareComponent();
              setTimeout(function() { $('#sideLoader').hide(); }, 100);
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
                
            },

           updateContract(){
            let $this = this;
              axios.post('/api/vehicle/'+this.booking.vehicle.id+'/contract-template',this.contractTemplate)
                    .then(function (r) {
                        new Noty({
                            type: 'success',
                            text: r.data.success,
                        }).show();
                        $this.isEdit = false;
                    });   
           },
           editContract(){
            let $this = this;
            axios.get('/api/vehicle/'+this.booking.vehicle.id+'/contract-template')
                .then(function (r) {
                    $this.contractTemplate = r.data;
                    $this.isEdit = true;

                });
           }

        }
    }
</script>
