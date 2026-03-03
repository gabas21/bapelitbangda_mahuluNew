
        <!-- ============================================ -->
        <!-- SECTION 4: AGENDA INSPEKTORAT (DARK)        -->
        <!-- ============================================ -->
        <section class="py-24 relative bg-slate-900 overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute inset-0 pointer-events-none z-0">
                <!-- Abstract Shapes -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-blue-600/5 blur-[120px]"></div>
                <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full bg-sky-500/5 blur-[100px]"></div>
                <!-- Subtle grid overlay -->
                <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 32px 32px;"></div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10"
                 x-data="agendaCarousel()"
                 x-init="init()">

                <!-- Section Header -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 mb-6 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-blue-400 shadow-[0_0_10px_rgba(96,165,250,0.5)]"></span>
                        <span class="text-blue-400 font-bold tracking-widest uppercase text-xs">Jadwal Kegiatan</span>
                    </div>
                    <h2 class="font-montserrat font-black text-4xl md:text-5xl lg:text-6xl leading-tight text-white drop-shadow-lg">
                        Agenda <span class="text-blue-400">Inspektorat</span>
                    </h2>
                    <p class="mt-6 text-slate-400 text-lg font-medium max-w-2xl mx-auto">Pantau jadwal kegiatan inspeksi, pengawasan, dan rapat koordinasi terbaru di lingkungan Pemerintah Kabupaten Mahakam Ulu.</p>
                </div>

                <!-- Carousel Wrapper Container -->
                <div class="rounded-[2.5rem] border border-white/10 p-6 sm:p-8" data-aos="fade-up"
                     style="background: linear-gradient(145deg, rgba(30,41,59,0.7) 0%, rgba(15,23,42,0.8) 100%); backdrop-filter: blur(20px); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.5);">

                    <!-- Search Bar + Nav -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 mb-8">
                        <!-- Search & Date Wrapper -->
                        <div class="flex flex-col sm:flex-row flex-1 gap-3 max-w-2xl">
                            <!-- TextInput -->
                            <div class="relative flex-1 group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-white/40 group-focus-within:text-sky-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                                <input type="text"
                                       x-model="search"
                                       @input="onSearch()"
                                       placeholder="Cari kegiatan atau lokasi..."
                                       class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-white/5 border border-white/10 text-white placeholder-white/40 text-sm font-medium focus:outline-none focus:border-sky-400/50 focus:bg-white/10 focus:ring-1 focus:ring-sky-400/50 transition-all duration-300">
                                <!-- Clear button -->
                                <button x-show="search.length > 0"
                                        x-cloak
                                        @click="search = ''; onSearch()"
                                        class="absolute inset-y-0 right-10 pr-4 flex items-center cursor-pointer border-0 bg-transparent active:scale-90 transition-transform">
                                    <svg class="w-4 h-4 text-white/40 hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            <!-- DateInput -->
                            <div class="relative sm:w-48 group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-white/40 group-focus-within:text-sky-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                                <input type="date"
                                       x-model="searchDate"
                                       @change="onSearch()"
                                       title="Filter berdasarkan tanggal"
                                       class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-white/5 border border-white/10 text-white text-sm font-medium focus:outline-none focus:border-sky-400/50 focus:bg-white/10 focus:ring-1 focus:ring-sky-400/50 transition-all duration-300 [color-scheme:dark]">
                                <!-- Clear Date button -->
                                <button x-show="searchDate"
                                        x-cloak
                                        @click.prevent="searchDate = ''; onSearch()"
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer border-0 bg-transparent active:scale-90 transition-transform">
                                    <svg class="w-4 h-4 text-white/40 hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Nav Controls -->
                        <div class="flex items-center gap-4">
                            <span class="text-slate-400 text-sm font-medium bg-white/5 px-3 py-1.5 rounded-lg border border-white/5" x-text="filtered.length + ' agenda'"></span>
                            <div class="flex items-center gap-2">
                                <button @click="prev()"
                                        class="w-11 h-11 rounded-xl flex items-center justify-center transition-all duration-300 border border-white/10 bg-white/5 text-white hover:text-sky-400 hover:border-sky-400/50 hover:bg-sky-400/10 cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed shadow-lg active:scale-90"
                                        :disabled="position <= 0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                                </button>
                                <button @click="next()"
                                        class="w-11 h-11 rounded-xl flex items-center justify-center transition-all duration-300 border border-white/10 bg-white/5 text-white hover:text-sky-400 hover:border-sky-400/50 hover:bg-sky-400/10 cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed shadow-lg active:scale-90"
                                        :disabled="position >= maxPos">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                <!-- Carousel -->
                <div data-aos="fade-up"
                     x-ref="wrap"
                     class="relative overflow-hidden rounded-2xl"
                     @mousedown.prevent="onDown($event)"
                     @mousemove="onMove($event)"
                     @mouseup="onUp()"
                     @mouseleave="if(dragging) onUp()"
                     @touchstart.passive="onDown($event)"
                     @touchmove.passive="onMove($event)"
                     @touchend="onUp()"
                     :class="dragging ? 'cursor-grabbing' : 'cursor-grab'">

                    <div class="flex select-none"
                         :style="'gap:' + gap + 'px; transform:translateX(' + tx + 'px); perspective:900px;'
                            + (dragging ? 'transition:none;' : 'transition:transform 0.45s cubic-bezier(0.22,1,0.36,1);')">

                        <template x-for="(item, idx) in filtered" :key="item._i">
                            <div class="flex-shrink-0"
                                 :style="'width:' + cardW + 'px;' + cardTransform(idx)">
                                <div class="relative rounded-[1.5rem] overflow-hidden h-full border border-slate-200 bg-white group hover:border-blue-400/50 shadow-[0_4px_20px_-5px_rgba(0,0,0,0.1)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.15)]"
                                     style="min-height:270px;">
                                    <!-- Accent bar -->
                                    <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-blue-500 to-sky-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <!-- Decorative subtle background element -->
                                    <div class="absolute -bottom-16 -right-16 w-40 h-40 rounded-full blur-[60px] opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-blue-100 pointer-events-none"></div>

                                    <div class="relative z-10 p-6 flex flex-col h-full">
                                        <!-- Date + Time -->
                                        <div class="flex items-center gap-4 mb-5">
                                            <div class="w-[64px] h-[72px] rounded-xl flex flex-col items-center justify-center flex-shrink-0 border border-slate-200 bg-slate-50 group-hover:border-blue-200 group-hover:bg-blue-50/50 group-hover:shadow-inner transition-colors">
                                                <span class="text-[11px] uppercase font-black tracking-widest text-blue-600" x-text="item.month"></span>
                                                <span class="text-2xl font-black text-slate-800 leading-none mt-1" x-text="item.day"></span>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-1.5 mb-2">
                                                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                    <span class="text-sm text-slate-600 font-bold tracking-wide" x-text="item.time"></span>
                                                </div>
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold border uppercase tracking-wider bg-blue-50 text-blue-600 border-blue-200 shadow-sm">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                                    Terjadwal
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Title -->
                                        <h3 class="text-lg font-bold text-slate-800 mb-2 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors" x-text="item.title"></h3>

                                        <!-- Description -->
                                        <p class="text-slate-500 text-sm leading-relaxed mb-4 line-clamp-3 w-full max-w-none flex-1" x-text="item.description"></p>

                                        <!-- Location -->
                                        <div class="flex items-center gap-2 text-slate-600 text-sm pt-4 border-t border-slate-100 mt-auto">
                                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                            </div>
                                            <span class="font-medium truncate" x-text="item.location"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Empty State -->
                    <div x-show="filtered.length === 0" x-cloak class="py-16 text-center">
                        <svg class="w-16 h-16 text-instansi-text-muted/20 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        <p class="text-instansi-text-muted/40 text-lg font-medium">Tidak ada agenda yang cocok</p>
                        <p class="text-instansi-text-muted/25 text-sm mt-1">Coba gunakan kata kunci lain</p>
                    </div>
                </div>

                    <!-- Dots -->
                    <div class="flex items-center justify-center mt-6 gap-1.5" x-show="totalDots > 1">
                        <template x-for="d in totalDots" :key="d">
                            <button @click="goTo(d - 1)"
                                    class="rounded-full border-0 transition-all duration-300 cursor-pointer"
                                    :class="position === d - 1 ? 'w-7 h-2 bg-instansi-action shadow-lg shadow-sky-500/30' : 'w-2 h-2 bg-white/20 hover:bg-white/40'">
                            </button>
                        </template>
                    </div>

                </div> <!-- /Carousel Wrapper -->
            </div>

            <!-- Agenda Data (injected from PHP) -->
            @php
                $agendaJson = collect($agendaItems)->map(function($item, $i) {
                    $parts = explode(' ', $item['date']);
                    return [
                        '_i' => $i,
                        '_ci' => $i % 3,
                        'title' => $item['title'],
                        'description' => $item['description'],
                        'date' => $item['date'],
                        'time' => $item['time'],
                        'location' => $item['location'],
                        'day' => $parts[0] ?? '',
                        'month' => strtoupper(substr($parts[1] ?? '', 0, 3)),
                    ];
                })->values()->toArray();
            @endphp
            <script>window.__agendaItems = @json($agendaJson);</script>
        </section>
