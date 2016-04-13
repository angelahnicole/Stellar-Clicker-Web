@extends('master.master')
@include('auth.register')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="front-page-header"><div class="row">
                <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-tag"></div></div>
                <div class="col-xs-11"><h2>Login</h2></div>
            </div></div>
            
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('blog::user.validateLogin') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ isset($errors) && $errors->has('login-email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="login-email" value="{{ old('login-email') }}">

                                @if (isset($errors) && $errors->has('login-email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login-email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('login-password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="login-password">

                                @if (isset($errors) && $errors->has('login-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ isset($errors) && $errors->has('sentinel_login') ? ' has-error' : '' }}">
                            <div class="col-md-4"></div>
                            @if (isset($errors) && $errors->has('sentinel_login'))
                                <div class="col-md-6">
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sentinel_login') }}</strong>
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="login-remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ route('blog::user.createReset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
            
        </div>
    </div>
    
    <div class='row'>
    
    
    @yield('register')
    
    </div>
    
</div>

@endsection
