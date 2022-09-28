@extends("layouts.main")


@section('title', "Login")
@section('content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Login</p>
        @if(Session::has('status'))
            <p class="alert alert-danger">{{ Session('status') }}</p>
        @endif
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session('message') }}</p>
        @endif
        <form action="{{ route('login.submit') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="login" class="@error('login') border-danger @enderror form-control"
                    placeholder="Username or Email" value="{{ old('login') }}">
                <div class="input-group-append">
                    <div class="input-group-text @error('login') input-group-text border-danger @enderror">
                        @if($errors->has('login'))
                        <span class="fas fa-times-circle text-danger border-danger"></span>
                        @else
                        <span class="fas fa-users"></span>
                        @endif
                    </div>
                </div>
                <div class="container">
                    @error('login')
                    <p class="text-danger small mt-2">{{ $message }}</p>
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

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember" value="agree">
                        <label for="remember">
                            Remember me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>


                <!-- /.col -->
            </div>
        </form>
        <div class="col-12 mt-4">
            <p class="mb-1">
                <a href="{{ route('forget.password.get') }}" style="color: teal">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register.view') }}" class="text-center">Register a new membership</a>
            </p>
        </div>

    </div>
    <!-- /.form-box -->
</div>





@endsection
