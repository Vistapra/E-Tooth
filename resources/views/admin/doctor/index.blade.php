<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Doctor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center sm:px-6 lg:px-8 py-4">
                    <a href="{{ route('dashboard') }}" class="p-2 bg-white rounded-full">
                        <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
                    </a>
                    <a href="{{ route('admin.doctor.create') }}"
                        class="ml-4 sm:ml-0 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                        Tambah Doctor
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 py-4">
        <form action="" method="GET" class="flex flex-col sm:flex-row items-center">
            <input type="text" name="query" placeholder="Search Doctor..."
                class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500 flex-grow">
            <button type="submit"
                class="mt-2 sm:mt-0 sm:ml-4 bg-blue-500 hover:bg-blue-600 text-black font-semibold py-2 px-4 rounded">
                Search
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-200 uppercase tracking-wider">
                        Photo
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-200 uppercase tracking-wider">
                        Name
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-200 uppercase tracking-wider">
                        Spesialis
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-200 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                @forelse ($doctor as $doctor)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ Storage::url($doctor->photo) }}" alt="" class="w-16 h-16">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white dark:black">
                            {{ $doctor->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white dark:black">
                            {{ $doctor->spesialis }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('admin.doctor.edit', $doctor) }}">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-3 rounded">
                                        Edit
                                    </button>
                                </a>
                                <form method="POST" action="{{ route('admin.doctor.destroy', $doctor) }}"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-3 rounded delete-button">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400 text-center">
                            Belum Ada Doctor.
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = button.closest('.delete-form');

                if (confirm('Are you sure you want to delete this doctor?')) {
                    form.submit();
                }
            });
        });
    });
</script>
