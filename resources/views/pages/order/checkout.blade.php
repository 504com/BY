@extends('themes.definity')

@section('title', trans('order.title'))

@section('content')
    <div class="container section">
        <h1 class="text-center">{{ trans('order.title') }}</h1>
        <div class="row">
            <div class="col-lg-7">
                <checkout v-bind:products="products"></checkout>
            </div>
            <div class="col-lg-5 hidden-xs">
                <div class="table-responsive">
                    <table class="table checkout-table">
                        <thead>
                        <tr>
                            <th>{{ trans('cart.product') }}</th>
                            <th>{{ trans('cart.quantity') }}</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Sous-total</th>
                            <th></th>
                            <th>@{{ total.toFixed(2) }} €</th>
                        </tr>
                        <tr>
                            <th>Frais de livraison</th>
                            <th></th>
                            <th>2.00 €</th>
                        </tr>
                        <tr>
                            <th>Frais de livraison</th>
                            <th></th>
                            <th>@{{ (total + 2).toFixed(2) }} €</th>
                        </tr>
                        </tfoot>
                        <tbody v-for="(product, key) in products">
                        <tr>
                            <td>@{{ product.name }}</td>
                            <td class="td-product-qty">
                                <input v-on:change="saveCart" v-model="product.quantity" class="form-control" type="number" min="0">
                            </td>
                            <td>@{{ (product.price * product.quantity).toFixed(2) }} €</td>
                            <td>
                                <a v-on:click.prevent="removeFromCart(key)" href="#"><span class="linea-arrows-square-remove"></span></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
