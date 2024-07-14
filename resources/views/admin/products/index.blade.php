<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Edukasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center sm:px-6 lg:px-8 py-4">
                    <a href="{{ route('dashboard') }}" class="p-2 bg-white rounded-full">
                        <img src="{{asset('assets/svgs/ic-arrow-left.svg')}}" class="size-5" alt="">
                    </a>
                    <a href="{{ route('admin.products.create') }}"
                        class="ml-4 sm:ml-0 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                        Tambah Edukasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 py-4">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row items-center">
            <input type="text" name="query" placeholder="Cari Artikel..."
                class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500 flex-grow">
            <button type="submit"
                class="mt-2 sm:mt-0 sm:ml-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                Cari
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-black dark:text-white uppercase tracking-wider">
                        Foto
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-black dark:text-white uppercase tracking-wider">
                        Nama
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-black dark:text-white uppercase tracking-wider">
                        Deskripsi
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-black dark:text-white uppercase tracking-wider">
                        Kategori
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-black dark:text-white uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-green divide-y divide-gray-200 dark:divide-gray-600">
                @forelse ($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ Storage::url($product->photo) }}" alt="" class="w-16 h-16">
                    </td>
                    <td class="px-6 py-4 whitespace-wrap text-sm font-semibold text-black dark:text-white">
                        <div class="name-container">
                            {{ $product->name }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap text-sm text-black dark:text-white">
                        <div class="about-container">
                            {{ $product->about }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white">
                        {{ $product->category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}">
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-3 rounded">
                                    Edit
                                </button>
                            </a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-3 rounded delete-button">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-black dark:text-white text-center">
                        Tidak Ada Artikel Yang Ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>

<style>
    .about-container,
    .name-container {
        max-height: 100px;
        overflow-y: auto;
        white-space: pre-wrap;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = button.closest('.delete-form');
                
                if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                    form.submit();
                }
            });
        });
    });
</script>