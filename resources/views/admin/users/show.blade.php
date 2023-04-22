@extends('admin.layouts.admin')

@section('css')

@endsection

@section('title', "User | ".$user->name )
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

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                               
                                <tr>
                                    <th>Device</th>
                                    <td>{{ $user->device ?? 'No Device' }}</td>
                                </tr>
                                <tr>
                                    <th>Activation Code</th>
                                    <td>{{ $user->activation_code ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        @if(file_exists($user->image))
                                        <img width="180px" src="{{ asset($user->image) }}" alt="" />
                                        @else
                                        <img width="180px" src="{{ asset('admin/dist/img/avatar.png') }}" alt="" />
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $user->status == 1 ? 'Active' : 'Not Verified' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
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

                                </tr>
                            </thead>

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

@endsection
