@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Pengadaan</b>App</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    
                    <div class="input-group mb-3">
                        <input type="username" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                    </div>

                    <div class="social-auth-links text-center mb-3">
                            <button class="btn btn-block btn-primary text-center" type="submit">
                                <i class=""></i> Login
                            </button>

                    </div>
                </form>


                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="#">Saya lupa password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Request Pendaftaran</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
@endsection
