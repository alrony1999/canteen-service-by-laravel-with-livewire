<div>
    <style>
        nav svg {
            height: 20px;

        }

        nav.hidden {
            display: block !important;
        }

    </style>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4">All Deliverymen</div>
                            <div class="col-md-7 ">
                                <input type="text" class="form-control" placeholder="Search name...."
                                    wire:model="search">
                            </div>

                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deliverymen as $deliveryman)
                                    <tr>
                                        <td><img src="{{ asset('assets/images/profile') }}/{{ $deliveryman->profile->image }}"
                                                alt="{{ $deliveryman->name }}" width="60"></td>
                                        <td>{{ $deliveryman->name }}</td>
                                        <td>{{ $deliveryman->email }}</td>
                                        <td>{{ $deliveryman->profile->mobile }}</td>
                                        <td>{{ $deliveryman->profile->address }}</td>
                                        <td>{{ $deliveryman->created_at->diffForHumans() }}</td>

                                        <td>
                                            <a
                                                href="{{ route('admin.editdeliveryman', ['deliveryman_id' => $deliveryman->id]) }}"><i
                                                    class="fa fa-edit fa-2x"></i>
                                            </a>
                                            <a href="#"
                                                wire:click.prevent="deleteDeliveryman({{ $deliveryman->id }})"><i
                                                    class="fa fa-times fa-2x text-danger "
                                                    style="margin-left: 10px"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $deliverymen->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
