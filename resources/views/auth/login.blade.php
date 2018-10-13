@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row ">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        Enter Details To Login
                    </strong>
                </div>
                <div class="panel-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <br>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-tag">
                                    </i>
                                </span>
                                <input autofocus="" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" required="" type="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $errors->first('email') }}
                                        </strong>
                                    </span>
                                    @endif
                                </input>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock">
                                    </i>
                                </span>
                               <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required="" type="password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $errors->first('password') }}
                                        </strong>
                                    </span>
                                    @endif
                                </input>
                            </div>
                            <div class="form-group">
                                <label class="checkbox-inline">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                        
                                    
                                </label>
                                <span class="pull-right">
                                   
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>

                                </span>
                            </div>
                            <button class="btn btn-primary" type="submit">
                                    {{ __('Login') }}
                                </button>
                            <hr>
                                Not register ?
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                            </hr>
                        </br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
