<template>
    <div class="panel panel-default">
        <div class="panel-heading">Example Component</div>

        <div class="panel-body">
            I'm an example component!

            <pre v-if="message" v-html="message"></pre>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: null
            };
        },

        mounted() {
            this.prepareComponent();
        },

        ready() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                this.fetchAuthUser();
            },

            fetchAuthUser() {
                axios.get('/api/user')
                    .then(response => {
                        console.log(response.data);
                        this.message = JSON.stringify(response.data, null, 4);
                    });
            }
        }
    }
</script>
