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
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Username</th>
                                    <th>User Email</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            @if($codes->count())
                            <tbody>
                                @foreach ($codes as $code)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $code->code }}</td>
                                    <td>{{ $code->user->username }} </td>
                                    <td>{{ $code->user->email }} </td>
                                    <td>{{ $code->updated_at->format('M d, Y h:i A')}} </td>
                                   
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
