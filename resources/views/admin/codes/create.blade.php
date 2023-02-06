@extends('admin.layouts.admin')



@section('title', 'Create Codes')
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="{{ route('activation.store') }}" method="post">
                        @csrf
                        <div class="input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Action
                                </button>
                                <ul class="dropdown-menu bg-primary">
                                    <li class="dropdown-item btn bg-primary"><a href="#" onclick="generatePassword()"><i
                                                class="fas fa-plus"></i> Generate Code</a></li>
                                </ul>
                            </div>
                            <!-- /btn-group -->

                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                            <button type="submit" class=" ml-2 btn btn-info">Save Code</button>

                            @error('code')
                                <p class="container text-danger small mt-2">{{ $message }}</p>
                            @enderror


                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script>
    function generatePassword() {
      var password = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      for (var i = 0; i < 10; i++) {
        password += possible.charAt(Math.floor(Math.random() * possible.length));
      }
      document.getElementById("code").value = password;
    }
</script>

@endsection