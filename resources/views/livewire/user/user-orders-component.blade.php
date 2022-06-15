<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }

    </style>
    <div class="container" style="padding: 30px 0;">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Today's Orders
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>

                                    <th>Mobile</th>
                                    <th>Order Mode</th>
                                    <th>Payment Mode</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->food->name }}</td>
                                        <td><i class="fa fa-rmb"></i>{{ $order->price }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td><i class="fa fa-rmb"></i>{{ $order->total }}</td>
                                        <td>{{ $order->mobile }}</td>
                                        <td>{{ $order->order_mode }}</td>
                                        <td>{{ $order->payment->status }}</td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>

                                        @if ($order->deliveryman_status == 'delivered')
                                            <td>Delivered</td>
                                        @elseif($order->deliveryman_status == 'received')
                                            <td>On The Way</td>
                                        @elseif ($order->deliveryman_status == 'picked')
                                            <td>Picked</td>
                                        @elseif($order->order_status == 'delivered')
                                            <td>Delivered</td>
                                        @elseif($order->order_status == 'ready')
                                            <td>Ready</td>
                                        @elseif($order->order_status == 'processing')
                                            <td>Precessing</td>
                                        @elseif($order->order_status == 'ordered')
                                            <td>Ordered</td>
                                        @elseif($order->order_status == 'canceled')
                                            <td>Canceled</td>
                                        @endif
                                        <td><a href="{{ route('user.orderdetails', ['order_id' => $order->id]) }} "
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
