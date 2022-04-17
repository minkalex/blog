@extends('layouts.index')

@section('title', "Posts by $user")

@section('content')
    <div class="row mb-5">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <li class="list-group-item list-group-item-success" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-text-paragraph" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm4-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    Posts by <b>{{ $user }}</b>

                </li>
                @foreach ($objPosts as $objPost)
                    <a class="list-group-item list-group-item-action" id="post-{{ $objPost->id }}" data-bs-toggle="list"
                       href="#list-post-{{ $objPost->id }}" role="tab" aria-controls="list-post-{{ $objPost->id }}">
                        {{ $objPost->title }}
                        <p class="text-end mb-0"><small>{{ $objPost->created_at->format('d.m.Y H:i') }}</small></p>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-8">
            @if (Session::exists('comment_add'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong>{{ Session::get('comment_add') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                @if (Session::exists('comment_error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <strong>{{ Session::get('comment_error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <div class="tab-content" id="nav-tabContent">
                @foreach ($objPosts as $objPost)
                    <div class="tab-pane fade" id="list-post-{{ $objPost->id }}" role="tabpanel"
                         aria-labelledby="list-post-{{ $objPost->id }}-list">
                        {{ $objPost->description }}
                        @if (Auth::check())
                            <form action="" method="post">
                                @csrf
                                <div class="form-floating mt-5">
                                    <textarea class="form-control" placeholder="Leave a comment here"
                                              id="floatingTextarea" name="comment"></textarea>
                                    <label for="floatingTextarea">Your comment here...</label>
                                </div>
                                <input value="{{ $objPost->id }}" type="hidden" name="post_id">
                                <div class="mt-1 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-outline-success btn-sm">save</button>
                                </div>
                            </form>
                            @if (!empty($objPost->comments))
                                <p class="fs-4 mt-5">Comments</p>
                                <div class="list-group list-group-flush">
                                    @foreach($objPost->comments as $comment)
                                        <a href="#" class="list-group-item">
                                            <h5 class="mb-1">{{ \App\Models\User::find($comment->user_id)->full_name }}</h5>
                                            <p class="mb-1">{{ $comment->text }}</p>
                                            <small>{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                                        </a>
                                        @foreach($objComments as $obComments)
                                            @foreach($obComments as $index => $objComment)
                                                @if ($index === $comment->id)
                                                    <div class="list-group list-group-flush ms-5">
                                                        @foreach($objComment as $cmmnt)
                                                            <div class="list-group-item">
                                                                <h5 class="mb-1">{{ \App\Models\User::find($cmmnt->user_id)->full_name }}</h5>
                                                                <p class="mb-1">{{ $cmmnt->text }}</p>
                                                                <small>{{ $cmmnt->created_at->format('d.m.Y H:i') }}</small>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <nav class="mb-5">
        <ul class="pagination pagination justify-content-center">
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
            <li class="page-item active" aria-current="page">
                <span class="page-link">1</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
    <a href="{{ route('main') }}" type="button" class="btn btn-outline-success">&larr; Home</a>
@endsection
