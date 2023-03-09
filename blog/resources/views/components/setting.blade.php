@props(['heading'])

<section class="px-6 py-8 max-w-4xl mx-auto">
        <h1 class="text-lg font-bold mb-8 pb-2 border-b">
            {{ $heading }}
        </h1>

        <!--div para el flex-->
        <div class="flex">
            <!--Queremos que las páginas que se creen tengan una sección aside-menú con links...-->
            <aside class="w-48 flex-shrink-0">
                <h4 class="font-semibold mb-4">Links</h4>
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/admin/posts"
                            class='{{ request()->is("admin/posts") ? "text-blue-500 font-semibold" : "" }}'
                        >
                            Tus posts
                        </a>
                    </li>
                    <li>
                        <a href="/admin/posts/create"
                            class='{{ request()->is("admin/posts/create") ? "text-blue-500 font-semibold" : "" }}'
                        >
                            Nuevo post
                        </a>
                    </li>
                    <li>
                        <a href="/">Categorías</a>
                    </li>
                </ul>
            </aside>

            <!--... y una sección main en la que se volcará el código y los componentes que correspondan:-->
            <main class="flex-1">
                <x-panel>

                    {{ $slot }}

                </x-panel>
            </main>
        </div>

    </section>
