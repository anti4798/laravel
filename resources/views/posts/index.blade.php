@extends('master')

@section('content')

    <h1>List of Posts</h1>
    <hr>
    <ul>
        @forelse($posts as $post)
        <li>
            {{ $post->title }}
            <small>
                By {{ $post->user->name }}
            </small>
        </li>
        @empty
            <p>There is no article!</p>
        @endforelse
        @if($posts)
            <div class="text-center">
                {!! $posts->render() !!}
            </div>
        @endif
    </ul>
@stop