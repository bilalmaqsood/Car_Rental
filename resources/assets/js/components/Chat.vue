<template>
    <div class="chat_contrnt" :style="{ height: viewHeight + 'px' }">
        <div class="all-chat-messages">
            <div class="send_box">
                <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.</p>
            </div>
            <span class="chat_date_time">John Doe | 05.06.2017 | 12:30</span>

            <div class="receve_box">
                <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.</p>
            </div>
            <span class="chat_date_time chat_date_time_recive">John Doe | 05.06.2017 | 12:30</span>
        </div>

        <div class="chat_btn_wrapper">

<div class="input-group login-input">
            <input class="form-control" placeholder="Your message">
<div class="input-group-addon">
<button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#send"></use>
                </svg>
            </button>
</div>
</div>

            
        </div>
    </div>
</template>

<script>
    export default {
        props: ['viewHeight'],

        data() {
            return {};
        },

        mounted() {},

        methods: {}
    }
</script>
