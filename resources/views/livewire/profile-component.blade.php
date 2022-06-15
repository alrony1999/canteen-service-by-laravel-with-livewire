<div>
    <div class="container" style="padding: 30px 0">
        <div class="panel panel-default">
            <div class="panel-heading">
                Profile
            </div>
            <div class="panel-body">
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="col-md-4">
                    @if ($user->profile->image)
                        <img src="{{ asset('assets/images/profile') }}/{{ $user->profile->image }}" width="60%"
                            height="10">
                    @else
                        <img src="{{ asset('assets/images/profile/default.jpg') }}" width="60%">
                    @endif

                </div>
                <div class="col-md-8">
                    <p><b>Name: </b>{{ $user->name }}</p>
                    <p><b>Email: </b>{{ $user->email }}</p>

                    <p><b>Phone: </b>{{ $user->profile->mobile }}</p>
                    <p><b>Address: </b>{{ $user->profile->address }}</p>

                    <a href="{{ route('editprofile') }}" class="btn btn-info ">Update Profile</a>
                </div>

            </div>
        </div>
    </div>
</div>
