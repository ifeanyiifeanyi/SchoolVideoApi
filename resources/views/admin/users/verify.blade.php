@extends('admin.layouts.admin')

@section('css')

@endsection

@section('title', "Verify | ".$user->name )
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
            <div class="col-md-6">
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
            <div class="col-md-6">
                <form method="post" action="{{ route('manage.users.verifyUpdate') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    <div class="form-group">
                        <div class="mb-2">
                            <label for="activation_code">Select Activation Code</label>
                            <select class="form-control" name="activation_code">
                                <option disabled>Select Activation Code</option>
                                @if($codes->count())
                                    @foreach($codes as $code)
                                    <option value="{{ $code->code }}">{{ $code->code }}</option>
                                    @endforeach
                                @else
                                <option disabled>Try Again Later</option>
                                @endif
                            </select>
                            @error('activation_code')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info">Verify User / Verification Code</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- /.content -->
</div>
@endsection
@section('js')

@endsection
