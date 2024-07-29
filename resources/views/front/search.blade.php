<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Edukasi | E-Tooth</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/Logo_depan.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Topbar -->
    <section class="relative flex items-center justify-between gap-5 wrapper">
        <a href="{{ route('front.index') }}" class="p-2 bg-white rounded-full">
            <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="Back">
        </a>
        <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
            Hasil Pencarian
        </p>
    </section>

    <!-- Form Search -->
    <section class="wrapper">
        <form action="{{ route('front.search') }}" method="GET" id="searchForm" class="w-full">
            <input type="text" name="keyword" id="searchProduct"
                class="block w-full py-3.5 pl-4 pr-10 rounded-full font-semibold placeholder:text-grey placeholder:font-normal text-black text-base bg-no-repeat bg-[calc(100%-16px)] bg-[url('{{ asset('assets/svgs/ic-search.svg') }}')] focus:ring-2 focus:ring-primary focus:outline-none focus:border-none transition-all"
                placeholder="Cari Edukasi..." value="{{ request('keyword') }}">
        </form>
    </section>

    <!-- Search Results -->
    <section class="wrapper flex flex-col gap-2.5">
        <p class="text-base font-bold">Results</p>

        <div class="flex flex-col gap-4">
            <!-- Product Results -->
            @forelse($products as $product)
                <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center container-relative">
                    <img src="{{ Storage::url($product->photo) }}"
                        class="w-full max-w-[70px] max-h-[70px] object-contain" alt="{{ $product->name }}">
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
                            @for ($i = 0; $i < 5; $i++)
                                <img src="{{ asset('assets/svgs/star.svg') }}" class="w-[18px]" alt="Star">
                            @endfor
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>

        <div class="flex flex-col gap-4 mt-6">
            @forelse($doctors as $doctor)
                <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center container-relative">
                    <img src="{{ Storage::url($doctor->photo) }}"
                        class="w-full max-w-[70px] max-h-[70px] object-contain" alt="{{ $doctor->name }}">
                    <div class="flex flex-wrap items-center justify-between w-full gap-1">
                        <div class="flex flex-col gap-1">
                            <a href="{{ url('chatify', $doctor->user_id) }}"
                                class="text-base font-semibold whitespace-nowrap w-[150px] truncate">
                                {{ $doctor->name }}
                            </a>
                            <p class="text-sm text-grey whitespace-nowrap w-[150px] truncate">
                                {{ $doctor->spesialis }}
                            </p>
                        </div>
                        <div class="flex">
                            <img src="{{ asset('assets/svgs/ic-consultation.svg') }}" class="size-[35px]"
                                alt="Icon Konsultasi">
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>
