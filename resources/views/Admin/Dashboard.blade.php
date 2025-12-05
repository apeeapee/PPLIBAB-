@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold" style="color:var(--text-main)">Dashboard Admin</h1>
                <p class="text-sm sm:text-base" style="color:var(--text-muted)">Kelola pengajuan toko dan pantau aktivitas marketplace</p>
            </div>
            <div class="text-center sm:text-right px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white" style="background:linear-gradient(135deg, var(--accent), #ea580c)">
                <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
                <div class="text-2xl sm:text-3xl font-bold">{{ $total }}</div>
                <div class="text-xs sm:text-sm opacity-90">Total Pengajuan</div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Quick Actions -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <a href="{{ route('admin.sellers.index') }}" class="action-card card p-4 sm:p-6" style="transition:all 0.3s cubic-bezier(0.4,0,0.2,1);cursor:pointer;position:relative;overflow:hidden">
                <div class="action-card-glow" style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(249,115,22,0.1),transparent);opacity:0;transition:opacity 0.3s"></div>
                <div style="display:flex;align-items:center;gap:16px;position:relative;z-index:1">
                    <div class="stat-icon orange" style="width:56px;height:56px;font-size:24px;transition:transform 0.3s"><i class="uil uil-folder-open"></i></div>
                    <div>
                        <h3 class="font-bold text-base sm:text-lg mb-1" style="color:var(--text-main)">Pengajuan Toko</h3>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Kelola pengajuan pembukaan toko</p>
                    </div>
                    <i class="uil uil-arrow-right" style="margin-left:auto;font-size:20px;color:var(--text-muted);transition:all 0.3s;opacity:0;transform:translateX(-10px)"></i>
                </div>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="action-card card p-4 sm:p-6" style="transition:all 0.3s cubic-bezier(0.4,0,0.2,1);cursor:pointer;position:relative;overflow:hidden">
                <div class="action-card-glow" style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(59,130,246,0.1),transparent);opacity:0;transition:opacity 0.3s"></div>
                <div style="display:flex;align-items:center;gap:16px;position:relative;z-index:1">
                    <div class="stat-icon blue" style="width:56px;height:56px;font-size:24px;transition:transform 0.3s"><i class="uil uil-chart-bar"></i></div>
                    <div>
                        <h3 class="font-bold text-base sm:text-lg mb-1" style="color:var(--text-main)">Laporan</h3>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Lihat laporan dan statistik</p>
                    </div>
                    <i class="uil uil-arrow-right" style="margin-left:auto;font-size:20px;color:var(--text-muted);transition:all 0.3s;opacity:0;transform:translateX(-10px)"></i>
                </div>
            </a>
            <a href="{{ route('products.index') }}" class="action-card card p-4 sm:p-6" style="transition:all 0.3s cubic-bezier(0.4,0,0.2,1);cursor:pointer;position:relative;overflow:hidden">
                <div class="action-card-glow" style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(34,197,94,0.1),transparent);opacity:0;transition:opacity 0.3s"></div>
                <div style="display:flex;align-items:center;gap:16px;position:relative;z-index:1">
                    <div class="stat-icon green" style="width:56px;height:56px;font-size:24px;transition:transform 0.3s"><i class="uil uil-shopping-cart"></i></div>
                    <div>
                        <h3 class="font-bold text-base sm:text-lg mb-1" style="color:var(--text-main)">Marketplace</h3>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Lihat produk di marketplace</p>
                    </div>
                    <i class="uil uil-arrow-right" style="margin-left:auto;font-size:20px;color:var(--text-muted);transition:all 0.3s;opacity:0;transform:translateX(-10px)"></i>
                </div>
            </a>
        </div>
    </div>

    <style>
        .action-card:hover{transform:translateY(-8px) scale(1.02);box-shadow:0 20px 40px rgba(0,0,0,0.3)!important;border-color:var(--accent)!important}
        .action-card:hover .action-card-glow{opacity:1}
        .action-card:hover .stat-icon{transform:scale(1.1) rotate(5deg)}
        .action-card:hover .uil-arrow-right{opacity:1;transform:translateX(0);color:var(--accent)}
    </style>

    <div class="divider"></div>

    <!-- Stats Overview -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Statistik Pengajuan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="stat-card">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-semibold mb-1" style="color:var(--text-muted)">Pending</p>
                        <p class="stat-value" style="color:#eab308">{{ $pending }}</p>
                        <p class="text-xs mt-1" style="color:var(--text-muted)">{{ number_format($pPct, 1) }}% dari total</p>
                    </div>
                    <div class="stat-icon yellow"><i class="uil uil-clock"></i></div>
                </div>
                <div class="stat-bar"><div class="stat-bar-fill" style="width:{{ $pPct }}%;background:#eab308"></div></div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-semibold mb-1" style="color:var(--text-muted)">Disetujui</p>
                        <p class="stat-value" style="color:#22c55e">{{ $approved }}</p>
                        <p class="text-xs mt-1" style="color:var(--text-muted)">{{ number_format($aPct, 1) }}% dari total</p>
                    </div>
                    <div class="stat-icon green"><i class="uil uil-check-circle"></i></div>
                </div>
                <div class="stat-bar"><div class="stat-bar-fill" style="width:{{ $aPct }}%;background:#22c55e"></div></div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-semibold mb-1" style="color:var(--text-muted)">Ditolak</p>
                        <p class="stat-value" style="color:#ef4444">{{ $rejected }}</p>
                        <p class="text-xs mt-1" style="color:var(--text-muted)">{{ number_format($rPct, 1) }}% dari total</p>
                    </div>
                    <div class="stat-icon red"><i class="uil uil-times-circle"></i></div>
                </div>
                <div class="stat-bar"><div class="stat-bar-fill" style="width:{{ $rPct }}%;background:#ef4444"></div></div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Charts Row 1 -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Statistik Pengguna</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Seller Statistics -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Statistik Penjual</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Jumlah penjual aktif dan tidak aktif</p>
                    </div>
                    <div class="stat-icon purple" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-users-alt"></i></div>
                </div>
                <div class="chart-area mb-4">
                    <div class="flex justify-center items-end gap-8 sm:gap-12" style="height:180px">
                        <div class="flex flex-col items-center">
                            <div class="text-base sm:text-lg font-bold mb-2" style="color:var(--text-main)">{{ $approved }}</div>
                            <div style="width:70px;background:linear-gradient(to top, #22c55e, #4ade80);border-radius:8px 8px 0 0;height:{{ max(40, ($total > 0 ? ($approved / $total) * 100 : 0) * 1.5) }}px"></div>
                            <div class="text-xs sm:text-sm mt-3 font-semibold" style="color:var(--text-muted)">Aktif</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="text-base sm:text-lg font-bold mb-2" style="color:var(--text-main)">{{ $pending + $rejected }}</div>
                            <div style="width:70px;background:linear-gradient(to top, #ef4444, #f87171);border-radius:8px 8px 0 0;height:{{ max(40, ($total > 0 ? (($pending + $rejected) / $total) * 100 : 0) * 1.5) }}px"></div>
                            <div class="text-xs sm:text-sm mt-3 font-semibold" style="color:var(--text-muted)">Tidak Aktif</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Statistics -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Statistik Review</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Jumlah reviewer dan ulasan produk</p>
                    </div>
                    <div class="stat-icon blue" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-star"></i></div>
                </div>
                <div class="chart-area mb-4">
                    <div class="flex justify-center items-end gap-8 sm:gap-12" style="height:180px">
                        <div class="flex flex-col items-center">
                            <div class="text-base sm:text-lg font-bold mb-2" style="color:var(--text-main)">{{ $totalReviews }}</div>
                            <div style="width:70px;background:linear-gradient(to top, #3b82f6, #60a5fa);border-radius:8px 8px 0 0;height:{{ max(40, min(140, ($totalReviews / 10) * 1.5)) }}px"></div>
                            <div class="text-xs sm:text-sm mt-3 font-semibold" style="color:var(--text-muted)">Total Review</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="text-base sm:text-lg font-bold mb-2" style="color:var(--text-main)">{{ $uniqueReviewers }}</div>
                            <div style="width:70px;background:linear-gradient(to top, var(--accent), #fb923c);border-radius:8px 8px 0 0;height:{{ max(40, min(140, ($uniqueReviewers / 10) * 1.5)) }}px"></div>
                            <div class="text-xs sm:text-sm mt-3 font-semibold" style="color:var(--text-muted)">Reviewer</div>
                        </div>
                    </div>
                </div>
                <div style="border-top:1px solid var(--card-border);padding-top:16px">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="chart-area p-3 text-center">
                            <div class="text-xs" style="color:var(--text-muted)">User Terdaftar</div>
                            <div class="text-lg sm:text-xl font-bold" style="color:var(--text-main)">{{ $userReviewers }}</div>
                        </div>
                        <div class="chart-area p-3 text-center">
                            <div class="text-xs" style="color:var(--text-muted)">Guest Reviewer</div>
                            <div class="text-lg sm:text-xl font-bold" style="color:var(--text-main)">{{ $guestReviewers }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Charts Row 2 -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Distribusi Data</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Products by Category -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Produk per Kategori</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Distribusi produk berdasarkan kategori</p>
                    </div>
                    <div class="stat-icon indigo" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-apps"></i></div>
                </div>
                @if($productsByCategory->count() > 0)
                    @php $maxCat = $productsByCategory->max('total'); @endphp
                    <div class="chart-area">
                        <div class="flex justify-start items-end gap-2 sm:gap-3 overflow-x-auto pb-2" style="height:180px">
                            @foreach($productsByCategory->take(8) as $cat)
                                <div class="flex flex-col items-center flex-shrink-0">
                                    <div class="text-xs sm:text-sm font-bold mb-2" style="color:var(--text-main)">{{ $cat['total'] }}</div>
                                    <div style="width:50px;background:linear-gradient(to top, #6366f1, #818cf8);border-radius:8px 8px 0 0;height:{{ max(30, ($cat['total'] / $maxCat) * 120) }}px"></div>
                                    <div class="text-xs mt-3 font-semibold truncate" style="color:var(--text-muted);width:50px;text-align:center">{{ Str::limit($cat['category'], 6) }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="chart-area text-center" style="padding:48px 20px">
                        <i class="uil uil-package text-4xl sm:text-5xl mb-3" style="color:var(--text-muted);opacity:0.5"></i>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Belum ada data produk</p>
                    </div>
                @endif
            </div>

            <!-- Sellers by Province -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Toko per Provinsi</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Distribusi toko berdasarkan lokasi</p>
                    </div>
                    <div class="stat-icon pink" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-map-marker"></i></div>
                </div>
                @if($sellersByProvince->count() > 0)
                    @php $maxProv = $sellersByProvince->max('total'); @endphp
                    <div class="chart-area mb-4">
                        <div class="flex justify-start items-end gap-2 sm:gap-3 overflow-x-auto pb-2" style="height:180px">
                            @foreach($sellersByProvince->take(8) as $prov)
                                <div class="flex flex-col items-center flex-shrink-0">
                                    <div class="text-xs sm:text-sm font-bold mb-2" style="color:var(--text-main)">{{ $prov->total }}</div>
                                    <div style="width:50px;background:linear-gradient(to top, #ec4899, #f472b6);border-radius:8px 8px 0 0;height:{{ max(30, ($prov->total / $maxProv) * 120) }}px"></div>
                                    <div class="text-xs mt-3 font-semibold truncate" style="color:var(--text-muted);width:50px;text-align:center">{{ Str::limit($prov->provinsi, 6) }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div style="border-top:1px solid var(--card-border);padding-top:16px">
                        <div class="grid grid-cols-2 gap-2 sm:gap-3">
                            @foreach($sellersByProvince->take(4) as $prov)
                                <div class="chart-area p-2 sm:p-3">
                                    <div class="text-xs truncate mb-1" style="color:var(--text-muted)">{{ Str::limit($prov->provinsi, 15) }}</div>
                                    <div class="text-sm sm:text-lg font-bold" style="color:var(--text-main)">{{ $prov->total }} <span class="text-xs font-normal" style="color:var(--text-muted)">toko</span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="chart-area text-center" style="padding:48px 20px">
                        <i class="uil uil-map-marker text-4xl sm:text-5xl mb-3" style="color:var(--text-muted);opacity:0.5"></i>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Belum ada data toko</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Rating Analytics -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Analisis Rating & Review</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Rating Distribution -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Sebaran Nilai Rating</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Distribusi rating 1-5 bintang</p>
                    </div>
                    <div class="stat-icon yellow" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-star"></i></div>
                </div>
                <div style="display:flex;flex-direction:column;gap:12px">
                    @for($star = 5; $star >= 1; $star--)
                        @php
                            $rd = $ratingDistribution->firstWhere('rating', $star);
                            $cnt = $rd ? $rd['total'] : 0;
                            $pct = $totalReviews > 0 ? (($cnt / $totalReviews) * 100) : 0;
                        @endphp
                        <div style="display:flex;align-items:center;gap:12px">
                            <div style="display:flex;align-items:center;gap:4px;width:60px">
                                <span class="text-sm font-semibold" style="color:var(--text-main)">{{ $star }}</span>
                                <i class="uil uil-star text-sm" style="color:#eab308"></i>
                            </div>
                            <div style="flex:1;height:24px;background:rgba(148,163,184,0.15);border-radius:12px;overflow:hidden">
                                <div style="height:100%;background:linear-gradient(90deg,#eab308,#fbbf24);border-radius:12px;display:flex;align-items:center;padding:0 8px;width:{{ $pct }}%">
                                    @if($cnt > 0)
                                        <span class="text-xs font-semibold" style="color:white">{{ $cnt }}</span>
                                    @endif
                                </div>
                            </div>
                            <div style="width:50px;text-align:right">
                                <span class="text-sm font-semibold" style="color:var(--text-main)">{{ number_format($pct, 1) }}%</span>
                            </div>
                        </div>
                    @endfor
                </div>
                <div style="margin-top:16px;padding-top:16px;border-top:1px solid var(--card-border);display:flex;justify-content:space-between;align-items:center">
                    <span class="text-sm" style="color:var(--text-muted)">Total Review</span>
                    <span class="text-lg font-bold" style="color:var(--text-main)">{{ $totalReviews }}</span>
                </div>
            </div>

            <!-- Rating by Province -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Review Berdasarkan Provinsi</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Sebaran pemberi rating per lokasi</p>
                    </div>
                    <div class="stat-icon blue" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-map-marker"></i></div>
                </div>
                <div style="display:flex;flex-direction:column;gap:12px;max-height:320px;overflow-y:auto">
                    @forelse($ratingsByProvince as $idx => $item)
                        @php
                            $maxRev = $ratingsByProvince->max('total');
                            $pctRev = $maxRev > 0 ? ($item['total'] / $maxRev) * 100 : 0;
                            $clrs = ['#3b82f6', '#22c55e', '#8b5cf6', '#ec4899', '#6366f1'];
                            $clr = $clrs[$idx % 5];
                        @endphp
                        <div style="display:flex;align-items:center;gap:12px">
                            <div style="width:100px;flex-shrink:0">
                                <div class="text-sm font-semibold truncate" style="color:var(--text-main)">{{ $item['province'] }}</div>
                                <div class="text-xs" style="color:var(--text-muted)"><i class="uil uil-star" style="color:#eab308"></i> {{ $item['avg_rating'] }}</div>
                            </div>
                            <div style="flex:1;height:24px;background:rgba(148,163,184,0.15);border-radius:12px;overflow:hidden">
                                <div style="height:100%;background:{{ $clr }};border-radius:12px;display:flex;align-items:center;padding:0 8px;width:{{ $pctRev }}%">
                                    <span class="text-xs font-semibold" style="color:white">{{ $item['total'] }} review</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center" style="padding:32px">
                            <i class="uil uil-map-marker text-4xl mb-2" style="color:var(--text-muted);opacity:0.5"></i>
                            <p class="text-sm" style="color:var(--text-muted)">Belum ada data review</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Top Rated Products -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Produk Rating Tertinggi</h2>
        <div class="card overflow-hidden">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width:60px">Rank</th>
                            <th>Produk</th>
                            <th style="width:100px">Rating</th>
                            <th style="width:100px">Review</th>
                            <th style="width:140px;text-align:right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topRatedProducts as $i => $prod)
                            @php
                                $bgClr = '#cbd5e1';
                                if($i == 0) $bgClr = '#eab308';
                                elseif($i == 1) $bgClr = '#94a3b8';
                                elseif($i == 2) $bgClr = '#ea580c';
                            @endphp
                            <tr>
                                <td>
                                    <div style="width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;color:white;background:{{ $bgClr }}">{{ $i + 1 }}</div>
                                </td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" style="width:48px;height:48px;border-radius:8px;object-fit:cover">
                                        <div>
                                            <div class="font-semibold" style="color:var(--text-main)">{{ Str::limit($prod->name, 50) }}</div>
                                            <div class="text-xs" style="color:var(--text-muted)">{{ $prod->seller_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:4px">
                                        <i class="uil uil-star" style="color:#eab308"></i>
                                        <span class="font-bold" style="color:var(--text-main)">{{ number_format($prod->avg_rating, 1) }}</span>
                                    </div>
                                </td>
                                <td style="color:var(--text-muted)">{{ $prod->review_count }} review</td>
                                <td style="text-align:right;font-weight:600;color:var(--accent)">Rp {{ number_format($prod->price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center" style="padding:32px">
                                    <i class="uil uil-star text-4xl mb-2" style="color:var(--text-muted);opacity:0.5"></i>
                                    <p class="text-sm" style="color:var(--text-muted)">Belum ada produk dengan rating</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
