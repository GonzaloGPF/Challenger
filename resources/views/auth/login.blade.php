@extends('layouts.app')

@section('content')
<div class="card w-50 mx-auto mt-3">

    <h1 class="card-header">Login</h1>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email" class="sr-only">Your email</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons prefix grey-text">email</i></span>
                    <input placeholder="Your email" id="email" name="email" required class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                </div>
                @if($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="sr-only">Your password</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons prefix grey-text">lock</i></span>
                    <input placeholder="Your password" type="password" id="password" name="password" required class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                </div>
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </div>

            <div class="form-group d-flex justify-content-between">
                <div class="form-check">
                    <label class="form-check-label ml-3">
                        <input class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
                <a class="" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

</div>
@endsection
