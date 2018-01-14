
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('checkout', require('./components/Checkout.vue'));
Vue.component('restaurant', require('./components/Restaurant.vue'));
Vue.component('admin', require('./components/Admin.vue'));

const app = new Vue({
    el: '#app',
    data: {
        products: [],
        withOrder: false
    },
    methods: {
        removeFromCart: function(id){
            this.products.splice(id, 1);
        },
        displayCart: function (event) {
            if (window.matchMedia("(max-width: 600px)").matches) {
                if (event.target.checked) {
                    if (! $('#navbar').hasClass('in')) {
                        $('.navbar-header button.navbar-toggle').trigger('click');
                    }
                }

                if (! event.target.checked) {
                    if ($('#navbar').hasClass('in')) {
                        $('.navbar-header button.navbar-toggle').trigger('click');
                    }
                }
            }
        }
    },
    computed: {
        total: function(){
            let total = 0;
            let products = 0;

            for(let i = 0; i < this.products.length; i++){
                total += this.products[i].quantity * this.products[i].price;
                products += parseInt(this.products[i].quantity);
            }

            return {
                price: total,
                products: products
            }
        }
    }
});
