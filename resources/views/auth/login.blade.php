<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-Tooth</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="flex flex-col items-center px-6 py-10">
        <form method="POST" action="{{ route('login') }}" class="w-full max-w-2xl p-10 bg-white rounded-3xl shadow-lg">
            @csrf
            <div class="flex flex-col gap-6">
                <a href="{{ route('front.index') }}">
                    <img src="{{ asset('assets/svgs/logo.svg') }}" alt="E-Tooth Logo" class="w-auto h-auto">
                </a>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Email Address -->
                <div class="flex flex-col gap-4">
                    <label for="email" class="text-lg font-semibold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Your email address"
                        class="pl-12 py-4 w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                        style="background-image: url('{{ asset('assets/svgs/ic-email.svg') }}'); background-size: 24px; background-position: 10px center; background-repeat: no-repeat;"
                        value="{{ old('email') }}" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-4 mt-4">
                    <label for="password" class="text-lg font-semibold">Password</label>
                    <input type="password" name="password" id="password" placeholder="Protect your password"
                        class="pl-12 py-4 w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                        style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}'); background-size: 24px; background-position: 10px center; background-repeat: no-repeat;"
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Forgot Password -->
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 mt-6 bg-primary text-white font-bold rounded-full">
                    Masuk
                </button>

                <div class="w-full text-center mt-4">
                    <a class="text-gray-600 hover:text-gray-900 underline" href="{{ route('register') }}">
                        Belum Punya Akun?
                    </a>
                </div>

                <a href="{{ route('register') }}"
                    class="w-full py-3 mt-4 bg-primary text-white font-bold rounded-full text-center">
                    Daftar
                </a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>