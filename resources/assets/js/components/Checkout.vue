<template>
    <form id="order-form" method="post">
        <input type="hidden" name="_token">
        <fieldset>
            <legend>Comment voulez-vous récupérer votre repas ?</legend>
            <div class="form-group row" v-for="service in services">
                <div class="col-lg-4">
                    <label class="radio-inline">
                        <input v-model="chosenService" type="radio" name="chosenService" v-bind:id="service.name" v-bind:value="service.id">
                        {{ service.name }}
                    </label>
                </div>
            </div>
        </fieldset>
        <fieldset v-show="chosenService != 0">
            <legend>Date et heure</legend>
            <div v-show="chosenService == 2" class="form-group row">
                <div class="col-lg-6">
                    <label>Nombre de places</label>
                    <input v-model="capacity" type="number" name="capacity" class="form-control" min="1">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Date</label>
                    <input type="text" name="date" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label>Heure</label>
                    <input name="time" class="form-control" type="text">
                </div>
            </div>
            <div v-show="chosenService == 2">
                <button v-on:click.prevent="checkAvailabilities()" class="btn btn-block">Vérifier les disponibilités</button>
                <div v-show="isAvailable != null">
                    <p v-if="isAvailable" class="text-success text-center"><strong>Une table est disponible à cet horaire</strong></p>
                    <p v-else="!isAvailable" class="text-danger text-center"><strong>Malheureusement aucune table n'est disponible à cet horaire</strong></p>
                </div>
            </div>
        </fieldset>
        <fieldset v-show="chosenService != 0">
            <legend>Vos coordonnées</legend>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label class="sr-only">Nom</label>
                    <input class="form-control" name="lastname" type="text" placeholder="Nom">
                </div>
                <div class="col-lg-6">
                    <label class="sr-only">Prénom</label>
                    <input class="form-control" name="firstname" type="text" placeholder="Prénom">
                </div>
            </div>
            <div class="form-group row" v-show="chosenService == 1">
                <div class="col-lg-8">
                    <label class="sr-only">Votre adresse</label>
                    <input class="form-control" name="address" type="text" id="address" placeholder="Votre adresse">
                </div>
                <div class="col-lg-4">
                    <label class="sr-only">Numéro de téléphone</label>
                    <input class="form-control" name="phone" type="text" placeholder="Numéro de téléphone">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label class="sr-only">Informations supplémentaires</label>
                    <textarea class="form-control" placeholder="Informations supplémentaires"></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset v-show="chosenService == 1 || chosenService == 3">
            <legend>Votre mode de paiement</legend>
            <div class="form-group row">
                <div v-for="mode in modes" class="col-lg-4">
                    <label class="radio-inline">
                        <input v-model="chosenPayment" type="radio" name="payment_mode" id="inlineRadio1" v-bind:value="mode.id">
                        {{ mode.name }}
                    </label>
                </div>
            </div>
        </fieldset>
        <button v-on:click.prevent="validOrder" class="btn btn-block" v-show="chosenService != 0">Valider</button>
    </form>
</template>

<script>
    Vue.use(require('vue-resource'));

    export default {
        props: ['products'],
        data: function(){
            return {
                services: null,
                chosenService: 0,
                modes: null,
                chosenPayment: 0,
                date: new Date(),
                capacity: 1,
                isAvailable: null
            }
        },
        methods: {
            initDateComponents: function(){
                let options = {
                    monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                    today: 'Aujourd\'hui',
                    clear: 'Effacer',
                    formatSubmit: 'yyyy-mm-dd',
                    format: 'd mmmm yyyy',
                    firstDay: 1,
                    min: new Date(),
                    onClose: () => {
                        $(document.activeElement).blur();
                    },
                    onSet: (context) => {
                        this.date.setTime(context.select);
                    }
                };

                $('input[name="date"]').pickadate(options);

                options = {
                    format: 'H:i',
                    clear: 'Effacer',
                    onClose: () => {
                        $(document.activeElement).blur();
                    },
                    onSet: (context) => {
                        this.date.setHours(parseInt(context.select / 60));
                        this.date.setMinutes(context.select % 60);
                    }
                };

                $('input[name="time"]').pickatime(options);
            },
            checkAvailabilities: function(){
                let restaurant = Lockr.get('restaurant');
                let url = laroute.route('tables-availabilities', {id: restaurant});
                Vue.http.get(url, {params: {
                    year: this.date.getFullYear(),
                    month: this.date.getMonth() + 1,
                    date: this.date.getDate(),
                    hours: this.date.getHours(),
                    minutes: this.date.getMinutes(),
                    capacity: this.capacity
                }}).then((response) => {
                    this.isAvailable = response.body.length > 0;
                });
            },
            validOrder: function(){
                let restaurant = Lockr.get('restaurant');
                let url = laroute.route('order.store', {id: restaurant});
                Vue.http.post(url, {
                    products: this.products,
                    date: {
                        year: this.date.getFullYear(),
                        month: this.date.getMonth() + 1,
                        date: this.date.getDate(),
                        hours: this.date.getHours(),
                        minutes: this.date.getMinutes()
                    },
                    service: this.chosenService
                }).then((response) => {
                    if(response.body.orderID != null){
                        let url = laroute.route('payment.store', {
                            order: response.body.orderID,
                        });
                        $('input[name="_token"]').val(Laravel.csrfToken);
                        $('#order-form').attr('action', url).submit();
                    }
                });
            }
        },
        mounted(){
            this.initDateComponents();
        },
        created(){
            let restaurant = Lockr.get('restaurant');
            let url = laroute.action('restaurants.services.index', {restaurant: restaurant});
            Vue.http.get(url).then((response) => {
                this.services = response.body;
            });

            url = laroute.route('restaurants.payments.index', {restaurant: restaurant});
            Vue.http.get(url).then((response) => {
                this.modes = response.body;
            });
        }
    }
</script>
