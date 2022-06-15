<div class="container">
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h6 class="text-muted font-weight-normal mt-1">Total Delivery</h6>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0">{{ $totaldelivery }}</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h6 class="text-muted font-weight-normal mt-1">Pending Order</h6>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0">{{ $pendingorder }}</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h6 class="text-muted font-weight-normal mt-1">Total Delivery Today</h6>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0">{{ $todaydelivery }}</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h6 class="text-muted font-weight-normal mt-1">Total Revenue Today</h6>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0"><i class="fa fa-rmb pr-1"></i>{{ $todayRevenue }}</h3>
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
                    <h4 class="card-title">All Order</h4>
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Order No </th>
                                    <th>Store Name</th>
                                    <th>Total</th>
                                    <th>Quantity</th>
                                    <th>Payment</th>
                                    <th>Order Time</th>
                                    <th>Customer Address</th>
                                    <th>Order Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($myorderlist as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->store->name }}</td>
                                        <td><i class="fa fa-rmb"></i>{{ $order->total }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        @if ($order->payment->status == 'pending')
                                            <td>Pending</td>
                                        @elseif($order->payment->status == 'received')
                                            <td>Received</td>
                                        @elseif($order->payment->status == 'declined')
                                            <td>Declined</td>
                                        @endif
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        <td>{{ $order->address }}</td>

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
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $myorderlist->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
