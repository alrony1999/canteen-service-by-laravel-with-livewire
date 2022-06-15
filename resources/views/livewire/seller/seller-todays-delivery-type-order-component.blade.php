<div class="container">
    @if (Session::has('order_message'))
        <div class="alert alert-success" role="alert">{{ Session::get('order_message') }}</div>
    @endif
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h6 class="text-muted font-weight-normal mt-1">Pending delivery type Orders</h6>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0">{{ $delivery }}</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pending Delivery Orders</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    <th>Food id</th>
                                    <th>Quantity</th>
                                    <th>Payment</th>
                                    <th>Address</th>
                                    <th>Order Time</th>
                                    <th>Status</th>
                                    <th>D Status</th>
                                    <th colspan="2" class="text-center"> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($delivery_orders->where('order_status', '!=', 'canceled')->where('deliveryman_status', '!=', 'delivered') as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->food->id }}</td>
                                        <td>{{ $order->quantity }}</td>

                                        <td>{{ $order->payment->status }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        @if ($order->order_status == 'ordered')
                                            <td>Ordered</td>
                                        @elseif($order->order_status == 'canceled')
                                            <td>Canceled</td>
                                        @elseif($order->order_status == 'processing')
                                            <td>Precessing</td>
                                        @elseif($order->order_status == 'ready')
                                            <td>Ready</td>
                                        @elseif($order->order_status == 'delivered')
                                            <td>Delivered</td>
                                        @endif
                                        @if ($order->deliveryman_status == 'no')
                                            <td>Not Picked</td>
                                        @elseif($order->deliveryman_status == 'picked')
                                            <td>Picked</td>
                                        @elseif($order->deliveryman_status == 'received')
                                            <td>On The Way</td>
                                        @elseif($order->deliveryman_status == 'delivered')
                                            <td>Delivered</td>
                                        @endif
                                        <td><a href="{{ route('seller.orderdetails', ['order_id' => $order->id]) }} "
                                                class="btn btn-info btn-sm">Details</a>
                                        </td>
                                        @if (!($order->order_status === 'canceled'))
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown">Status
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="nav-item">
                                                            <a class="nav-link btn btn-primary" href="#"
                                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'processing')">Processing</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link btn btn-primary" href="#"
                                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'ready')">Ready</a>
                                                        </li>


                                                        <li class="nav-item">
                                                            <a class="nav-link btn btn-primary" href="#"
                                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'canceled')">Canceled</a>
                                                        </li>
                                                    </ul>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $delivery_orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
