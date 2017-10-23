@extends('layouts.app')

@section('content')
    <div class="container">
        <channels-container :data="{{ json_encode($channels)}}"></channels-container>
    </div>
@endsection