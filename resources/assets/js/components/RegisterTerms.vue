<template>
    <div>
        <transition name="flip" mode="out-in">

<div style="float: right; width: 100%;">
    
    
    <div class="terms_conditions">
        <h3>Terms &amp; Conditions</h3>
        <p> {{ terms }} </p>
        <span>Please read and understand our T&amp;C.</span>
        <button class="secodery_btn" @click="processTerms">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
            </svg>
            Agree
        </button>
        
    </div>
    
    
</div>

        </transition>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                terms: '',
            }
         },
        mounted() {
            this.prepareComponent();
        },

        methods:{
            prepareComponent(){
                axios.get('/api/terms/app').then((r)=>{
                    this.terms = r.data.success;
                });
            },
            processTerms(e){
                $(e.target).button('loading');
                this.$emit("term",true);
            }
        }
    }
</script>
