@extends('admin.layouts.admin')

@section('css')

@endsection

@section('title', 'Members')
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
                        <h1>Members</h1>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>username</th>
                                    <th>Email</th>
                                    <th>Activation Code</th>
                                    <th>Status</th>
                                    <th>Email Verified</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @if($users->count())
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->activationCode->code ?? 'N/A' }}</td>
                                    <td>
                                        @if($user->status == 1)
                                        <p>
                                            User Approved

                                        </p>
                                        <p>
                                            @if ($user->status === 1 && $user->name === "Admin" && $user->is_email_verified === 1)

                                            <a href="!#" class="badge badge-success">Admin</a>

                                            @else
                                            <a onclick="return confirm('Are you sure you want to do this?')" href="{{ route('manage.users.Unverified', $user->id) }}" class="btn btn-sm btn-warning">Suspend User </a>
                                            @endif
                                        </p>
                                        @else
                                        <p>
                                            User Not Verifed

                                        </p>
                                        <a href="{{ route('manage.users.verify', $user->id) }}" class="btn btn-sm btn-info">Verify User </a>
                                        <p></p>
                                        @endif
                                    </td>

                                    <td>
                                        @if($user->is_email_verified == 1)
                                        <p>
                                            Email Verified

                                        </p>

                                        @else
                                        <p>
                                            Email Not Verifed

                                        </p>

                                        @endif
                                    </td>

                                    <td>

                                        <a href="{{ route('manage.users.show', $user->id) }}" class="btn btn-sm btn-secondary mt-2">View User </a>

                                        @if ($user->status === 1 && $user->name === "Admin" && $user->is_email_verified === 1)

                                        <a href="!#" class="badge badge-success">Admin</a>

                                        @else
                                        <form id="delete" action="{{ route('manage.users.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-light border-transparent"><i class="fas fa-trash fa-1x text-danger"></i></button>
                                        </form>

                                        @endif

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
                        )
                    }
                }
            })
        })

    })

</script>
@endsection
