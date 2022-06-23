@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row row-cols-2 border border-secondary rounded p-4">
            <div class="col">
                <img style="max-width: 500px" src="{{ $post->cover_image }}" alt="">
            </div>
            <div class="col">
                <div class="metadata">
                    <h3>TITLE: {{ $post->title }}</h3>
                    <div class="metadata">
                        CATEGORY: {{$post->category ? $post->category->name : 'N/A'}}
                    </div>
                    <h4>AUTHOR: {{ $post->author }}</h4>
                    <p>{{ $post->content }}</p>
                    <small>{{ $post->slug }}</small>
                </div>
            </div>
        </div>
    </div>
@endsection
