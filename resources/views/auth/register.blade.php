@extends('layouts.app')

@section('content')
<div class="card w-50 mx-auto mt-3">

    <h1 class="card-header">Register</h1>

    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name" class="sr-only">Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">account_circle</i></span>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                </div>
                @if($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="email" class="sr-only">E-Mail Address</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">mail</i></span>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email address">
                </div>
                @if($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">lock</i></span>
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                </div>
                @if($errors->has('password'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="password-confirm" class="sr-only">Password</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">lock</i></span>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>

        </form>
    </div>
</div>
@endsection
