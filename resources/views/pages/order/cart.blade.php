@extends('themes.definity')

@section('title', trans('cart.title'))

@section('content')
    <div class="container section">
        <h1 class="text-center">{{ trans('cart.title') }}</h1>
        <div class="row">
            <div class="col-lg-9">
                <div class="table-responsive">
                    <table class="table checkout-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>{{ trans('cart.product') }}</th>
                            <th>{{ trans('cart.quantity') }}</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody v-for="(product, key) in products">
                        <tr>
                            <td>@{{ key + 1 }}</td>
                            <td><img src="http://placehold.it/140x100" v-bind:alt="product.name"></td>
                            <td>@{{ product.name }}</td>
                            <td class="td-product-qty"><input v-on:change="saveCart" v-model="product.quantity" class="form-control" type="number" min="0"></td>
                            <td>@{{ (product.price * product.quantity).toFixed(2) }} €</td>
                            <td><a v-on:click.prevent="removeFromCart(key)" href="#"><span class="linea-arrows-square-remove"></span></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <form action="#" class="checkout-coupon-form ws-m">
                    <div class="col-lg-4 no-gap-left">
                        <input type="text" class="form-control" placeholder="Coupon code">
                    </div>
                    <button class="btn btn-ghost">Apply Coupon</button>
                    <button class="btn pull-right">Update Cart</button>
                </form>
                <hr>
            </div>
            <div class="col-lg-3 totals-group">
                <div class="totals-heading">
                    <h6>Total</h6>
                </div>
                <div class="totals-content">
                    <div class="subtotal-group">
                        <h6>{{ trans('cart.subtotal') }}</h6>
                        <p>@{{ total.toFixed(2) }} €</p>
                    </div>
                    <div class="shipping-group">
                        <h6>Livraison</h6>
                        <p>0€</p>
                    </div>
                    <div class="total-group">
                        <h5>Total</h5>
                        <p>@{{ total.toFixed(2) }} €</p>
                    </div>
                    <div class="checkout-btn-wrapper">
                        <a href="{{ route('order.checkout') }}" class="btn checkout-btn">{{ trans('cart.checkout') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
