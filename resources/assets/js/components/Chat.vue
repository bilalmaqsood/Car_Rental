<template>
    <div class="chat_contrnt" :style="{ height: viewHeight + 'px' }">
        <div class="all-chat-messages">
        <div id="chatmessages">
            <transition-group name="list" tag="div">
                <div v-for="m in messages.data" :key="m.id">
                    <div :class="{send_box: !isReceiver(m), receve_box: isReceiver(m)}">
                        <p>{{m.message}}</p>
                    </div>
                    <span class="chat_date_time" :class="{chat_date_time_recive: isReceiver(m)}">
                    {{ showUserName(m) }} | {{m.updated_at | date('format', 'DD.MM.YYYY')}} | {{m.updated_at | date('format', 'HH:mm a')}}</span>
                </div>
            </transition-group>
        </div>
        </div>

        <div class="chat_btn_wrapper">
            <div class="input-group login-input">
                <input class="form-control" placeholder="Your message" v-model="message" v-on:keyup.enter="sendMessage">
                <div class="input-group-addon">
                    <button @click="sendMessage">
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
        props: ['viewHeight', 'user', 'bookingId'],

        data() {
            return {
                message: '',
                messages: {}
            };
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                $('#sideLoader').show();
                axios.get('/api/message/' + this.bookingId).then(r => {
                    this.messages = r.data.success;
                    this.messages.data = this.messages.data.slice().reverse();
                    $('#sideLoader').hide();
                });

                window.Echo
                    .join('chatroom')
                    .listen('MessagePosted', (e) => {
                        e.message.sender = e.sender;
                        e.message.receiver = e.receiver;
                        this.messages.data.push(e.message);
                    });
            },

            isReceiver(m) {
                return this.user.state.auth.email === m.receiver.email;
            },

            sendMessage() {
                if (this.message) {
                    $('#sideLoader').show();
                    axios.post('/api/message/send', {
                        booking_id: this.bookingId,
                        message: this.message
                    }).then(r => {
                        this.message = '';
                        delete r.data.success.able;
                        delete r.data.success.sender.types;
                        this.messages.data.push(r.data.success);
                        $('#sideLoader').hide();
                    });
                }
            },
        
        showUserName(m){
            console.log(m);
            if(this.user.state.auth.email === m.sender.email && m.receiver.email !== this.user.state.auth.email)
                return this.user.state.auth.name;
            else 
                return m.sender.name;
        }
    }
}
</script>
