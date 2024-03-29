@extends('admin.layouts.admin')

@section('css')

@endsection

@section('title', 'All Codes')
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
                        <h3 class="card-title"><a href="{{ route('activation.create') }}" class="btn btn-outline-info"><i class="fas fa-plus"></i> Create new</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="ids" id="ids" class="all_ids"></th>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @if($codes->count())
                            <tbody>
                                @foreach ($codes as $code)
                                <tr>
                                    <td><input type="checkbox" name="ids" id="ids"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $code->code }}</td>
                                    <td>
                                        @if($code->status == 1)
                                        <div class="btn btn-success">Activated</div>
                                        @else
                                        <div class="btn btn-secondary">Inactive</div>
                                        @endif
                                    </td>
                                    <td>
                                        <form id="delete" action="{{ route('activation.destroy', $code->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-transparent border-transparent"><i class="fas fa-trash fa-1x text-danger"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                            <h4>Try again later!</h4>

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
                        );
                    } else {
                        Swal.fire(
                            'Error!'
                            , 'Failed to delete content.'
                            , 'error'
                        );
                    }
                }
            });

        })

    })

</script>
@endsection
