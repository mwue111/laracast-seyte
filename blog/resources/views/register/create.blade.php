<x-layout>
    <section class="px-6 px-8">
        <main class="max-w-lg mx-auto mt-10">
            <h1 class="text-center font-bold text-xl">¡Regístrate!</h1>

            <x-panel>
                <form method="POST" action="/register" class="mt-10">
                    @csrf

                    <x-form.input name="name" />
                    <x-form.input name="email" type="email" autocomplete="username"/>
                    <x-form.input name="username" />
                    <x-form.input name="password" type="password" autocomplete="new-password" />

                    <x-form.button>Registrarse</x-form.button>

                    @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-red-500 test-xs mt-1">{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif

                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
