<main id="main" class="main-site">
    <style>
        .wrap-address-billing .row-in-form input[type="password"],
        .wrap-address-billing .row-in-form input[type="text"],
        .wrap-address-billing .row-in-form input[type="number"] {
            font-size: 13px;
            line-height: 19px;
            display: inline-block;
            height: 43px;
            padding: 2px 20px;
            max-width: 300px;
            width: 100%;
            border: 1px solid #e6e6e6;
        }

    </style>

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Checkout</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <form action="" wire:submit.prevent="placeOrder">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Billing Address</h3>

                            <div class="billing-address">
                                <p class="row-in-form">
                                    <label for="fname">Name</label>
                                    <input type="text" name="name" value="" placeholder="Your name" wire:model="name">
                                    @error('name')
                                        <span class="text-denger">{{ $message }}</span>
                                    @enderror
                                </p>

                                <p class="row-in-form">
                                    <label for="email">Email Addreess:</label>
                                    <input type="email" name="email" value="" placeholder="Type your email"
                                        wire:model="email">
                                    @error('email')
                                        <span class="text-denger">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Phone number</label>
                                    <input type="number" name="phone" value="" placeholder="10 digits format"
                                        wire:model="mobile">
                                    @error('mobile')
                                        <span class="text-denger">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" cols="50" rows="2" wire:model="address"></textarea>
                                    @error('address')
                                        <span class="text-denger">{{ $message }}</span>
                                    @enderror
                                </p>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Payment Method</h4>
                        @if ($paymentmode == 'card')
                            <div class="wrap-address-billing">
                                @if (Session::has('stripe_error'))
                                    <div class="alert alert-danger" role="alert">{{ Session::get('stripe_error') }}
                                    </div>
                                @endif
                                <p class="row-in-form">
                                    <label for="card-no">Card Number:</label>
                                    <input type="text" name="card-no" value="" placeholder="Card Number "
                                        wire:model="card_no">
                                    @error('card_no')
                                        <span class="text-denger">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="exp-month">Expiry Month:</label>
                                    <input type="text" name="exp-month" value="" placeholder="MM "
                                        wire:model="exp_month">
                                    @error('exp_month')
                                        <span class="text-denger">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="exp-year">Expiry Year:</label>
                                    <input type="text" name="exp-year" value="" placeholder="YYYY"
                                        wire:model="exp_year">
                                    @error('exp_year')
                                        <span class="text-denger">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="cvc">CVC:</label>
                                    <input type="password" name="cvc" value="" placeholder="CVC " wire:model="cvc">
                                    @error('cvc')
                                        <span class="text-denger">{{ $message }}</span>
                                    @enderror
                                </p>

                            </div>
                        @endif

                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-bank" value="cod" type="radio"
                                    wire:model="paymentmode">
                                <span>Cash On Delivery</span>
                                <span class="payment-desc">Order Now Pay on Delivery</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-visa" value="card" type="radio"
                                    wire:model="paymentmode">
                                <span>Debit / Credit Card</span>
                                <span class="payment-desc">There are many variations of passages of Lorem Ipsum
                                    available</span>
                            </label>

                            @error('paymentmode')
                                <span class="text-denger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (Session::has('checkout'))
                            <p class="summary-info grand-total"><span>Grand Total</span> <span
                                    class="grand-total-price">{{ Session::get('checkout')['total'] }}</span></p>
                        @endif
                        <button type="submit" class="btn btn-medium">Place order now</button>
                    </div>
                    <div class="summary-item shipping-method">
                        <h4 class="title-box f-title">Delivery method</h4>
                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="deliverymode" id="payment-method-bank" value="pick-up" type="radio"
                                    wire:model="ordermode">
                                <span>Pick-up</span>

                            </label>
                            <label class="payment-method">
                                <input name="deliverymode" id="payment-method-bank" value="delivery" type="radio"
                                    wire:model="ordermode">
                                <span>Delivery</span>

                            </label>

                            @error('ordermode')
                                <span class="text-denger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </form>

        </div>
        <!--end main content area-->
    </div>
    <!--end container-->

</main>
