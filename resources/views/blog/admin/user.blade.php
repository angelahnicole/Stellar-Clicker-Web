@extends('master.master')

<!-- CONTENT -->
@section('content')


<section class="window" id="home">
    
    <div class="front-page-header"><div class="row">
        <div class="col-xs-1"><div class="front-page-tag"><span class="glyphicon icon-tag"></div></div>
        <div class="col-xs-11"><h2>Edit Settings for {{ $user->username }}</h2></div>
    </div></div>
    
    <div class="front-page-panel">
        
        <div class="panel panel-default">

            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('blog::user.update', ['user' => $user->id]) }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ isset($errors) && $errors->has('username') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Username</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="username" value="{{ $errors->has('username') ? old('username') : $user->username }}">

                            @if (isset($errors) && $errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ $errors->has('email')? old('email') : $user->email }}">

                            @if (isset($errors) && $errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">

                            @if (isset($errors) && $errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ isset($errors) && $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">

                            @if (isset($errors) && $errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">Admin Role</label>

                        <div class="col-md-6">
                            <input type="checkbox" name="admin_role" {{ $user->inRole('admin') ? 'checked' : '' }}>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">Blogger Role</label>

                        <div class="col-md-6">
                            <input type="checkbox" name="blogger_role" {{ $user->inRole('blogger') ? 'checked' : '' }}>
                        </div>
                    </div>
                    
                    <div class="form-group{{ isset($errors) && $errors->has('sentinel_edit') ? ' has-error' : '' }}">
                        <div class="col-md-4"></div>
                        @if (isset($errors) && $errors->has('sentinel_edit'))
                            <div class="col-md-6">
                                <span class="help-block">
                                    <strong>{{ $errors->first('sentinel_edit') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i>Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</section> 


@stop
<!-- /CONTENT -->

