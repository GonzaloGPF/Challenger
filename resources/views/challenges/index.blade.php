@extends('layouts.app')

@section('content')
    <h1>Challenges</h1>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('challenges.list')

                {{ $challenges->render() }}
            </div>
{{--            <div class="col-md-4">
                @if(count($trending))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Trending Threads
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach($trending as $thread)
                                    <li class="list-group-item">
                                        <a href="{{ $thread->path }}">{{ $thread->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>--}}
        </div>
    </div>
@endsection