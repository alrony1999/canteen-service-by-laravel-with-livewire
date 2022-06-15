<div>
    <div class="container" style="padding: 30px 0">
        <div class="row" style="min-height:400px">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 text-center">
                                Add New Category
                            </div>

                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" wire:submit.prevent="storeCategory">
                            <div class="row mt-5">
                                <div class="col-md-3"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="">Category Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Category Name" class="form-control input-md"
                                                wire:model="name" wire:keyup="generateslug" />
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 text-center">
                                    <button type="submit" class="btn btn-primary">Submit
                                    </button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
