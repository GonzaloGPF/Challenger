@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>{{ $user->name }}</h2>
                </div>
                @include('channels.list', ['channels' => $user->createdChannels])
            </div>
        </div>
    </div>
@endsection