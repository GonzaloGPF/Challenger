@forelse($channels as $channel)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <div class="flex">
                    <h4 class="flex">
                        <a href="{{ $channel->path() }}">
                            {{ $channel->name }}
                        </a>
                    </h4>

                    <h5>
                        Created by:
                        <a href="{{ route('profiles', $channel->creator) }}">
                            {{ $channel->creator->name }}
                        </a>
                    </h5>
                </div>

                <strong>
                    <a href="{{ $channel->path() }}">
                        {{ $channel->users_count }} {{ str_plural('user', $channel->users_count) }}
                    </a>
                </strong>

            </div>
        </div>

        <div class="panel-body">

            <div class="body">{{ $channel->description }}</div>

        </div>

        <div class="panel-footer">
            {{ $channel->users_count }} users have successfully achieved this challenge.
        </div>
    </div>

@empty

    <p>There are no Channels.</p>

@endforelse