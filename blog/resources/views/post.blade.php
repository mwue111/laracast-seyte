<x-layout>
@section('title')
{{$post->title}}
@endsection

    <article>
        <h1>
            {{$post->title}}
        </h1>
        <div>
            {!!$post->body!!}
        </div>
    </article>

    <a href="/">Volver</a>
</x-layout>
