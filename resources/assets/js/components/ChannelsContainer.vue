<template>
    <div>
        <div v-if="!selectedChannel" class="row channels-container">
            <div v-show="!channels.length">
                <p>No Channels</p>
            </div>
            <div class="col-xs-6 col-md-4 col-lg-3" v-for="channel in channels">
                <div class="card card-channel">
                    <div class="card-header">
                        <i class="material-icons">face</i>
                        status
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#" @click.preven="channelClicked(channel)" v-text="channel.name"></a>
                        </h4>
                        <!--<p class="card-text">{{ $channel->description }}</p>-->
                        <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                    <div class="card-footer text-muted">
                        <small>{{ channel.users_count }} / {{ channel.capacity }}</small>
                    </div>
                </div>
            </div>
        </div>

        <channel-chat v-else :data="selectedChannel"></channel-chat>

    </div>
</template>
<script>
    import ChannelChat from './ChannelChat.vue';

    export default {
        props: ['data'],

        components: { ChannelChat },

        created(){
            Echo.channel('channels')
                .listen('UserJoinedToChannel', (data) => {
                    this.findChannel(data.channel).users_count++;
                })
                .listen('UserLeftChannel', (data) => {
                    this.findChannel(data.channel).users_count--;
                });
        },

        data() {
            return {
                channels: this.data.data,
                selectedChannel: null
            }
        },
        methods: {
            channelClicked(channel) {
                if (this.isLogged()) {
                    this.selectedChannel = channel;
                } else {
                    window.events.$emit('flash', {
                        message: 'You need log in',
                        level: 'danger'
                    })
                }
            },

            findChannel(channel) {
                return this.channels.find((item) => item.id === channel.id)
            }
        }
    }
</script>