<template>
    <div>

        <ul class="list-group">
            <li class="list-group-item" v-for="d in documents">
                <pdf-document v-if="typeof d.type !== 'undefined' && d.type === 'pdf'" :d="d"></pdf-document>
                <div v-else>
                    <h1 class="no-margin h2">{{d.name}}</h1>
                    <p class="no-margin">
                        <img :src="d.path">
                    </p>
                </div>
            </li>
        </ul>

    </div>
</template>

<script>
    export default {
        props: ['documents'],

        data() {
            return {};
        }
    }
</script>
