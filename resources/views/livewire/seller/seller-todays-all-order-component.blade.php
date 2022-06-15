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
                                <h6 class="text-muted font-weight-normal mt-1"> Total Order Today</h6>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0">{{ $totalorder }}</h3>
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
                    <h4 class="card-title">Total Order Today</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    <th>Food id</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>D Status</th>
                                    <th colspan="2" class="text-center"> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->food->id }}</td>
                                        <td><i class="fa fa-rmb">{{ $order->price }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td><i class="fa fa-rmb"></i>{{ $order->total }}</td>

                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        @if ($order->deliveryman_status == 'delivered')
                                            <td>Delivered</td>
                                        @elseif ($order->order_status == 'ordered')
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

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
