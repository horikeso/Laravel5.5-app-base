new Vue({
    el: '#app',
    components: {
        'example': httpVueLoader('/js/components/Example.vue')
    }
});