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
                            <div class="col-md-4">All Sellers</div>
                            <div class="col-md-7 ">
                                <input type="text" class="form-control" placeholder="Search name...."
                                    wire:model="search">
                            </div>

                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Shop Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sellers as $seller)
                                    <tr>
                                        <td><img src="{{ asset('assets/images/profile') }}/{{ $seller->profile->image }}"
                                                alt="{{ $seller->name }}" width="60"></td>
                                        <td>{{ $seller->name }}</td>
                                        <td>{{ $seller->store->name }}</td>
                                        <td>{{ $seller->email }}</td>
                                        <td>{{ $seller->profile->mobile }}</td>
                                        <td>{{ $seller->profile->address }}</td>
                                        <td>{{ $seller->created_at->diffForHumans() }}</td>

                                        <td>
                                            <a href="{{ route('admin.editseller', ['seller_id' => $seller->id]) }}"><i
                                                    class="fa fa-edit fa-2x"></i>
                                            </a>
                                            <a href="#" wire:click.prevent="deleteSeller({{ $seller->id }})"><i
                                                    class="fa fa-times fa-2x text-danger "
                                                    style="margin-left: 10px"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $sellers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
