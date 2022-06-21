<x-layout>
    <x-slot name="content">
        <article>
            <h1>
                {{ $post->title }}
            </h1>

            <p>
                By <a href="#">{{ $post->user->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
            </p>

            <p>
                {!! $post->body !!}
            </p>
        </article>
        <a href="/"><< Back</a>
    </x-slot>
</x-layout>