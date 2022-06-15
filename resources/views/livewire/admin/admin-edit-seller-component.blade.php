<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                Edit Seller
                            </div>

                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal " enctype="multipart/form-data" wire:submit.prevent="editSeller">
                            <div class="row mt-2">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Seller Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Seller Name" class="form-control input-md"
                                                wire:model="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Seller Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="Seller Email" class="form-control input-md"
                                                wire:model="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Canteen Shop Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Canteen Shop Name Name"
                                                class="form-control input-md" wire:model="shopname"
                                                wire:keyup="generateSlug" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Seller Mobile</label>
                                        <div class="col-md-12">
                                            <input type="number" placeholder="Seller Mobile Number"
                                                class="form-control input-md" wire:model="mobile" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Seller Address</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control input-md" placeholder="Seller Address" wire:model="address" required></textarea>

                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-1"></div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
