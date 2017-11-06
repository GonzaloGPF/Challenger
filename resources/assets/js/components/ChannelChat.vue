<template>
    <div class="card channel-chat mt-3">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h2 v-text="channel.name"></h2>
                    <p class="collapse" id="channel-description" v-text="channel.description"></p>
                </div>
                <div class="col-2">
                    <div class="btn-group btn-group-sm">
                        <button class="btn link"
                                data-toggle="collapse"
                                data-target="#channel-description"
                                @click="showMore = !showMore">
                            <i class="material-icons" v-if="showMore">expand_more</i>
                            <i class="material-icons" v-else>expand_less</i>
                        </button>
                        <!--<button type="button" class="btn link" @click="closeChat()">-->
                            <!--<i class="material-icons">indeterminate_check_box</i>-->
                        <!--</button>-->
                        <button type="button" class="btn link" @click="leaveChannel()">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="channel-chat">
            <div class="row">
                <div class="col-10 pr-0">
                    <ul class="messages-list" id="messages-list">

                        <li class="message" :class="{'align-self-end': authorize('owns', message)}" v-for="message in messages">
                            <strong class="message-username" v-text="message.user.name"></strong>
                            said <span v-text="ago(message.created_at)" class="message-timestamp"></span>:
                            <p class="message-text-" v-text="message.text"></p>
                        </li>
                    </ul>
                </div>
                <div class="col-2 pl-0">
                    <ul class="list-group">
                        <li class="list-group-item border-0 list-group-item-action" v-for="user in users" v-text="user.name">

                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-10">
                    <div class="form-group">
                        <label for="message" class="sr-only">Type text</label>
                        <div class="input-group">
                            <!--<span class="input-group-addon"><i class="material-icons">send</i></span>-->
                            <input id="message" type="text" class="form-control" v-model="message" placeholder="Say something" @keyup.enter="sendMessage()">
                            <picker v-show="showEmojiMart" @click="emojiClicked($event)"></picker>
                            <div class="input-group-btn">
                                <button class="btn btn-secondary" :class="{ 'active': showEmojiMart }" @click="showEmojiMart = !showEmojiMart">
                                    <i class="material-icons">face</i>
                                </button>
                                <button class="btn btn-secondary" @click="sendMessage()">
                                    <i class="material-icons">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">

                </div>
            </div>

        </div>

    </div>

</template>

<script>
    import moment from 'moment';
    import { Picker } from 'emoji-mart-vue';

    export default {
        props: ['data'],

        components: { Picker },

        data() {
            return {
                channel: this.data,
                users: [],
                messages: [],
                message: '',
                showMore: false,
                showEmojiMart: false
            }
        },

        created() {
            this.joinToChannel();
            this.fetchMessages();
        },

        computed: {

        },

        methods: {
            leaveChannel(){
                console.log(location);
//                axios.post(`/channels/${this.channel.name}/leave`)
//                    .then(() => Echo.leave(this.channel.pusher_name))
//                    .then(() => );
            },

            joinToChannel(){
                axios.post(`/channels/${this.channel.name}/join`)
                    .then(({data}) => this.listen())
                    .catch(() => window.events.$emit('flash', 'Problem joining to channel'));
            },

            listen(){
                Echo.join(this.channel.pusher_name)
                    .here((users) => {
                        this.users = users;
                    })
                    .joining((user) => {
                        console.log('User joining: '+user.name);
                        this.users.push(user);
                    })
                    .leaving((user) => {
                        console.log('User leaving: '+user.name);
                        this.users.splice(user, 1);
                    })
                    .listen('MessageSent', (data) => {
                        console.log('Message received: ', data);
                        this.messages.push(data.message);
                    })
            },

            fetchMessages() {
                axios.get(`/channels/${this.channel.name}/messages`)
                    .then(({data}) => {
                        this.messages = data.data;
                        this.scrollToEnd();
                    });
            },

            sendMessage() {
                if(! this.message) return;

                axios.post(`/channels/${this.channel.name}/messages`, {
                    'text': this.message
                });

                this.addMessage();
                this.scrollToEnd();
            },

            addMessage() {
               this.messages.push({
                   'user_id': App.user.id,
                   'channel_id': this.channel ,
                   'created_at': moment().format(),
                   'text': this.message ,
                   'user': {
                       'name': App.user.name
                   } ,
               });
                this.message = '';
            },

            scrollToEnd() {
                this.$nextTick(() => {
                    let container = this.$el.querySelector("#messages-list");
                    container.scrollTop = container.scrollHeight;
                });
            },

            emojiClicked(event) {
                this.message = this.message + event.native
            }
        }
    };
</script>