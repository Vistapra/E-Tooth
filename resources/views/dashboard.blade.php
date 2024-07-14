<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-200 dark:bg-gray-700">
        @role('owner')
        @php
        $categories = App\Models\Category::all()->count();
        $products = App\Models\Product::all()->count();
        $doctors = App\Models\Doctor::all()->count();
        @endphp

        <div class="container mx-auto py-8 px-4">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900"
                    onclick="window.location='{{ route('admin.categories.index') }}';">
                    <div class="p-6">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                <a href="{{ route('admin.categories.index') }}" class="hover:underline">
                                    Kategori Edukasi
                                </a>
                            </dt>
                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                {{ $categories }}
                            </dd>
                        </dl>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900"
                    onclick="window.location='{{ route('admin.products.index') }}';">
                    <div class="p-6">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                <a href="{{ route('admin.products.index') }}" class="hover:underline">
                                    Edukasi
                                </a>
                            </dt>
                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                {{ $products }}
                            </dd>
                        </dl>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900"
                    onclick="window.location='{{ route('admin.doctor.index') }}';">
                    <div class="p-6">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                <a href="{{ route('admin.doctor.index') }}" class="hover:underline">
                                    Dokter
                                </a>
                            </dt>
                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                {{ $doctors }}
                            </dd>
                        </dl>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900"
                    onclick="window.location='{{ route('chatify') }}';">
                    <div class="p-6">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                <a href="{{ route('chatify') }}" class="hover:underline">
                                    Konsultasi & Riwayat
                                </a>
                            </dt>
                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                0
                                <!-- Jumlah konsultasi & riwayat -->
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        @role('doctor|buyer')
        <div class="container mx-auto py-8 px-4">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900"
                    onclick="window.location='{{ route('chatify') }}';">
                    <div class="p-6">
                        <dl>
                            <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                <a href="{{ route('chatify') }}" class="hover:underline">
                                    Konsultasi & Riwayat
                                </a>
                            </dt>
                            <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                0
                                <!-- Jumlah konsultasi & riwayat -->
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        @endrole
    </div>
</x-app-layout>