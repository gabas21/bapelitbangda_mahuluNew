<x-layouts.app>
    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-slate-900">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-80">
                <img src="{{ asset('images/desamahakamulu.jpg') }}"
                     alt="Mahakam Ulu" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="Background SVG"
                 class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/70 via-sky-800/50 to-sky-700/40 z-10"></div>
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="riverGoldAparatur" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#FBBF24" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#FBBF24" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#FBBF24" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldAparatur)" stroke-width="2"/>
            </svg>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/5 border border-white/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-6">
                    <div class="relative flex h-2 w-2 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                    </div>
                    Profil Instansi
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-white leading-tight drop-shadow-2xl">
                    Aparatur <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #FBBF24 0%, #F59E0B 50%, #D97706 100%);">Kami</span>
                </h1>
                <p class="mt-6 text-sky-200 text-lg font-medium max-w-2xl mx-auto leading-relaxed">
                    Sumber daya manusia yang profesional dan berdedikasi dalam melayani pembangunan Kabupaten Mahakam Ulu.
                </p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-yellow-400 transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-yellow-400">Aparatur</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 z-20">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    {{-- ===================== PAGE CONTENT ===================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        {{-- Stats Row --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-14" data-aos="fade-up">
            @foreach([
                ['label' => 'Total Aparatur', 'value' => '48', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0', 'color' => 'sky'],
                ['label' => 'Pejabat Struktural', 'value' => '12', 'icon' => 'M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'yellow'],
                ['label' => 'Staf Fungsional', 'value' => '24', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'emerald'],
                ['label' => 'Tenaga Kontrak', 'value' => '12', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'violet'],
            ] as $stat)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 flex flex-col items-center text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-{{ $stat['color'] }}-100 flex items-center justify-center text-{{ $stat['color'] }}-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
                <div class="text-3xl font-black text-slate-800">{{ $stat['value'] }}</div>
                <div class="text-sm text-slate-500 font-medium mt-1">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>

        {{-- Pejabat Cards Placeholder --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-yellow-400 to-yellow-600 rounded-full"></div>
                <h2 class="text-xl font-bold text-slate-800">Daftar Pejabat &amp; Staf</h2>
            </div>
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">Data aparatur akan ditampilkan di sini.</p>
                <p class="text-slate-400 text-sm mt-1">Konten akan diperbarui oleh tim pengelola.</p>
            </div>
        </div>
    </div>
</x-layouts.app>
