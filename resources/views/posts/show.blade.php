@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1><i class="fa fa-thumbs-up"></i> {{ $post->title }}</h1></div>

                <div class="card-body">

                    @session('success')
                        <div class="alert alert-success" role="alert"> 
                            {{ $value }}
                        </div>
                    @endsession

                    {{ $post->body }}

                    <h4 class="mt-4">Comments:</h4>

                    <form method="post" action="{{ route('posts.comment.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body" placeholder="Write Your Comment..."></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group text-end">
                            <button class="btn btn-success mt-2"><i class="fa fa-comment"></i> Add Comment</button>
                        </div>
                    </form>
                    
                    <hr/>
                    @include('posts.comments', ['comments' => $post->comments, 'post_id' => $post->id])
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
