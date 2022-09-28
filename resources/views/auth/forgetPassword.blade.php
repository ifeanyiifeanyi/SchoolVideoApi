@extends("layouts.main")


@section('title', "Login")
@section('content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Reset Password</p>
        @if(Session::has('message'))
            <p class="alert alert-success" role="alert">{{ Session('message') }}</p>
        @endif
        <form action="{{ route('forget.password.post') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="@error('email') border-danger @enderror form-control"
                    placeholder="Email" value="{{ old('email') }}">
                <div class="input-group-append">
                    <div class="input-group-text @error('email') input-group-text border-danger @enderror">
                        @if($errors->has('email'))
                        <span class="fas fa-times-circle text-danger border-danger"></span>
                        @else
                        <span class="fas fa-briefcase"></span>
                        @endif
                    </div>
                </div>
                <div class="container">
                    @error('email')
                    <p class="text-danger small mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="row">

                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Send password reset link</button>
                </div>


                <!-- /.col -->
            </div>
        </form>


    </div>
    <!-- /.form-box -->
</div>





@endsection
