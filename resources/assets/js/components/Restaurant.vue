<template>
  <div>
    <h2 class="text-center">La carte</h2>
    <div v-for="category in categories">
      <h3>{{ category.name }}</h3>
      <ul class="list-unstyled product-list" v-for="product in category.products">
        <li>
          <div>
            <p>{{ product.name }}</p>
            <p class="help-block" style="font-size: 0.8em;">{{ product.description }}</p>
          </div>
          <span>{{ product.price.toFixed(2) }} €</span>
          <div v-show="order == 'true'">
            <a v-on:click.prevent="addToCart(product)" title="Ajouter au panier" href="#" class="btn-ghost btn-small"><i class="fa fa-plus fa-2x"></i></a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
    Vue.use(require('vue-resource'));

    export default {
        props: ['products', 'order'],
        data: function(){
            return {
                categories: null
            }
        },
        mounted() {
          if ($(location).attr('pathname') == '/restaurants/los-pollos-hermanos/bookings/create') {
            $('#datetimepicker').datetimepicker({
                  inline: true,
                  locale: 'fr',
                  icons: {
                      time: 'fa fa-time',
                      date: 'fa fa-calendar',
                      up: 'fa fa-chevron-up',
                      down: 'fa fa-chevron-down',
                      previous: 'fa fa-chevron-left',
                      next: 'fa fa-chevron-right',
                      today: 'fa fa-screenshot',
                      clear: 'fa fa-trash',
                      close: 'fa fa-remove'
                  },
                  sideBySide: true
              });
            }
            $('#toggle').bootstrapToggle({
              on: 'Anticipée',
              off: 'Normale'
            });
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
            }
        }
    }
</script>

<style media="screen">
  #datetimepicker .datepicker{
    width: 100%;
  }
  #datetimepicker table td.active{
    background: #ea4d4d;
  }
  #datetimepicker table td.active:hover{
    background: #e51f1f;
  }
  .bootstrap-datetimepicker-widget table td span.active{
    background: #e51f1f;
  }
  #datetimepicker .timepicker{
    width: 100%;
    padding: 10px 80px;
  }
  #datetimepicker table td.today:before {
    border-bottom-color: #ea4d4d;
  }
  #datetimepicker th{
    color: #000;
  }
  .timepicker a{
    background: #FFF;
  }
  .timepicker a:hover{
    background: none;
  }
  .timepicker span:not(.timepicker-hour):not(.timepicker-minute){
    color: #ea4d4d;
  }
  .timepicker-hour, .timepicker-minute{
    color: #000;
  }
  .toggle-container{
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
  }
</style>
