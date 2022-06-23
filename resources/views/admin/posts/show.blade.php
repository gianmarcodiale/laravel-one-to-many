@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row row-cols-2 border border-secondary rounded p-4">
            <div class="col">
                <img class="img-fluid" src="{{ $post->cover_image }}" alt="">
            </div>
            <div class="col">
                <div class="metadata">
                    <figure>
                        <blockquote class="blockquote">
                            <h4>{{ $post->title }}</h4>
                            <figcaption class="blockquote-footer mt-3">
                                Author: <cite title="author">{{ $post->author }}</cite>
                            </figcaption>
                        </blockquote>
                    </figure>
                    <div class="metadata mb-2 text-underline">
                        CATEGORY: <em>{{ $post->category ? $post->category->name : 'N/A' }}</em>
                    </div>
                    <p>{{ $post->content }}</p>
                    <small class="text-primary">{{ $post->slug }}</small>
                </div>
            </div>
        </div>
    </div>
@endsection
