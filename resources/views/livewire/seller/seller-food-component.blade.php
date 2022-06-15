<div class="container">

    <div class="row ">
        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
        <div class="col-12 grid-margin">
            <div class="card">

                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-4">All Food</div>
                            <div class="col-md-4 ">
                                <input type="text" class="form-control" placeholder="Search by id or name...."
                                    wire:model="search">
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Seller</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($foods as $food)
                                    <tr>
                                        <td>{{ $food->id }}</td>
                                        <td><img src="{{ asset('assets/images/foods') }}/{{ $food->image }}"
                                                alt="{{ $food->name }}" width="100"></td>
                                        <td>{{ $food->name }}</td>
                                        <td>{{ $food->stock_status }}</td>
                                        <td>{{ $food->regular_price }}</td>
                                        <td>{{ $food->category->name }}</td>
                                        <td>{{ $food->store->name }}</td>
                                        <td>{{ $food->created_at }}</td>
                                        <td>
                                            <a href="{{ route('seller.editfood', ['food_slug' => $food->slug]) }}"><i
                                                    class="fa fa-edit fa-2x"></i>
                                            </a>
                                            <a onclick="confirm('Are you sure, You want To delete this Food item?') || event.stopImmediatePropagation()"
                                                href="#" wire:click.prevent="deleteFood({{ $food->id }})"><i
                                                    class="fa fa-times fa-2x text-danger "
                                                    style="margin-left: 10px"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $foods->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
