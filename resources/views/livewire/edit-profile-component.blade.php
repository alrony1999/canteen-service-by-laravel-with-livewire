<div>
    <div class="container" style="padding: 30px 0">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Profile
            </div>
            <div class="panel-body">

                <form wire:submit.prevent="updateProfile">
                    <div class="col-md-4">
                        @if ($newimage)
                            <img src="{{ $newimage->temporaryUrl() }}" width="100%">
                        @elseif($image)
                            <img src="{{ asset('assets/images/profile') }}/{{ $image }}" width="100%">
                        @else
                            <img src="{{ asset('assets/images/profile/default.jpg') }}" width="100%">
                            <input type="file" class="form-control" wire:model="newimage">
                        @endif

                    </div>
                    <div class="col-md-8">
                        <p><b>Email: </b>{{ $email }}</p>
                        <p><b>Name: </b><input type="text" class="form-control" wire:model="name"></p>

                        <p><b>Phone: </b><input type="text" class="form-control" wire:model="mobile"></p>

                        <p><b>Address: </b><input type="text" class="form-control" wire:model="address"></p>

                        <button type="submit" class="btn btn-info pull-right">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
