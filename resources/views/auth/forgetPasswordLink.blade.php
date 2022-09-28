@extends("layouts.main")


@section('title', "Update password")
@section('content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Reset Password</p>
        @if(Session::has('error'))
            <p class="alert alert-danger">{{ Session('error') }}</p>
        @endif
        <form action="{{ route('reset.password.post') }}" method="post">
            @csrf
            <br>
            <input type="hidden" name="token" value="{{ $token }}">
            <br>
            <div class="input-group mb-3">
                <input type="email" name="email" class="@error('email') border-danger @enderror form-control"
                    placeholder="Email" value="{{ old('email') }}" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text @error('email') input-group-text border-danger @enderror">
                        @if($errors->has('email'))
                        <span class="fas fa-times-circle text-danger border-danger"></span>
                        @else
                        <span class="fas fa-envelope"></span>
                        @endif
                    </div>
                </div>
                <div class="container">
                    @error('email')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="@error('password') border-danger @enderror form-control"
                    placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text @error('password') input-group-text border-danger @enderror">
                        @if($errors->has('password'))
                        <span class="fas fa-times-circle text-danger border-danger"></span>
                        @else
                        <span class="fas fa-lock"></span>
                        @endif
                    </div>
                </div>
                <div class="container">
                    @error('password')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password_confirmation"
                    class="@error('password_confirmation') border-danger @enderror form-control"
                    placeholder="Confirm password">
                <div class="input-group-append">
                    <div
                        class="input-group-text @error('password_confirmation') input-group-text border-danger @enderror">
                        @if($errors->has('password_confirmation'))
                        <span class="fas fa-times-circle text-danger border-danger"></span>
                        @else
                        <span class="fas fa-lock"></span>
                        @endif
                    </div>
                </div>
                <div class="container">
                    @error('password_confirmation')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Reset password</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.form-box -->
</div>





@endsection
