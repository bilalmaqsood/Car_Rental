<template>
    <div id="chat_tab" class="tab-pane fade active in">
        <div class="chat_contrnt">
            <div class="send_box">
                <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.</p>
            </div>
            <span class="chat_date_time">John Doe | 05.06.2017 | 12:30</span>
            <div class="receve_box">
                <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.</p>
            </div>
            <span class="chat_date_time chat_date_time_recive">John Doe | 05.06.2017 | 12:30</span>
            <div class="chat_btn_wrapper">
                <textarea>Your message</textarea>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#send"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script>

    var $scope;

    export default {

        data() {
            return {

            };
        },

        mounted() {
            $scope=this;


        },

        methods: {

        }
    }
</script>
