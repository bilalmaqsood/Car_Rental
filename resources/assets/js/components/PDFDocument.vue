<template>
    <div>
        <h1 class="h2 m-0">{{typeof d.title!== 'undefined'?d.title:d.name}}</h1>
        <object :data="d.path" type="application/pdf" style="height: 110vh;" width="100%"></object>
    </div>
</template>

<script>
    export default {
        props: ['d']
    }
</script>
