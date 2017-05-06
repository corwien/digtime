

@foreach($article->comments as $comment)
    <div class="media">
        <div class="media-left">
            <user-vote-button answer="{{ $comment->id }}" count="{{ $comment->votes_count }}"></user-vote-button>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="/user/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
            </h4>

            {!! $comment->content !!}
        </div>
    </div>
@endforeach

