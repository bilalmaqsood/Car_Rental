<template>
    <div class="chat-container">
        <transition name="slide-fade">
            <div class="row" v-if="indexView!==null">
                <div class="col-xs-3">
                    <chat-window ref="chatWindowRef" :chat="chatView" :index="indexView" :utility="true" @closeChat="resetChat"></chat-window>
                </div>
            </div>
        </transition>

        <div class="chats-container" v-if="showChat">
            <transition name="flip">
                <div class="chat-users-list" v-if="menu">
                    <transition name="slide-fade" mode="out-in">
                        <div class="list-group no-margin" v-if="storage.state.chatUsers.length" key="chat-list">
                            <transition-group name="list" tag="div">
                                <a href="javascript:" :class="{ active: ( indexView !== null && indexView === i ) }" @click="loadChat(chat, i)" class="list-group-item" v-for="(chat, i) in storage.state.chatUsers" :key="chat.user.id">
                                    <span class="badge" v-if="chat.messages.length">{{ chat.messages.length }}</span>
                                    {{ chat.user.name }}
                                </a>
                            </transition-group>
                        </div>
                        <div class="list-group no-margin" key="chat-empty" v-else>
                            <div class="list-group-item text-center"><b>no messages</b></div>
                        </div>
                    </transition>
                </div>
            </transition>
            <button class="btn btn-success load-users" @click="changeMenu"><i class="fa fa-comments" :class="{ 'blink-me': blink }"></i></button>
            <!--<button class="btn btn-primary load-users" @click="sendMessage"><i class="fa fa-send"></i></button>-->
        </div>
    </div>
</template>

<script>
    import User from '../user';

    export default {
        data() {
            return {
                indexView: null,
                chatView: null,
                storage: User,
                showChat: false,
                menu: false,
            };
        },

        computed: {
            blink() {
                if (User.state.chatUsers.length) {
                    let check = false;

                    User.state.chatUsers.filter(function (chat) {
                        if (chat.messages.length) {
                            check = true;
                            new Noty({
                                type: 'success',
                                text: 'You have new Message'
                            }).show();
                        }
                    });

                    return check;
                } else
                    return false;
            }
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                axios.get('/api/user').then(r => {
                    // User.commit('update', r.data);
                    window.Echo
                        .join(`user-${r.data.success.id}`)
                        .here(this.initSocketAd)
                        .listen('MessageReceived', this.updateMessagePosted);

                    this.showChat = true;
                    alert(window.Echo.socketId());
                    this.loadLatestChat();
                });
            },

            loadLatestChat() {
                axios.get('/api/message').then((r) => {
                    let newMessages = [];
                    $.each(r.data.success, function (i, m) {
                        let message = m;

                        m.sender.avatar = m.sender.avatar;
                        let user = m.sender;

                        delete message.sender;
                        delete message.receiver;

                        message.is_sender = false;

                        let index = null;
                        newMessages.filter(function (chat, i) {
                            if (chat.user.id === user.id) {
                                index = i;
                            }
                        });

                        if (index === null)
                            newMessages.push({user: user, messages: [message]});
                        else
                            newMessages[index].messages.push(message);
                    });
                    newMessages.filter(function (chat) {
                        User.commit('addChatUser', chat);
                    });
                });
            },

            initSocketAd() {
                alert("Join socket:" +window.Echo.socketId());
                axios.post('/api/message/socket', {socket: window.Echo.socketId()});
            },

            updateMessagePosted(posted) {
                console.log("message posted");
                alert("posted");
                posted.message.is_sender = false;

                let index = null;
                User.state.chatUsers.filter(function (chat, i) {
                    if (chat.user.id === posted.sender.id) {
                        index = i;
                    }
                });

                if (index === null)
                    User.commit('addChatUser', {user: posted.sender, messages: [posted.message]});
                else if (this.indexView === index)
                    this.$refs.chatWindowRef.addMessage(posted.message);
                else
                    User.commit('addChatMessage', {chatIndex: index, message: posted.message});
            },

            loadChat(chat, index) {
                if (this.indexView === index)
                    this.resetChat();
                else {
                    this.indexView = null;
                    setTimeout(() => {
                        this.chatView = chat;
                        this.indexView = index;
                        this.menu = true;
                    }, 300);
                }
            },

            changeMenu() {
                this.menu = !this.menu;
//                this.resetChat();
            },

            resetChat() {
                this.indexView = null;
                setTimeout(() => {
                    this.chatView = null;
                }, 300);
            },

            addUserChat(user) {
                let index = -1;
                $.each(User.state.chatUsers, function (k, v) {
                    if (v.user.id === user.id) index = k;
                });
                if (index === -1)
                    axios.get('/api/user/' + user.id).then(r => {
                        User.commit('addChatUser', {user: r.data.success, messages: []});
                        this.menu = true;
                        let index = User.state.chatUsers.length - 1;
                        this.loadChat(User.state.chatUsers[index], index);
                    });
                else if (this.indexView === null || this.indexView !== index) this.loadChat(User.state.chatUsers[index], index);
                else new Noty({
                        type: 'warning',
                        text: '<div><p class="m-0">You already chatting with <b>' + user.name + '</b>.</p></div>',
                        timeout: 800
                    }).show();
            },

            removeUserChat(id) {
                let index = -1;

                $.each(User.state.chatUsers, function (k, v) {
                    if (v.user.id === id)
                        index = k;
                });

                if (index > -1) {
                    User.commit('delChatUser', index);
                }
            },

            sendMessage(e) {
                let $btn = $(e.target).button('loading');
                axios.post('/api/message/send', {
                    receiver_id: User.state.auth.id === 2 ? 4 : 2,
                    message: 'sample message'
                }).then(r => {
                    $btn.button('reset');
                });
            }
        }
    }
</script>
