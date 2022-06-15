<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel ">

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal" enctype="multipart/form-data"
                            wire:submit.prevent="addFood({{ Auth::user()->store->id }})">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Food Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Product Name" class="form-control input-md"
                                                wire:model="name" wire:keyup="generateSlug">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Short Description</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="Short Description" wire:model="short_description"></textarea>
                                            @error('short_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Description</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="Description" wire:model="description"></textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Category</label>
                                        <div class="col-md-12">
                                            <select class="form-control" wire:model="category_id">
                                                <option>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Regular Price</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Regular Price" class="form-control input-md"
                                                wire:model="regular_price">
                                            @error('regular_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Sale Price</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Sale Price" class="form-control input-md"
                                                wire:model="sale_price">
                                            @error('sale_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">SKU</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="SKU" class="form-control input-md"
                                                wire:model="SKU">
                                            @error('SKU')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Stock</label>
                                        <div class="col-md-12">
                                            <select class="form-control" wire:model="stock_status">
                                                <option value="instock">InStock</option>
                                                <option value="outofstock">Out Of Stock</option>
                                            </select>
                                            @error('stock_status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Quantity</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Quantity" class="form-control input-md"
                                                wire:model="quantity">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Food Image</label>
                                        <div class="col-md-12">
                                            <input type="file" class="input-file" wire:model="image">
                                            @if ($image)
                                                <img src="{{ $image->temporaryUrl() }}" width="120" />
                                            @endif
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Product Gallery</label>
                                        <div class="col-md-12">
                                            <input type="file" class="input-file" wire:model="images" multiple>
                                            @if ($images)
                                                @foreach ($images as $image)
                                                    <img src="{{ $image->temporaryUrl() }}" width="120" />
                                                @endforeach

                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">

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
