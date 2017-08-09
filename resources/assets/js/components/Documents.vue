<template>
    <div>

        <!-- <ul class="list-group">
            <li class="list-group-item" v-for="d in documents">
                <pdf-document v-if="typeof d.type !== 'undefined' && d.type === 'pdf'" :d="d"></pdf-document>
                <div v-else>
                    <h1 class="no-margin h2">{{d.name}}</h1>
                    <p class="no-margin">
                        <img :src="d.path">
                    </p>
                </div>
            </li>
        </ul> -->

                <div class="panel panel-default" v-for="d in documents">

                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" :href="'#'+trim(d.name)" aria-expanded="false" aria-controls="collapseThree">
                                    
                                    {{d.name}}
                                </a>
                                <a :download="d.path" :href="d.path">
                                <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="pull-right svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download_icon"></use>
                                </svg>
                                </a>
                            </h4>
                        </div>
                        <div :id="trim(d.name)" class="panel-collapse collapse" role="tabpanel" aria-labelledby="">
                            <div class="panel-body">
                                
                                <pdf-document v-if="typeof d.type !== 'undefined' && d.type === 'pdf'" :d="d"></pdf-document>
                                <div v-else>
                                <h1 class="no-margin h2">{{d.name}}</h1>
                                <p class="no-margin">
                                    <img :src="d.path">
                                </p>
                            </div>
                            </div>
                        </div>

                    </div>

    </div>
</template>

<script>
    export default {
        props: ['documents'],

        data() {
            return {};
        },

        methods: {
            trim(str){
                return str.replace(/\s+/g, '');
            }
        }
    }
</script>
