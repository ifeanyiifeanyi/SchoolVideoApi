@extends('admin.layouts.admin')

@section('css')

@endsection

@section('title', 'All Videos')
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><a href="{{ route('video.create') }}" class="btn btn-outline-info"><i class="fas fa-plus"></i> Create new</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:20px"><input type="checkbox" name="ids" id="ids" class="all_ids"></th>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th style="width:60px">Thumbnail</th>
                                    <th style="width:20px">Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            @if($videos->count())
                            <tbody>
                                @foreach ($videos as $video)
                                <tr>
                                    <td><input type="checkbox" name="ids" id="ids" class="all_ids"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($video->title) }} 
                                        <a href="{{ route('video.show', $video->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>
                                    <td>{{ ucwords($video->category->category) }}</td>
                                    <td><img style="width:50px" src="{{ asset($video->thumbnail) }}" alt="thumbnail" class="img-fluid img-thumbnail"></td>
                                    <td><a href="{{ route('video.edit', $video->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a></td>
                                    <td>{{ ucwords($video->title) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                                <p>No Videos</p>
                            @endif

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script>
    document.querySelector('.all_ids').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = this.checked;
        }, this);
    });

</script>

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
                            , 'Content deleted.'
                            , 'success'
                        )
                    }
                }
            })
        })

    })

</script>
@endsection
