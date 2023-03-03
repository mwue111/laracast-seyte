<x-dropdown>
    <!--x-slot permite definir slots con nombre. Es igual que @slot('trigger')/@endslot-->
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-36 text-left flex lg:inline-flex">

            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categorías' }}

            <!--Imágenes svg: se agrupan en un solo componente-->
            <!--x-down-arrow class="absolute pointer-events-none" style="right: 12px;"/-->
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>

        </button>
    </x-slot>

    <!--Links-->
    <!--href="/" y :active hacen lo mismo, pero :active hace uso de los nombres de las rutas-->
    <x-dropdown-item href="/" :active="request()->routeIs('home')">Todas</x-dropdown-item>

        @foreach($categories as $category)

            <x-dropdown-item
                href="/?category={{$category->slug}}"
                :active='request()->is("category/{{$category->slug}}")'
            >
            <!--
                :active="isset($currentCategory) && $currentCategory->is($category)"
                :active="request()->is('*' . $category->slug)" es otra manera de hacerlo, utilizando la url-->
                {{ ucwords($category->name) }}
            </x-dropdown-item>

        @endforeach
    </x-dropdown>
