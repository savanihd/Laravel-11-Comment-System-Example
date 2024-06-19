@foreach($comments as $comment)
    <div class="display-comment row mt-3" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <div class="col-md-1 text-end img-col">
            <img src="https://randomuser.me/api/portraits/men/43.jpg" class="img-user">
        </div>
        <div class="col-md-11">
            <strong>{{ $comment->user->name }}</strong>
            <br/><small><i class="fa fa-clock"></i> {{ $comment->created_at->diffForHumans() }}</small>
            <p>{!! nl2br($comment->body) !!}</p>
            <form method="post" action="{{ route('posts.comment.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <textarea class="form-control" name="body" placeholder="Write Your Reply..." style="height: 40px;"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post_id }}" />
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-warning"><i class="fa fa-reply"></i> Reply</button>
                    </div>
                </div>
            </form>
            @include('posts.comments', ['comments' => $comment->replies])
        </div>
    </div>
@endforeach