<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                Add New Deliveryman
                            </div>

                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="addDeliveryman">
                            <div class="row mt-2">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Deliveryman Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Deliveryman Name"
                                                class="form-control input-md" wire:model="name" required>
                                        </div>
                                        @error('name')
                                            <span class="text-denger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Deliveryman Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="Deliveryman Email"
                                                class="form-control input-md" wire:model="email" required>
                                        </div>
                                        @error('email')
                                            <span class="text-denger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Deliveryman Password</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="Deliveryman Password"
                                                class="form-control input-md" wire:model="password" required>
                                        </div>
                                        @error('password')
                                            <span class="text-denger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Deliveryman Image</label>
                                        <div class="col-md-12">
                                            <input type="file" class="input-file" wire:model="image">
                                            @if ($image)
                                                <img src="{{ $image->temporaryUrl() }}" width="120" />
                                            @endif
                                        </div>
                                        @error('image')
                                            <span class="text-denger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label"> Mobile</label>
                                        <div class="col-md-12">
                                            <input type="number" placeholder="Deliveryman Mobile Number"
                                                class="form-control input-md" wire:model="mobile" required>
                                        </div>
                                        @error('mobile')
                                            <span class="text-denger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Address</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control input-md" placeholder="DEliveryman Address" wire:model="address" required></textarea>

                                        </div>
                                        @error('address')
                                            <span class="text-denger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-1"></div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
