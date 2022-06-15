<div class="container">
    <div class="row">
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
                                <h3 class="mb-0"> {{ $todayorder }} </h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row ">
        @if (Session::has('order_message'))
            <div class="alert alert-success" role="alert">{{ Session::get('order_message') }}</div>
        @endif
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My Pending Delivery Items</h4>
                    <div class="table-responsive">
                        @if ($mypendingdelivery->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Store Name</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Customer Name</th>
                                        <th>Customer Mobile</th>
                                        <th>Customer Address</th>
                                        <th>Order Status</th>
                                        <th colspan="2" class="text-center"> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mypendingdelivery as $order)
                                        <tr>
                                            <td>{{ $order->store->name }}</td>
                                            <td><i class="fa fa-rmb"></i>{{ $order->total }}</td>
                                            @if ($order->payment->status == 'pending')
                                                <td>Pending</td>
                                            @elseif($order->payment->status == 'received')
                                                <td>Received</td>
                                            @elseif($order->payment->status == 'declined')
                                                <td>Declined</td>
                                            @endif
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->mobile }}</td>
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

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown">Action
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">

                                                        <li class="nav-item">
                                                            <a class="nav-link btn btn-primary" href="#"
                                                                wire:click.prevent="updateDeliverymanStatus({{ $order->id }},'received')">Received</a>
                                                        </li>

                                                        <li class="nav-item">
                                                            <a class="nav-link btn btn-primary" href="#"
                                                                wire:click.prevent="updateDeliverymanStatus({{ $order->id }},'delivered')">Delivered</a>
                                                        </li>

                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <div>
                                Empty
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
