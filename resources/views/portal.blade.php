<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bappelitbangda Mahulu') }} - Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 min-h-screen flex flex-col relative selection:bg-sky-300 selection:text-sky-900">

    <!-- Fixed Abstract Background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none bg-sky-50">
        <!-- Main Blue Base -->
        <div class="absolute inset-0 bg-gradient-to-br from-sky-400 via-sky-100 to-sky-300 opacity-90"></div>
        
        <!-- Abstract Shapes -->
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-sky-500/50 blur-[120px] animate-pulse"></div>
        <div class="absolute top-[20%] right-[-5%] w-[35%] h-[35%] rounded-full bg-yellow-200/20 blur-[100px]"></div>
        <div class="absolute bottom-[-10%] left-[20%] w-[40%] h-[40%] rounded-full bg-sky-400/50 blur-[100px]"></div>
        <div class="absolute bottom-[30%] right-[20%] w-[25%] h-[25%] rounded-full bg-sky-400/40 blur-[80px]"></div>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-[1920px] mx-auto flex-grow flex flex-col">

        <!-- SECTION 1: SLIDER (Top) -->
        <section class="relative w-full h-[480px] md:h-[580px] pt-[80px] bg-slate-900 overflow-hidden group">
            <!-- Tipis Background Image Overlay -->
            <div class="absolute inset-0 pointer-events-none z-0 mix-blend-overlay opacity-30">
                <img src="https://images.unsplash.com/photo-1596005554384-d293674c91d7?q=80&w=2600&auto=format&fit=crop" 
                     alt="Background Pattern" class="w-full h-full object-cover">
            </div>
            <!-- Gradient Overlay Navy to Gold Base -->
            <div class="absolute inset-0 z-0 bg-gradient-to-br from-slate-900 via-slate-900/90 to-sky-900/60 mix-blend-multiply"></div>

            <div x-data="{ activeSlide: 0, slides: [
                    { img: 'https://images.unsplash.com/photo-1605218427368-35b86121cb70?q=80&w=2600&auto=format&fit=crop', title: 'Selamat Datang di Bappelitbangda', subtitle: 'Kabupaten Mahakam Ulu' },
                    { img: 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2600&auto=format&fit=crop', title: 'Perencanaan Pembangunan', subtitle: 'Sinergi untuk Masa Depan' }
                ],
                next() { this.activeSlide = (this.activeSlide === this.slides.length - 1) ? 0 : this.activeSlide + 1 },
                prev() { this.activeSlide = (this.activeSlide === 0) ? this.slides.length - 1 : this.activeSlide - 1 },
                init() { setInterval(() => this.next(), 5000) }
            }" class="relative w-full h-full z-10">

                <!-- Slides -->
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="activeSlide === index"
                         x-transition:enter="transition transform duration-700 ease-in-out"
                         x-transition:enter-start="opacity-0 scale-105"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition transform duration-700 ease-in-out"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0 w-full h-full">
                        <img :src="slide.img" class="w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 to-transparent"></div>
                        
                        <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-24">
                            <div class="max-w-4xl transform transition-transform duration-700 hover:translate-x-2">
                                <div class="flex items-center gap-4 mb-6 md:mb-8">
                                    <div class="relative">
                                        <!-- Subtle Glow behind logo -->
                                        <div class="absolute inset-0 bg-yellow-400/30 blur-xl rounded-full animate-pulse"></div>
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/Lambang_Kabupaten_Mahakam_Ulu.png/800px-Lambang_Kabupaten_Mahakam_Ulu.png" class="h-16 md:h-24 w-auto relative z-10 drop-shadow-2xl">
                                    </div>
                                    <div class="text-white border-l-2 border-yellow-500/50 pl-4 py-1">
                                        <h2 class="font-extrabold text-xl md:text-3xl tracking-widest bg-clip-text text-transparent bg-gradient-to-r from-white to-sky-100">BAPPELITBANGDA</h2>
                                        <p class="text-xs md:text-sm tracking-[0.3em] font-medium text-yellow-400 mt-1">KABUPATEN MAHAKAM ULU</p>
                                    </div>
                                </div>
                                <h1 class="text-4xl md:text-5xl lg:text-7xl font-black text-white font-montserrat leading-[1.1] mb-6 drop-shadow-xl" 
                                    style="text-shadow: 0 4px 30px rgba(0,0,0,0.5);" x-text="slide.title"></h1>
                                <p class="text-lg md:text-2xl lg:text-3xl text-sky-100 font-medium tracking-wide border-b border-sky-400/30 pb-4 inline-block drop-shadow-md" x-text="slide.subtitle"></p>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Controls -->
                <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/5 hover:bg-white/20 hover:scale-110 border border-white/10 backdrop-blur-md text-white p-4 rounded-full transition-all shadow-xl group/btn">
                    <svg class="w-6 h-6 transform group-hover/btn:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/5 hover:bg-white/20 hover:scale-110 border border-white/10 backdrop-blur-md text-white p-4 rounded-full transition-all shadow-xl group/btn">
                    <svg class="w-6 h-6 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                </button>


            </div>
        </section>

        <!-- SECTION 2: NAVIGATION BUTTONS (Middle) -->

        <section class="container mx-auto px-4 -mt-10 relative z-20 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Website Button -->
                <a href="{{ route('beranda') }}" class="group block bg-slate-800 rounded-xl overflow-hidden shadow-2xl hover:shadow-sky-500/20 transition-all duration-300 transform hover:-translate-y-1 border border-white/10">
                    <div class="p-6 md:p-8 flex items-center justify-between relative">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black text-white font-montserrat tracking-wide group-hover:text-sky-400 transition-colors">WEBSITE</h3>
                            <p class="text-slate-400 text-sm mt-1">(klik disini)</p>
                        </div>
                        <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center group-hover:bg-sky-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </div>
                        <!-- Hover Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-sky-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </a>

                <!-- PPID Button -->
                <a href="#" class="group block bg-slate-800 rounded-xl overflow-hidden shadow-2xl hover:shadow-yellow-500/20 transition-all duration-300 transform hover:-translate-y-1 border border-white/10">
                    <div class="p-6 md:p-8 flex items-center justify-between relative">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black text-white font-montserrat tracking-wide group-hover:text-yellow-400 transition-colors">PPID</h3>
                            <p class="text-slate-400 text-sm mt-1">(klik disini)</p>
                        </div>
                        <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center group-hover:bg-yellow-500 group-hover:text-slate-900 transition-all duration-300">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                         <!-- Hover Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-yellow-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </a>
            </div>
        </section>

        <!-- SECTION 3: MAGIC BENTO GRID (Bottom) -->
        <section class="relative pb-16 pt-4" x-data="{
            spotlight: { x: 0, y: 0, opacity: 0 },
            cards: [],
            initCards() {
                this.cards = [...this.$refs.bentoGrid.querySelectorAll('.bento-card')];
            },
            handleMouseMove(e) {
                const section = this.$refs.bentoSection;
                const rect = section.getBoundingClientRect();
                const inside = e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom;

                if (!inside) {
                    this.spotlight.opacity = 0;
                    this.cards.forEach(c => c.style.setProperty('--card-glow-opacity', '0'));
                    return;
                }

                this.spotlight.x = e.clientX;
                this.spotlight.y = e.clientY;

                let minDist = Infinity;
                this.cards.forEach(card => {
                    const cr = card.getBoundingClientRect();
                    const cx = cr.left + cr.width / 2;
                    const cy = cr.top + cr.height / 2;
                    const dist = Math.max(0, Math.hypot(e.clientX - cx, e.clientY - cy) - Math.max(cr.width, cr.height) / 2);
                    minDist = Math.min(minDist, dist);

                    const relX = ((e.clientX - cr.left) / cr.width) * 100;
                    const relY = ((e.clientY - cr.top) / cr.height) * 100;
                    card.style.setProperty('--card-glow-x', relX + '%');
                    card.style.setProperty('--card-glow-y', relY + '%');

                    const glow = dist <= 150 ? 1 : dist <= 225 ? (225 - dist) / 75 : 0;
                    card.style.setProperty('--card-glow-opacity', glow.toString());
                });

                this.spotlight.opacity = minDist <= 150 ? 0.8 : minDist <= 225 ? ((225 - minDist) / 75) * 0.8 : 0;
            },
            handleMouseLeave() {
                this.spotlight.opacity = 0;
                this.cards.forEach(c => c.style.setProperty('--card-glow-opacity', '0'));
            },
            tilt(e) {
                const el = e.currentTarget;
                const r = el.getBoundingClientRect();
                const x = e.clientX - r.left;
                const y = e.clientY - r.top;
                const rx = ((y - r.height / 2) / r.height) * -8;
                const ry = ((x - r.width / 2) / r.width) * 8;
                el.style.transform = `perspective(800px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-4px)`;
            },
            resetTilt(e) {
                e.currentTarget.style.transform = '';
            },
            ripple(e) {
                const el = e.currentTarget;
                const r = el.getBoundingClientRect();
                const x = e.clientX - r.left;
                const y = e.clientY - r.top;
                const maxD = Math.max(Math.hypot(x, y), Math.hypot(x - r.width, y), Math.hypot(x, y - r.height), Math.hypot(x - r.width, y - r.height));
                const rip = document.createElement('div');
                rip.className = 'bento-ripple';
                rip.style.cssText = `width:${maxD*2}px;height:${maxD*2}px;left:${x-maxD}px;top:${y-maxD}px;`;
                el.appendChild(rip);
                setTimeout(() => rip.remove(), 700);
            }
        }" x-init="$nextTick(() => initCards())" x-ref="bentoSection"
           @mousemove.window="handleMouseMove($event)" @mouseleave.window="handleMouseLeave()">

            <!-- Spotlight -->
            <div class="bento-spotlight"
                 :style="`left:${spotlight.x}px;top:${spotlight.y}px;opacity:${spotlight.opacity};`"></div>

            <div class="container mx-auto px-4">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-black font-montserrat text-white drop-shadow-sm">e - Government</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-rose to-lavender mx-auto mt-3 rounded-full"></div>
                    <p class="text-slate-400 text-sm mt-3">Layanan digital terintegrasi Pemerintah Kabupaten Mahakam Ulu</p>
                </div>

                <!-- Bento Grid -->
                <div class="bento-grid bento-layout max-w-5xl mx-auto" x-ref="bentoGrid">

                    @php
                        $apps = [
                            ['name' => 'SIPD', 'desc' => 'Sistem Informasi Pemerintahan Daerah', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                            ['name' => 'SIMEVLAP', 'desc' => 'Monitoring & Evaluasi Lapangan', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                            ['name' => 'MUSRENBANG', 'desc' => 'Musyawarah Perencanaan Pembangunan', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                            ['name' => 'E-MUSRENBANG', 'desc' => 'Musrenbang Digital Terintegrasi', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                            ['name' => 'E-PLANNING', 'desc' => 'Perencanaan Pembangunan Elektronik', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                            ['name' => 'LPSE', 'desc' => 'Layanan Pengadaan Secara Elektronik', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z'],
                            ['name' => 'E-SSH', 'desc' => 'Standar Satuan Harga Elektronik', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['name' => 'SIMPEG', 'desc' => 'Sistem Informasi Manajemen Kepegawaian', 'icon' => 'M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2'],
                            ['name' => 'SiRUP', 'desc' => 'Sistem Informasi Rencana Umum Pengadaan', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                            ['name' => 'JDIH', 'desc' => 'Jaringan Dokumentasi & Informasi Hukum', 'icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'],
                        ];
                    @endphp

                    @foreach($apps as $index => $app)
                    <a href="#"
                       class="bento-card group flex flex-col justify-between p-5 cursor-pointer select-none"
                       @mousemove="tilt($event)" @mouseleave="resetTilt($event)" @click="ripple($event)">

                        <!-- Floating Particles (visible on hover) -->
                        <div class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            @for($p = 0; $p < 6; $p++)
                            <div class="bento-particle" style="left:{{ rand(10,90) }}%;top:{{ rand(10,90) }}%;--float-x:{{ rand(-40,40) }}px;--float-y:{{ rand(-50,20) }}px;--duration:{{ 2 + $p * 0.5 }}s;--delay:{{ $p * 0.3 }}s;"></div>
                            @endfor
                        </div>

                        <!-- Card Content -->
                        <div class="relative z-10">
                            <div class="bento-icon mb-4">
                                <svg class="w-5 h-5 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $app['icon'] }}" />
                                </svg>
                            </div>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-white font-bold text-sm md:text-base mb-1 group-hover:text-yellow-300 transition-colors">{{ $app['name'] }}</h3>
                            <p class="text-sky-100/80 text-[11px] leading-relaxed line-clamp-2">{{ $app['desc'] }}</p>
                        </div>

                        <!-- Subtle arrow on hover -->
                        <div class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-1 group-hover:translate-x-0">
                            <svg class="w-4 h-4 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </a>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="mt-auto py-6 text-center text-slate-600/60 text-sm font-medium">
            &copy; {{ date('Y') }} Bappelitbangda Kabupaten Mahakam Ulu
        </footer>

    </div>
</body>
</html>
