<template>
    <div class="row restaurant_menu">
        <h2 class="text-center">La carte</h2>
        <div>
            <div v-for="category in categories">
                <h3>{{ category.name }}</h3>
                <ul class="list-unstyled product-list" v-for="product in category.products">
                    <li>
                        <div>
                            <p>{{ product.name }}</p>
                            <p class="help-block" style="font-size: 0.8em;">{{ product.description }}</p>
                        </div>
                        <span>{{ product.price.toFixed(2) }} €</span>
                        <div>
                            <a v-on:click.prevent="addToCart(product)" title="Ajouter au panier" href="#" class="btn-ghost btn-small"><i class="fa fa-plus fa-2x"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.use(require('vue-resource'));

    export default {
        props: ['products'],
        data: function(){
            return {
                categories: null
            }
        },
        mounted() {
        },
        created() {
            let restaurant = document.querySelector('#restaurant_menu').dataset.id;
            Vue.http.get(laroute.action('restaurants.categories.index', {restaurant: restaurant})).then((response) =>{
                this.categories = response.body;
            }, (response) =>{

            });
        },
        methods: {
            addToCart: function(product){
                let restaurant = document.querySelector('#restaurant_menu').dataset.id;
                Lockr.set('restaurant', restaurant);

                let newProduct = true;

                for(let i = 0; i < this.products.length; i++){
                    if(this.products[i].id == product.id){
                        this.products[i].quantity++;
                        newProduct = false;
                    }
                }

                if(newProduct){
                    this.products.push({
                        id: product.id,
                        name: product.name,
                        price: parseFloat(product.price),
                        quantity: 1
                    });
                }

                Lockr.set('cart', this.products);
            }
        }
    }
</script>
