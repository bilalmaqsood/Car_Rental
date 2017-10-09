<template>
    <div class="chat-window">
        <div class="panel panel-default">
            <div class="panel-heading top-bar">
                <div class="col-md-8 col-xs-8">
                    <h3 class="panel-title"><span class="fa fa-circle" :class="'text-'+online"></span> Chat - {{username}}</h3>
                </div>
                <div class="col-md-4 col-xs-4 text-right" v-if="utility">
                    <a href="javascript:" @click="removeChatHead"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                </div>
            </div>
            <div class="panel-body page-quick-sidebar-chat-user-messages">
                <transition name="vertical-fade" mode="in-out">
                    <div class="spinner-circle" v-if="spinner" key="spin">
                        <div class="circle"></div>
                        <div class="circle1"></div>
                    </div>
                    <button key="more" type="button" class="btn btn-primary btn-block btn-xs" v-if="!spinner && (currentPage==null||currentPage!=lastPage)" @click="loadMoreMessages">load more messages</button>
                </transition>
                <transition-group name="list" tag="div">
                    <div class="post" :class="m.is_sender ? 'out' : 'in'" v-for="m in messages" :key="m.id">
                        <img class="avatar" alt="" :src="'/'+(m.is_sender ? user.state.auth.image : chat.user.image)">
                        <div class="message">
                            <span class="arrow"></span>
                            <span class="name" v-html="m.is_sender ? getName(user.state.auth) : getName(chat.user)"></span>
                            <span class="datetime">{{m.updated_at | date('fromNow')}}</span>
                            <span class="body" v-html="m.message"></span>
                        </div>
                    </div>
                </transition-group>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." v-model="message" @keyup.enter="sendMessage">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-sm" @click="sendMessage"><i class="fa fa-send"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import User from '../user';
    import ls from 'local-storage';

    export default {
        props: ['chat', 'index', 'utility'],

        data() {
            return {
                online: 'danger',
                message: '',
                spinner: false,
                messages: null,
                currentPage: null,
                lastPage: null,
                ids: [],
            };
        },

        computed: {
            user() {
                return User;
            },

            username() {
                return this.chat.user.first_name + ' ' + this.chat.user.last_name;
            },
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                let messages = [];

                if (this.chat.messages.length) {
                    this.chat.messages.filter((m) => {
                        this.ids.push(m.id);
                        messages.push(m);
                    });

                    User.commit('cleanChatMessage', this.index);
                }

                messages = messages.sort((a, b) => {
                    return a.id - b.id;
                });

                this.messages = messages;

                if (messages.length < 5) {
                    this.loadMoreMessages();
                }

                axios.get('/api/user/online/' + this.chat.user.id).then(r => {
                    this.online = r.data;
                });
            },

            getName(user) {
                return user.first_name + ' ' + user.last_name;
            },

            setLocalMessage() {
                return ls.set(`chatMessage-${this.chat.user.id}`, this.messages);
            },

            getLocalMessage() {
                return ls.get(`chatMessage-${this.chat.user.id}`);
            },

            loadMoreMessages() {
                this.spinner = true;

                axios.get('/api/user/messages/' + this.chat.user.id + (this.currentPage !== null ? '?page=' + (this.currentPage + 1) : '')).then(r => {
                    let messages = [];

                    if (this.currentPage === null) {
                        this.ids = [];
                        $.each(r.data.data, (i, m) => {
                            messages.push(m);
                            this.ids.push(m.id);
                        });
                    } else
                        $.each(r.data.data, (i, m) => {
                            if (this.ids.indexOf(m.id) === -1) {
                                this.ids.push(m.id);
                                this.messages.push(m);
                            }
                        });

                    this.updateReadMessages();

                    if (this.currentPage === null)
                        this.messages = messages.sort((a, b) => {
                            return a.id - b.id;
                        });
                    else
                        this.messages = this.messages.sort((a, b) => {
                            return a.id - b.id;
                        });

                    this.spinner = false;
                    this.currentPage = r.data.current_page;
                    this.lastPage = r.data.last_page;
                });
            },

            updateReadMessages() {
                axios.post('/api/message/read', {
                    ids: this.ids
                });
            },

            sendMessage() {
                if (this.message) {
                    axios.post('/api/message/send', {
                        user_id: this.chat.user.id,
                        message: this.message
                    }).then(r => {
                        this.message = '';
                        delete r.data.receiver;
                        delete r.data.sender;
                        r.data.is_sender = true;
                        this.messages.push(r.data);
                    });
                }
            },

            removeChatHead() {
                this.$emit('closeChat');
            },

            addMessage(message) {
                this.messages.push(message);
            }
        }
    }
</script>
