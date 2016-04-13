
@section('register')

    <div class="col-md-8 col-md-offset-2">
        
        <div class="front-page-header"><div class="row">
            <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-tag"></div></div>
            <div class="col-xs-11"><h2>Register</h2></div>
        </div></div>
        
        <div class="panel panel-default">

            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('blog::user.store') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ isset($errors) && $errors->has('reg-username') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Username</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="reg-username" value="{{ old('reg-username') }}">

                            @if (isset($errors) && $errors->has('reg-username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reg-username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('reg-email') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="reg-email" value="{{ old('reg-email') }}">

                            @if (isset($errors) && $errors->has('reg-email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reg-email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('reg-password') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="reg-password">

                            @if (isset($errors) && $errors->has('reg-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reg-password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('reg-password_confirmation') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="reg-password_confirmation">

                            @if (isset($errors) && $errors->has('reg-password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reg-password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ isset($errors) && $errors->has('sentinel_register') ? ' has-error' : '' }}">
                        <div class="col-md-4"></div>
                        @if (isset($errors) && $errors->has('sentinel_register'))
                            <div class="col-md-6">
                                <span class="help-block">
                                    <strong>{{ $errors->first('sentinel_register') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
