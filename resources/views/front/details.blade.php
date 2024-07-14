
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi | E-Tooth</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="htpps://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="relative flex items-center justify-between gap-5 wrapper">
        <a href="{{ route('front.index') }}" class="p-2 bg-white rounded-full">
            <img src="{{asset('assets/svgs/ic-arrow-left.svg')}}" class="size-5" alt="">
        </a>
        <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
            Details
        </p>
    </section>

    <img src="{{ Storage::url($product->photo) }}" class="h-[220px] w-auto mx-auto max-w-full relative z-10" alt="">
    <section
        class="bg-white rounded-t-[60px] pt-[60px] px-6 pb-5 -mt-9 flex flex-col gap-5 max-w-[425px] mx-auto items-center text-center">
        <div class="w-full">
            <div class="flex items-center justify-between w-full">
                <div class="flex flex-col gap-1 items-center">
                    <p class="font-bold text-[22px]">
                        {{ $product->name }}
                    </p>
                    <div class="flex items-center gap-1.5 justify-center">
                        <img src="{{ Storage::url($product->category->icon) }}" class="size-[30px]" alt="">
                        <p class="font-semibold text-balance">
                            {{ $product->category->name }}
                        </p>
                    </div>
                </div>
            </div>
            <p class="mt-3.5 text-base leading-7">
                {{$product->about}}
            </p>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('front.konsultasi') }}"
                class="inline-flex w-max text-white font-bold text-base bg-primary rounded-full px-[30px] py-3 justify-center items-center whitespace-nowrap">
                Konsultasi Sekarang
            </a>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <script src="{{asset('scripts/sliderConfig.js')}}" type="module"></script>
</body>

</html>