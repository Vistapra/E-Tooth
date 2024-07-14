@include('Chatify::layouts.headLinks')
<div class="messenger">
    {{-- ----------------------Daftar Pengguna/Grup Samping---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- Header dan bar pencarian --}}
        <div class="m-header">
            <nav>
                <a href="{{route('front.konsultasi')}}"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">E-Tooth</span> </a>
                {{-- tombol header --}}
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Input Pencarian --}}
            <input type="text" class="messenger-search" placeholder="Cari" />
            {{-- Tab --}}
            {{-- <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span> Kontak</a>
            </div> --}}
        </div>
        {{-- tab dan daftar --}}
        <div class="m-body contacts-container">
           {{-- Daftar [Pengguna/Grup] --}}
           {{-- ---------------- [ Tab Pengguna ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorit --}}
               <div class="favorites-section">
                <p class="messenger-title"><span>Favorit</span></p>
                <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               {{-- Pesan yang Disimpan --}}
               <p class="messenger-title"><span>Ruang Anda</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
               {{-- Kontak --}}
               <p class="messenger-title"><span>Semua Pesan</span></p>
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
           </div>
             {{-- ---------------- [ Tab Pencarian ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- item --}}
                <p class="messenger-title"><span>Pencarian</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Ketik untuk mencari..</span></p>
                </div>
             </div>
        </div>
    </div>

    {{-- ----------------------Sisi Pesan---------------------- --}}
    <div class="messenger-messagingView">
        {{-- judul header [nama percakapan] dan tombol --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- tombol kembali header, avatar dan nama pengguna --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="{{ route('front.konsultasi')}}" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ Auth::user()->name }}</a>
                </div>
                {{-- tombol header --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
            {{-- Koneksi internet --}}
            <div class="internet-connection">
                <span class="ic-connected">Terhubung</span>
                <span class="ic-connecting">Menghubungkan...</span>
                <span class="ic-noInternet">Tidak ada akses internet</span>
            </div>
        </div>

        {{-- Area Pesan --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Selamat Datang DiE-Tooth | Konsultasi Online Dengan Dokter</span></p>
            </div>
            {{-- Indikator Mengetik --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        {{-- Form Kirim Pesan --}}
        @include('Chatify::layouts.sendForm')
    </div>
    {{-- ---------------------- Sisi Info ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- aksi nav --}}
        <nav>
            <p>Detail Pengguna</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
