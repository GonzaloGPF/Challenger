Vue.mixin({
    methods: {
        ago(date){
            return window.moment(date).fromNow();
        }
    }
});