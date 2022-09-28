@extends("layouts.main")


@section('title', "Register")
@section('content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="name" class="@error('name') border-danger @enderror form-control"
                    placeholder="Full name" value="{{ old('name') }}">
                <div class="input-group-append">
                    <div class="input-group-text @error('name') input-group-text border-danger @enderror">
                        @if($errors->has('name'))
                        <span class="fas fa-times-circle text-danger border-danger"></span>
                        @else
                        <span class="fas fa-users"></span>
                        @endif
                    </div>
                </div>
                <div class="container">
                    @error('name')
                    <p class="text-danger small mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="input-group mb-3">
                <input type="text" name="username" class="@error('username') border-danger @enderror form-control"
                    placeholder="Username" value="{{ old('username') }}">
                <div class="input-group-append">
                    <div class="input-group-text @error('username') input-group-text border-danger @enderror">
                        @if($errors->has('username'))
                            <span class="fas fa-times-circle text-danger border-danger"></span>
                        @else
                            <span class="fas fa-user"></span>
                        @endif
                    </div>
                </div>
                <div class="container">
                    @error('username')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="email" name="email" class="@error('email') border-danger @enderror form-control"
                    placeholder="Email" value="{{ old('email') }}">
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
                <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
</div>





@endsection
