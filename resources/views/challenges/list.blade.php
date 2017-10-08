@forelse($challenges as $challenge)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <div class="flex">
                    <h4 class="flex">
                        <a href="{{ $challenge->path() }}">
                            {{ $challenge->title }}
                        </a>
                    </h4>

                    <h5>
                        Created by:
                        <a href="{{ route('profiles', $challenge->creator) }}">
                            {{ $challenge->creator->name }}
                        </a>
                    </h5>
                </div>

                <strong>
                    <a href="{{ $challenge->path() }}">
                        {{ $challenge->users_count }} {{ str_plural('user', $challenge->users_count) }}
                    </a>
                </strong>

            </div>
        </div>

        <div class="panel-body">

            <div class="body">{{ $challenge->description }}</div>

        </div>

        <div class="panel-footer">
            {{ $challenge->users_count }} users have successfully achieved this challenge.
        </div>
    </div>

@empty

    <p>There are no Challenges.</p>

@endforelse