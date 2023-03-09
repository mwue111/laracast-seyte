@auth
    <x-panel>

    <form method="POST" action="/posts/{{ $post->slug }}/comments">
        @csrf

        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="avatar desde pravatar" width="50" height="50" class="rounded-full">
            <h2 class="ml-4">¿Quieres participar?</h2>
        </header>

        <div class="mt-6">
            <textarea
                    name="body"
                    class="w-full text-sm focus:outline-none focus:ring"
                    rows="5"
                    placeholder="¿Qué opinas?"
                    required
            ></textarea>

            @error('body')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end mt-4 pt-4 border-t border-gray-200">
            <x-form.button>
                Enviar
            </x-form.button>
        </div>

    </form>
    </x-panel>
    @else
        <p>
            ¡<a href="/register" class="hover:underline"> <strong>Regístrate</strong></a> o
            <a href="/login" class="hover:underline"> <strong>inicia sesión</strong></a> para participar!
        </p>
    @endauth
