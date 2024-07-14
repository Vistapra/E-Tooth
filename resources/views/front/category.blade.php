<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Edukasi | E-Tooth</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Topbar -->
    <section class="relative flex items-center justify-between gap-5 wrapper">
        <a href="{{ route('front.index') }}">
            <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
        </a>
        <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
            {{ $category->name }}
        </p>
    </section>

    <!-- Search Results -->
    <section class="wrapper flex flex-col gap-2.5">
        <div class="flex flex-col gap-4">
            @forelse($products as $product)
            <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center container-relative">
                <img src="{{ Storage::url($product->photo) }}" class="w-full max-w-[70px] max-h-[70px] object-contain"
                    alt="{{ $product->name }}">
                <div class="flex flex-wrap items-center justify-between w-full gap-1">
                    <div class="flex flex-col gap-1">
                        <a href="{{ route('front.product.details', $product->slug) }}"
                            class="text-base font-semibold whitespace-nowrap w-[150px] truncate">
                            {{ $product->name }}
                        </a>
                        <p class="text-sm text-grey whitespace-nowrap w-[150px] truncate">
                            {{ $product->about }}
                        </p>
                    </div>
                    <div class="flex">
                        @for ($i = 0; $i < 5; $i++) <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]"
                            alt="">
                            @endfor
                    </div>
                </div>
            </div>
            @empty
            <p class="text-gray-500">No Result found.</p>
            @endforelse
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>