<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('order_message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('order_message') }}</div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Ordered Details
                            </div>
                            <div class="col-md-6">

                                @if ($order->status == 'ordered')
                                    <a href="#" class="btn btn-warning pull-right" wire:click.prevent="cancelOrder"
                                        style="margin-right:20px">Cancel
                                        Order</a>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <th>Order Id</th>
                            <td>{{ $order->id }}</td>

                            <th>Order Time</th>
                            <td>{{ $order->created_at }}</td>
                            <th>Status</th>

                            @if ($order->deliveryman_status == 'picked')
                                <td>Picked</td>
                            @elseif($order->deliveryman_status == 'received')
                                <td>Recived</td>
                            @elseif($order->deliveryman_status == 'delivered')
                                <td>Delivered</td>
                            @elseif($order->order_status == 'ordered')
                                <td>Ordered</td>
                            @elseif($order->order_status == 'processing')
                                <td>Processing</td>
                            @elseif($order->order_status == 'ready')
                                <td>Ready</td>
                            @elseif($order->order_status == 'delivered')
                                <td>Delivered</td>
                            @elseif($order->order_status == 'canceled')
                                <td>Canceled</td>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Order Items
                    </div>
                    <div class="panel-body">
                        <div class="wrap-iten-in-cart">

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
                                        Quantity
                                    </div>
                                    <div class="price-field sub-total">
                                        Subtotal
                                    </div>

                                </li>
                                <li class="pr-cart-item">
                                    <div class="product-image">
                                        <figure><img
                                                src="{{ asset('assets/images/foods') }}/{{ $order->food->image }}"
                                                alt="{{ $order->food->name }}">
                                        </figure>
                                    </div>
                                    <div class="product-name">
                                        <a class="link-to-product"
                                            href="{{ route('food.details', ['slug' => $order->food->slug]) }}">{{ $order->food->name }}</a>
                                    </div>
                                    <div class="price-field produtc-price">
                                        <p class="price"><i
                                                class="fa fa-rmb"></i>{{ $order->food->regular_price }}</p>
                                    </div>
                                    <div class="quantity">
                                        <h5>{{ $order->quantity }}</h5>
                                    </div>
                                    <div class="price-field sub-total">
                                        <p class="price"><i
                                                class="fa fa-rmb"></i>{{ $order->price * $order->quantity }}</p>
                                    </div>

                                </li>
                            </ul>

                        </div>
                        <div class="summary">
                            <div class="order-summary">
                                <h4 class="title-box">Order Summary</h4>

                                <p class="summary-info"><span class="title">Tax</span><b
                                        class="index"><i class="fa fa-rmb"></i>{{ $order->tax }}</b>
                                </p>
                                <p class="summary-info"><span class="title">Delivery</span><b
                                        class="index">Free delivery</b></p>
                                <p class="summary-info"><span class="title">Total</span><b
                                        class="index"><i class="fa fa-rmb"></i>{{ $order->total }}</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Transaction
                    </div>
                    <div class="panel-body">
                        <table class="table">

                            <tr>
                                <th>Payment</th>
                                @if ($order->payment->status == 'pending')
                                    <td>Pending</td>
                                @elseif($order->payment->status == 'received')
                                    <td>Received</td>
                                @elseif($order->payment->status == 'declined')
                                    <td>Declined</td>
                                @endif

                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if ($order->order_mode == 'delivery')

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Delivery Man Details
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                @if ($order->deliveryman)
                                    <tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $order->deliveryman->name }}</td>
                                    </tr>

                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $order->deliveryman->profile->mobile }}</td>

                                    </tr>
                                @endif



                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Billing Items
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $order->name }}</td>
                            </tr>

                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $order->mobile }}</td>

                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $order->address }}</td>
                            </tr>




                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
