<x-layout>
@section('title')
{{$post->title}}
@endsection

    <article>
        <h1>
            {{$post->title}}
        </h1>

        <p>
            Por <a href="/autor/{{$post->author->username}}">{{$post->author->name}}</a>, categoría <a href="/categoria/{{$post->category->slug}}">{{$post->category->name}}</a>
        </p>

        <div>
            {!!$post->body!!}
        </div>
    </article>

    <a href="/">Volver</a>
</x-layout>
