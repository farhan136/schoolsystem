@extends('layouts.form')

@section('title', 'Login')

@section('additionalstyle')
<style>
    body {background-color: #15c908 !important;}
    .login-box{  margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
    }

</style>
@endsection

@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h2><b>SCHOOL</b>SYSTEM</h2>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your journey</p>

      <form action="{{url('/dologin')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" id="hidetransparant"></span>
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
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook (Not Ready)
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+ (Not Ready)
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password (Not Ready)</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership (Not Ready)</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
@endsection