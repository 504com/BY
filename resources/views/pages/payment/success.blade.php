@extends('themes.definity')

@section('title', 'Validation commande')

@section('content')

    <div class="container section">
        <div class="row">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h5>Commande validée !</h5>
                <p>Merci de nous faire confiance ! votre commande est validée, nous nous occupons du reste</p>
            </div>
            <h1>Récapitulatif de la commande</h1>
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="http://lorempixel.com/150/100/food/" alt="Thumb product image"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ number_format($product->pivot->quantity * $product->price, 2) }}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-3 totals-group">
                <div class="totals-heading">
                    <h6>Total de la commande</h6>
                </div>
                <div class="totals-content">
                    <div class="subtotal-group">
                        <h6>Sous-total:</h6>
                        <p>{{ number_format($subtotal, 2) }}€</p>
                    </div>
                    <div class="shipping-group">
                        <h6>Livraison:</h6>
                        <p>{{ number_format($shipping, 2) }}€</p>
                    </div>
                    <div class="total-group">
                        <h5>Total:</h5>
                        <p>{{ number_format($total, 2) }}€</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <a class="btn" href="{{ route('home') }}">Retour au site</a>
            </div>
        </div>
    </div>
@endsection
