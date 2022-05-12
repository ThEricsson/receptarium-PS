/**
 * Aplicació per fer inputs dinàmics al formulari
 */
Vue.createApp({
    data() {
        return {
            passos: [{
                pasName: ""
            }, ],
            actual: 1,
        };
    },
    methods: {
        addMore() {
            this.passos.push({
                pasName: "",
            });
            this.actual += 1
        },
        remove(index) {
            this.passos.splice(index, 1);
            this.actual -= 1
        },
        checkPas() {
            return this.actual == 20
        }
    },
}).mount('#dynamicsteps')

Vue.createApp({
    data() {
        return {
            ingredients: [{
                ingName: ""
            }, ],
            actual: 1,
        };
    },
    methods: {
        addMore() {
            this.ingredients.push({
                ingName: "",
            });
            this.actual += 1
        },
        remove(index) {
            this.ingredients.splice(index, 1);
            this.actual -= 1
        },
        checkPas() {
            return this.actual == 10
        }
    },
}).mount('#dynamicingredients')
