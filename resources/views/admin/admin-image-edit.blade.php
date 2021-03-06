@extends('base')

@section('content')
<div class="container-fluid">
    <form class="row" action="" enctype="multipart/form-data" method="post">
        <div class="col-2 admin-bar">
            <nav class="nav flex-column">
                <a class="nav-link" href="/posts">Посты</a>
                <a class="nav-link" href="/pages">Страницы</a>
                <a class="nav-link" href="/messages">Сообщения <span class="badge">2</span></a>
                <a class="nav-link" href="/options">Настройки</a>
            </nav>
        </div>
        @csrf
        <div class="col-7 mt-3">
            <h5 class="d-inline-block">Редактирование изображение</h5>
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            <div class="card bg-light mb-3">
                <div class="card-header">Комментарии <a href="{{ action('AdminCommentController@addComment', ['image', $image->id]) }}" class="btn btn-info btn-sm">Новый</a></div>
                <div class="card-body">
                    <div class="comments">
                        @foreach( $image->comment as $comment )
                            <div class="comment mb-3 row">
                                <div class="comment-content col-md-11 col-sm-10">
                                    <div class="small">Автор: <a href="">admin</a> {{ $comment->created_at->format('d.m.Y') }}
                                        @if ( $comment->status == 'spam' )<span class="badge badge-danger">Спам</span>@endif
                                        @if ( $comment->status == 'pending' )<span class="badge badge-warning">Снят</span>@endif
                                    </div>
                                    <a href="{{ action('AdminCommentController@editComment', $comment->id) }}" class="small">Редактировать</a>
                                    <a href="{{ action('AdminCommentController@replyComment', $comment->id) }}" class="small text-info">Ответить</a>
                                    <a href="{{ action('AdminCommentController@deleteComment', $comment->id) }}" class="small text-danger">Удалить</a>
                                    <div class="comment-body mb-1">
                                        <div>{{ $comment->content }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mt-3">
            <div class="card bg-light mb-3">
                <div class="card-header">Информация</div>
                <div class="card-body">
                    <p class="card-text">Дата публикации: {{ $image->created_at->format('d.m.Y') }}</p>
                    <p class="card-text">Комментариев: {{ $image->comment->count() }}</p>
                </div>
            </div>
            <div class="card bg-light mb-3">
                @if ($image->exists())
                    <img class="card-image-top admin-card-img" src="{{ url('storage/' . $image->path) }}">
                @endif
                <div class="card-body">
                    <div class="form-group">
                        @if ($image->exists())
                            <label for="inputFile">{{ $image->name }}</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
