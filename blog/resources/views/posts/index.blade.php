
<x-layout>

    @include('posts._header')

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

            @if($posts->count())
                <x-posts-grid :posts="$posts" />
            @else
                <p class="text-center">No hay posts aún, vuelve en otro momento.</p>
            @endif
        </main>

    <!-- antiguo:
     @foreach($posts as $post)
        <article>
            <h1>
                <a href="/posts/{{$post->slug}}">
                    {{$post->title}}
                </a>
            </h1>
            <p>
                Por <a href="/autor/{{$post->author->username}}">{{$post->author->name}}</a>, categoría <a href="/categoria/{{$post->category->slug}}">{{$post->category->name}}</a>
            </p>
            <div>
                {{$post->excerpt}}
            </div>
        </article>
    @endforeach -->
</x-layout>
