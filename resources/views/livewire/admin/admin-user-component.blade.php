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
                            <div class="col-md-4">All Users</div>
                            <div class="col-md-4 ">
                                <input type="text" class="form-control" placeholder="Search by id...."
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
                                    <th>Id</th>
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
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>Null</td>
                                        {{-- <td><img src="{{ asset('assets/images/profile') }}/{{ $user->profile->image }}"
                                                alt="{{ $user->name }}" width="60"></td> --}}
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>Null
                                        </td>
                                        <td>Null</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>

                                        <td>

                                            <a href="#" wire:click.prevent="deleteUser({{ $user->id }})"><i
                                                    class="fa fa-times fa-2x text-danger "
                                                    style="margin-left: 10px"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
