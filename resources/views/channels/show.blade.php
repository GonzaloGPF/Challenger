@extends('layouts.app')

@section('content')
    <div class="container">
        <channel-chat :data="{{ $channel }}"></channel-chat>
    </div>
@endsection