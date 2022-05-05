import Vue from 'vue';

Vue.createApp({
    data() {
        return {
            courses: [{
                courseName: "",
            }, ],
        };
    },
    methods: {
        addMore() {
            console.log("hola")
            /*
            this.courses.push({
                courseName: "",
            });*/
        },
        remove(index) {
            this.courses.splice(index, 1);
        },
    },
}).mount('#assignment')
