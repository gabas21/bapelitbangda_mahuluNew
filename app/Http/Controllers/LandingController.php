<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Dummy Data for News Standard (SOP)
        $pengumumanItems = [
            [
                'image' => asset('images/slider.webp'),
                'category' => 'Pemerintahan',
                'title' => 'Pengumuman 1',
                'date' => '12 Februari 2026',
                'views' => 450
            ],
            [
                'image' => asset('images/1771387787.webp'),
                'category' => 'Pendidikan',
                'title' => 'Pengumuman 2',
                'date' => '10 Februari 2026',
                'views' => 320
            ],
            [
                'image' => asset('images/1771308097.webp'),
                'category' => 'Infrastruktur',
                'title' => 'Pengumuman 3',
                'date' => '08 Februari 2026',
                'views' => 560
            ],
        ];

        // Dummy Data for Popular News (SOP)
        $popularNewsItems = [
            [
                'category' => 'Pengumuman',
                'title' => 'Jadwal Musrenbang Kecamatan Tahun 2026',
                'date' => '05 Februari 2026',
                'views' => 1205
            ],
            [
                'category' => 'Layanan',
                'title' => 'Cara Pengajuan Proposal Penelitian di Bappelitbangda',
                'date' => '01 Februari 2026',
                'views' => 980
            ],
            [
                'category' => 'Berita',
                'title' => 'Kunjungan Kerja Bupati Mahakam Ulu ke Bappenas RI',
                'date' => '28 Januari 2026',
                'views' => 875
            ],
            [
                'category' => 'Inovasi',
                'title' => 'Mahakam Ulu Raih Penghargaan Inovasi Daerah Terbaik se-Kaltim',
                'date' => '20 Januari 2026',
                'views' => 750
            ]
        ];

        // Real Data for External Links
        $allLinks = [
            [
                'name' => 'SIPD Kemendagri',
                'desc' => 'Sistem Informasi Pemerintahan Daerah',
                'logo' => asset('images/sippd.webp'),
                'link' => 'https://sipd.go.id'
            ],
            [
                'name' => 'SP4N LAPOR!',
                'desc' => 'Layanan Aspirasi dan Pengaduan Online Rakyat',
                'logo' => asset('images/lapor.webp'),
                'link' => 'https://www.lapor.go.id/'
            ],
            [
                'name' => 'SRIKANDI',
                'desc' => 'Sistem Informasi Kearsipan Dinamis',
                'logo' => asset('images/logo_srikandi.webp'),
                'link' => 'https://srikandi.arsip.go.id'
            ],
             [
                'name' => 'E-Catalogue',
                'desc' => 'Layanan Pengadaan Secara Elektronik',
                'logo' => asset('images/logo_e_catalogue.webp'),
                'link' => 'https://e-katalog.lkpp.go.id'
            ],
            [
                'name' => 'LPSE Mahakam Ulu',
                'desc' => 'Layanan Pengadaan Secara Elektronik',
                'logo' => asset('images/lpse.webp'),
                'link' => 'https://lpse.mahakamulukab.go.id/eproc4'
            ],
             [
                'name' => 'SiRUP',
                'desc' => 'Sistem Informasi Rencana Umum Pengadaan',
                'logo' => asset('images/sirup.webp'),
                'link' => 'https://sirup.lkpp.go.id'
            ],
        ];

        $agendaItems = config('landing.agenda', []);

        return view('landing', compact('pengumumanItems', 'popularNewsItems', 'allLinks', 'agendaItems'));
    }
}
