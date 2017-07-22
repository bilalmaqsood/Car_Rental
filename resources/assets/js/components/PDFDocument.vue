<template>
    <div>
        <div class="row no-margin">
            <h1 class="pull-left no-margin h2">{{d.name}}</h1>
            <div class="form-group no-margin pull-right">
                <div class="input-group">
                    <input type="number" v-model.number="page" min="1" :max="numPages" class="form-control no-radius" placeholder="page no">
                    <div class="input-group-addon no-radius"> / {{numPages}}</div>
                </div>
            </div>
        </div>
        <pdf :page="page" @numPages="numPages = $event" :src="d.path"></pdf>
    </div>
</template>

<script>
    export default {
        props: ['d'],

        data() {
            return {
                page: 1,
                numPages: 0
            };
        }
    }
</script>
