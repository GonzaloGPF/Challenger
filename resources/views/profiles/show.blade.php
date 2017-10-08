@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>{{ $user->name }}</h2>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" id="created-challenges-tab" data-toggle="tab" href="#created-challenges" role="tab" aria-controls="created-challenges" aria-expanded="true">
                        <a class="nav-link active" href="#">Created Challenges</a>
                    </li>
                    <li class="nav-item" id="challenges-tab" data-toggle="tab" href="#challenges" role="tab" aria-controls="challenges" aria-expanded="true">
                        <a class="nav-link" href="#">Challenges</a>
                    </li>
                </ul>
                <div class="tab-content" id="challenges-tabs">
                    <div class="tab-pane fade show active" id="created-challenges" role="tabpanel" aria-labelledby="home-tab">
                        @include('challenges.list', ['challenges' => $user->createdChallenges])
                    </div>
                    <div class="tab-pane fade" id="challenges" role="tabpanel" aria-labelledby="profile-tab">
                        @include('challenges.list', ['challenges' => $user->challenges])
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection