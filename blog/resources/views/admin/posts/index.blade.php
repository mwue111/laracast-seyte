<x-layout>
    <x-setting heading="Manage posts">
                <!-- component -->
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @foreach($posts as $post)

                    <tr class="hover:bg-gray-50">
                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">

                            <div class="text-sm">
                                <div class="font-medium text-gray-700">
                                    <a href="/posts/{{$post->slug}}">
                                    {{ $post->title }}
                                    </a>
                                </div>
                            </div>

                        </th>

                        </td>
                        <td class="px-6 py-4">
                            <!-- <form action="/admin/posts/{{$post->id}}/edit" method="POST">
                                    @csrf

                                    <button type="submit" class="text-blue-500 hover:text-blue-900">Editar</button>
                            </form> -->

                        <a href="/admin/posts/{{$post->id}}/edit" class="text-blue-500 hover:text-blue-900">Editar</a>

                        <!-- <div class="flex justify-end gap-4">

                        </div> -->
                    </td>
                    <td class="px-6 py-4">
                        <form action="/admin/posts/{{$post->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-blue-900">Borrar</button>
                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </x-setting>
</x-layout>
