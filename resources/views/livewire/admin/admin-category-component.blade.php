<div>
    <style>
        nav svg {
            height: 20px;

        }

        nav.hidden {
            display: block !important;
        }

    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row" style="min-height:500px">
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4">All Categories</div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" placeholder="Search by id or name...."
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
                                    <th>Id</th>
                                    <th>Category Name</th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>

                                        <td>
                                            <a
                                                href="{{ route('admin.editcategory', ['category_slug' => $category->slug]) }}"><i
                                                    class="fa fa-edit fa-2x"></i>
                                            </a>
                                            <a href="#" wire:click.prevent="deleteCategory({{ $category->id }})"><i
                                                    class="fa fa-times fa-2x text-danger "
                                                    style="margin-left: 10px"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
