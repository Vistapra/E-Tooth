<!-- view home E-Tooth -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tooth</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/Logo_depan.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="fixed z-50 bottom-[30px] bg-black rounded-[50px] pt-[18px] px-10 left-1/2 -translate-x-1/2 w-80">
        <div class="flex items-center justify-center gap-5 flex-nowrap">
            <a href="{{ route('front.index') }}"
                class="flex flex-col items-center justify-center gap-1 px-1 group is-active">
                <img src="{{ asset('assets/svgs/ic-grid.svg') }}"
                    class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Edukasi</p>
            </a>
            <a href="{{ route('front.konsultasi') }}"
                class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-consultation.svg') }}"
                    class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Konsultasi</p>
            </a>
            <a href="{{ route('front.riwayat') }}" class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-note.svg') }}"
                    class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Riwayat</p>
            </a>
        </div>
    </nav>

    <section class="wrapper flex flex-col gap-2.5 items-center justify-center">
        <p class="text-4xl font-extrabold text-center">
            <picture>
                <source srcset="{{ asset('assets/svgs/Logo_depan.svg') }}" type="image/svg+xml">
                <img src="{{ asset('assets/images/Logo_depan.png') }}" alt="Logo"
                    class="mx-auto cursor-pointer w-full h-auto max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl"
                    onclick="redirectToLogin()">
            </picture>
        </p>
        <form action="{{ route('front.search') }}" method="GET" id="searchForm" class="w-full">
            <input type="text" name="keyword" id="searchProduct"
                class="block w-full py-3.5 pl-4 pr-10 rounded-full font-semibold placeholder:text-grey placeholder:font-normal text-black text-base bg-no-repeat bg-[calc(100%-16px)] focus:ring-2 focus:ring-primary focus:outline-none focus:border-none transition-all"
                placeholder="Cari Edukasi...">
        </form>
    </section>

    <section class="wrapper !px-0 flex flex-col gap-2.5">
        <p class="px-4 text-base font-bold">
            Kategori Edukasi
        </p>
        <div id="categoriesSlider" class="relative">
            @forelse($categories as $category)
                <div class="inline-flex gap-2.5 items-center py-3 px-3.5 relative bg-white rounded-xl mr-4">
                    <img src="{{ Storage::url($category->icon) }}" class="size-10" alt="">
                    <a href="{{ route('front.product.category', $category) }}"
                        class="text-base font-semibold truncate stretched-link">
                        {{ $category->name }}
                    </a>
                </div>
            @empty
                <p class="px-4 text-base text-gray-500">Belum Ada Kategori Artikel</p>
            @endforelse
        </div>
    </section>

    <section class="wrapper">
        <div
            class="flex justify-between gap-5 items-center bg-lilac py-3.5 px-4 rounded-2xl relative bg-left bg-no-repeat bg-cover">
            <p class="text-base font-bold">Inovasi Digital dalam Perawatan Gigi</p>
            <img src="{{ asset('assets/images/doctor.png') }}" class="w-[90px] h-[70px]" alt="">
        </div>
    </section>

    <section class="wrapper py-4 px-0">
        <h2 class="px-4 text-lg font-bold mb-2">Edukasi</h2>
        <div class="relative px-[1rem] max-w-full overflow-x-auto">
            <div class="inline-flex gap-4 items-center">
                @forelse($products as $p)
                    <div class="inline-flex flex-col items-center w-48 h-48 bg-white shadow-md rounded-lg">
                        <a href="{{ route('front.product.details', $p->slug) }}">
                            <img src="{{ Storage::url($p->photo) }}" class="h-40 w-full object-cover rounded-t-lg"
                                alt="{{ $p->name }}">
                        </a>
                        <a href="{{ route('front.product.details', $p->slug) }}"
                            class="text-base font-semibold mt-2 mb-1 truncate w-full px-4">{{ $p->name }}</a>
                    </div>
                @empty
                    <div class="inline-flex flex-col items-center w-48 h-48 bg-white shadow-md rounded-lg">
                        <p class="text-center p-4 text-gray-500">Belum Ada Artikel</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="wrapper">
        <div class="bg-lilac py-3.5 px-5 rounded-2xl relative bg-right-bottom bg-no-repeat bg-auto text-center">
            <img src="{{ asset('assets/svgs/great-doctors.svg') }}" class="mx-auto mb-1.5" alt="">
            <div class="flex flex-col gap-4 mb-[23px]">
                <p class="text-base font-bold text-orange">Konsultasikan Gigi anda dengan Dokter E-Tooth</p>
                <a href="{{ route('front.konsultasi') }}"
                    class="rounded-full bg-[rgb(0,191,173)] text-white flex w-max gap-2.5 px-6 py-2 justify-center items-center text-base font-bold mx-auto">Konsultasi
                    Sekarang</a>
            </div>
        </div>
    </section>

    <section class="wrapper flex flex-col gap-2.5 pb-40">
        <p class="text-base font-bold">Edukasi Terbaru</p>
        <div class="flex flex-col gap-4" id="product-list">
            @php
                $itemCount = count($products);
                $displayLimit = 10;
            @endphp

            @foreach ($products as $index => $d)
                <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative product-item"
                    style="{{ $index >= $displayLimit ? 'display: none;' : '' }}">
                    <img src="{{ Storage::url($d->photo) }}" class="w-full max-w-[70px] max-h-[70px] object-contain"
                        alt="{{ $d->name }}">
                    <div class="flex flex-wrap items-center justify-between w-full gap-1">
                        <div class="flex flex-col gap-1">
                            <a href="{{ route('front.product.details', $d->slug) }}"
                                class="text-sm font-semibold stretched-link">{{ $d->name }}</a>
                            <a href="{{ route('front.product.details', $d->slug) }}"
                                class="text-sm text-gray-500 stretched-link">{!! Str::words($d->about, 10, '...') !!}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($itemCount > $displayLimit)
            <button id="next-button" class="mt-4 text-white py-2 px-4 rounded"
                style="background-color: #00bfad;">Next</button>
        @endif
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.product-item');
            const nextButton = document.getElementById('next-button');
            let currentPage = 1;
            const itemsPerPage = {{ $displayLimit }};

            if (nextButton) {
                nextButton.addEventListener('click', function() {
                    const totalPages = Math.ceil(items.length / itemsPerPage);
                    const nextPage = currentPage + 1;
                    const start = currentPage * itemsPerPage;
                    const end = start + itemsPerPage;

                    if (nextPage <= totalPages) {
                        for (let i = start; i < end && i < items.length; i++) {
                            items[i].style.display = 'flex';
                        }
                        currentPage = nextPage;
                    }

                    if (currentPage === totalPages) {
                        nextButton.style.display = 'none';
                    }
                });
            }
        });
    </script>

    <script>
        function redirectToLogin() {
            window.location.href = "{{ route('dashboard') }}";
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <script src="{{ asset('scripts/sliderConfig.js') }}" type="module"></script>
</body>

</html>
