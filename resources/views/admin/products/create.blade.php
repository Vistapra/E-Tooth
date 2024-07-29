<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Edukasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="w-full rounded-3xl bg-red-500 text-white p-2 mb-2">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Category -->
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Kategori')" />
                            <select name="category_id" id="category_id" class="block mt-1 w-full text-black" required>
                                <option value="" class="text-black">Pilih Kategori Artikel</option>
                                @forelse($categories as $kategori)
                                    <option value="{{ $kategori->id }}" class="text-black">{{ $kategori->name }}</option>
                                @empty
                                    <option value="" class="text-black">Tidak ada kategori</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Photo -->
                        <div class="mt-4">
                            <x-input-label for="photo" :value="__('Foto')" />
                            <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" required
                                autofocus autocomplete="photo" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <!-- About -->
                        <div class="mt-4">
                            <x-input-label for="about" :value="__('Deskripsi Edukasi')" />
                            <div id="editor" class="border border-slate-300 rounded-xl w-full text-black"
                                required>{{ old('about') }}</div>
                            <input type="hidden" name="about" id="about" />
                            <x-input-error :messages="$errors->get('about')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Tambah Artikel') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    document.querySelector('#about').value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
