<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Cart</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            @if (Session::has('success_message'))
                <div class="alert alert-success">
                    <strong>Success </strong>{{ Session::get('success_message') }}
                </div>
            @endif
            @if (Cart::instance('cart')->count() > 0)
                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Products Name</h3>
                    <ul class="products-cart">
                        <li class="pr-cart-item">
                            <div class="product-image">
                                Image
                            </div>
                            <div class="product-name">
                                Food Name
                            </div>
                            <div class="price-field produtc-price">
                                Price
                            </div>
                            <div class="quantity">
                                Action
                            </div>
                            <div class="price-field sub-total">
                                Subtotal
                            </div>
                            <div class="delete">
                                Delete
                            </div>
                        </li>

                        @foreach (Cart::instance('cart')->content() as $item)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('assets/images/foods') }}/{{ $item->model->image }}"
                                            alt="{{ $item->model->name }}">
                                    </figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                        href="{{ route('food.details', ['slug' => $item->model->slug]) }}">{{ $item->model->name }}</a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price"><i
                                            class="fa fa-rmb"></i>{{ $item->model->regular_price }}</p>
                                </div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{ $item->qty }}"
                                            data-max="120" pattern="[0-9]*">
                                        <a class="btn btn-increase" href="#"
                                            wire:click.prevent="increaseQuantity('{{ $item->rowId }}')"></a>
                                        <a class="btn btn-reduce" href="#"
                                            wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')"></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price"><i
                                            class="fa fa-rmb"></i>{{ $item->qty * $item->model->regular_price }}
                                    </p>
                                </div>
                                <div class="delete">
                                    <a href="#" class="btn btn-delete" title=""
                                        wire:click.prevent="destroy('{{ $item->rowId }}')">
                                        <span>Delete from your cart</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>

                <div class="summary">
                    <div class="order-summary">
                        <h4 class="title-box">Order Summary</h4>
                        <p class="summary-info"><span class="title">Subtotal</span><b
                                class="index"><i
                                    class="fa fa-rmb"></i>{{ Cart::instance('cart')->subtotal() }}</b></p>
                        <p class="summary-info"><span class="title">Tax</span><b
                                class="index">{{ Cart::instance('cart')->tax() }}</b></p>
                        <p class="summary-info"><span class="title">Shipping</span><b
                                class="index">Free
                                Shipping</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b
                                class="index"><i
                                    class="fa fa-rmb"></i>{{ Cart::instance('cart')->total() }}</b></p>
                    </div>
                    <div class="checkout-info">
                        <a class="btn btn-checkout" href="#" wire:click.prevent="checkout">Check out</a>
                        <a class="link-to-shop" href="/shop">Continue <i class="fa fa-arrow-circle-right"
                                aria-hidden="true"></i></a>
                    </div>
                    <div class="update-clear">
                        <a class="btn btn-clear" href="#" wire:click.prevent="destroyAll()">Clear Cart</a>

                    </div>
                </div>
            @else
                <div class="text-center" style="padding: 30px 0">
                    <h1><strong>No item in cart</strong></h1>
                    <p>Add items to it now</p>
                    <a href="/shop" class="btn btn-success"> Add </a>
                </div>

            @endif
        </div>
    </div>

</main>
