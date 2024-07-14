<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | E-Tooth</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="flex flex-col items-center px-6 py-10">
        <form method="POST" action="{{ route('register') }}"
            class="w-full max-w-2xl p-10 bg-white rounded-3xl shadow-lg">
            @csrf
            <div class="flex flex-col gap-6">
                <a href="{{ route('front.index') }}">
                    <img src="{{ asset('assets/svgs/logo.svg') }}" alt="E-Tooth Logo" class="w-auto h-auto">
                </a>

                <!-- Name -->
                <div class="w-full">
                    <label for="name" class="block text-sm font-semibold mb-2">Nama</label>
                    <input type="text" name="name" id="name" placeholder="Your name"
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                        value="{{ old('name') }}" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="w-full mt-4">
                    <label for="email" class="block text-sm font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="Your email address"
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                        value="{{ old('email') }}" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="w-full mt-4">
                    <label for="password" class="block text-sm font-semibold mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="Protect your password"
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="w-full mt-4">
                    <label for="password_confirmation" class="block text-sm font-semibold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm your password"
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                        required autocomplete="new-password" />
                </div>

                <!-- Hidden Role Input -->
                <input type="hidden" name="role" value="buyer">

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 mt-6 bg-primary text-white font-bold rounded-full">
                    Daftar
                </button>

                <div class="w-full text-center mt-4">
                    <a class="text-gray-600 hover:text-gray-900 underline" href="{{ route('login') }}">
                        Sudah Punya Akun?
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>