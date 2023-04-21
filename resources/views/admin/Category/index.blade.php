@extends('admin.layouts.admin')

@section('css')

@endsection

@section('title', 'Categories')
@section('adminContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-{{ $category_create ? 'primary' : 'info'}}">
                <div class="card-header">
                    <h3 class="card-title"> {{ $category_create ? 'Create Category' : 'Edit Category' }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if($category_create)
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category">Category Name</label>
                            <input type="text" name="category" class="form-control" id="category" placeholder="Category Name">
                            @error('category')
                            <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Category Description"></textarea>
                            @error('description')
                            <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                @else
                <form method="POST" action="{{ route('categories.update', $category->id) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category">Email address</label>
                            <input type="text" name="category" class="form-control" id="category" value="{{ $category->category }}">
                            @error('category')
                            <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Category Description">{{ $category->description }}</textarea>
                            @error('description')
                            <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
        @if($category_create == false)
          <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="alert alert-info">Table content will be available after edit is completed!</div>
          </div>
        @else
          <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">All Categories</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Name</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                          </thead>
                          <tbody>

                              @if($categories->count())
                              @foreach ($categories as $category)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ ucwords($category->category) }}</td>
                                  <td>
                                      <a href="{{ route('categories.edit', $category->id) }}" class="bg-transparent border-transparent btn btn-info"><i class="fas fa-edit text-info"></i></a>
                                  </td>
                                  <td>
                                      <form id="delete" action="{{ route('categories.delete', $category->id) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="bg-transparent border-transparent"><i class="fas fa-trash fa-1x text-danger"></i></button>
                                      </form>
                                  </td>
                              </tr>
                              @endforeach
                              @else
                              <div class="text-danger">No Category Found</div>
                              @endif

                          </tbody>
                      </table>
                  </div>
                  <!-- /.card-body -->

              </div>
          </div>
        @endif
      </div>
    </div>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script>
    $(function() {
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            var link = $(this).data("id");
            console.log({
                link
            });

            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if ($("#delete").submit()) {
                        Swal.fire(
                            'Deleted!'
                            , 'Category deleted.'
                            , 'success'
                        )
                    }
                }
            })
        })

    })

</script>
@endsection
