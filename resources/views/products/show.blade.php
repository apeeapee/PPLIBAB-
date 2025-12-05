@php
    $title = $product->name . ' | kampuStore';
@endphp
@extends('layouts.app')

@section('content')
<style>
  .product-container {
    background: var(--card-bg);
    border-radius: 24px;
    padding: 40px;
    border: 1px solid var(--card-border);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    margin-bottom: 40px;
  }
  
  .product-image {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
    aspect-ratio: 1;
    object-fit: cover;
  }

  .image-slider {
    position: relative;
    width: 100%;
  }

  .slider-main {
    position: relative;
    width: 100%;
    aspect-ratio: 1;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
  }

  .slider-main img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 0.3s ease;
  }

  .slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background: rgba(0, 0, 0, 0.6);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 10;
  }

  .slider-nav:hover {
    background: #f97316;
    transform: translateY(-50%) scale(1.1);
  }

  .slider-nav.prev { left: 10px; }
  .slider-nav.next { right: 10px; }

  .slider-thumbnails {
    display: flex;
    gap: 10px;
    margin-top: 16px;
    overflow-x: auto;
    padding-bottom: 8px;
  }

  .slider-thumbnails::-webkit-scrollbar {
    height: 6px;
  }

  .slider-thumbnails::-webkit-scrollbar-track {
    background: var(--card-border);
    border-radius: 3px;
  }

  .slider-thumbnails::-webkit-scrollbar-thumb {
    background: #f97316;
    border-radius: 3px;
  }

  .slider-thumb {
    flex-shrink: 0;
    width: 70px;
    height: 70px;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid var(--card-border);
    transition: all 0.3s;
    opacity: 0.6;
  }

  .slider-thumb.active {
    border-color: #f97316;
    opacity: 1;
    box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
  }

  .slider-thumb:hover {
    opacity: 1;
    border-color: #fb923c;
  }

  .slider-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .slider-counter {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
  }
  
  .badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
  }
  
  .badge-success {
    background: rgba(34,197,94,0.15);
    color: #22c55e;
    border: 1px solid rgba(34,197,94,0.3);
  }
  
  .badge-warning {
    background: rgba(245,158,11,0.15);
    color: #f59e0b;
    border: 1px solid rgba(245,158,11,0.3);
  }
  
  .rating-stars {
    display: flex;
    align-items: center;
    gap: 4px;
  }
  
  .star {
    color: #fbbf24;
    font-size: 20px;
  }
  
  .star.empty {
    color: #4b5563;
  }
  
  .price-tag {
    font-size: 36px;
    font-weight: 800;
    color: #f97316;
  }
  
  .btn-primary {
    background: #f97316;
    color: #111827;
    padding: 14px 32px;
    border-radius: 50px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 14px rgba(249,115,22,0.4);
  }
  
  .btn-primary:hover {
    background: #fb923c;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(249,115,22,0.5);
  }
  
  .review-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 16px;
    border: 1px solid var(--card-border);
    transition: all 0.3s;
  }
  
  .review-card:hover {
    border-color: #f97316;
    box-shadow: 0 4px 12px rgba(249,115,22,0.15);
  }
  
  .form-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    border: 1px solid var(--card-border);
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: var(--page-title-color);
    margin-bottom: 8px;
  }
  
  .form-input, .form-textarea, .form-select {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--card-border);
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.3s;
    font-family: inherit;
    background: var(--card-bg);
    color: var(--text-main);
  }
  
  .form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: #f97316;
    box-shadow: 0 0 0 2px rgba(249,115,22,0.2);
  }
  
  .error-text {
    color: #ef4444;
    font-size: 13px;
    margin-top: 6px;
  }
  
  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 24px 0;
  }
  
  .info-item {
    background: rgba(249,115,22,0.05);
    padding: 16px;
    border-radius: 12px;
    border: 1px solid rgba(249,115,22,0.2);
  }
  
  .info-label {
    font-size: 12px;
    color: var(--section-text);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    margin-bottom: 6px;
  }
  
  .info-value {
    font-size: 16px;
    color: var(--page-title-color);
    font-weight: 600;
  }

  .product-title {
    font-size: 32px;
    font-weight: 800;
    color: var(--page-title-color);
    margin-bottom: 16px;
    line-height: 1.2;
  }

  .product-text {
    color: var(--section-text);
  }

  .section-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--page-title-color);
    margin-bottom: 12px;
  }

  .seller-box {
    background: rgba(249,115,22,0.05);
    padding: 16px;
    border-radius: 12px;
    border: 1px solid rgba(249,115,22,0.2);
  }

  .reviews-title {
    font-size: 24px;
    font-weight: 800;
    color: var(--page-title-color);
    margin-bottom: 24px;
  }

  .review-author {
    font-weight: 700;
    color: var(--page-title-color);
    margin-bottom: 4px;
  }

  .review-time {
    font-size: 12px;
    color: var(--section-text);
  }

  .review-body {
    color: var(--section-text);
    line-height: 1.6;
    white-space: pre-wrap;
  }

  .empty-reviews {
    text-align: center;
    padding: 60px 20px;
    background: var(--card-bg);
    border-radius: 16px;
    border: 2px dashed var(--card-border);
  }

  .description-wrapper {
    position: relative;
  }

  .description-text {
    overflow: hidden;
    transition: max-height 0.3s ease;
  }

  .description-text.collapsed {
    max-height: 120px;
    -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
    mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
  }

  .description-text.expanded {
    max-height: none;
    -webkit-mask-image: none;
    mask-image: none;
  }

  .toggle-desc-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 12px;
    padding: 8px 16px;
    background: rgba(249,115,22,0.1);
    color: #f97316;
    border: 1px solid rgba(249,115,22,0.3);
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
  }

  .toggle-desc-btn:hover {
    background: rgba(249,115,22,0.2);
    border-color: #f97316;
  }

  .toggle-desc-btn i {
    font-size: 18px;
    transition: transform 0.3s;
  }

  .toggle-desc-btn.expanded i {
    transform: rotate(180deg);
  }
  
  @media (max-width: 768px) {
    .product-container {
      padding: 24px;
    }
    
    .price-tag {
      font-size: 28px;
    }
  }
</style>

<div class="product-container">
  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
    <!-- Product Image Slider -->
    <div>
      @if($showImages)
        @php
          $firstImgPath = $images->first()->image_path;
          $firstImgSrc = ($firstImgPath && str_starts_with($firstImgPath, '/images/')) ? asset($firstImgPath) : asset('storage/' . $firstImgPath);
        @endphp
        <div class="image-slider" id="imageSlider">
          <div class="slider-main">
            <img id="mainImage" src="{{ $firstImgSrc }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('images/no-image.png') }}';">
            @if($hasMultipleImages)
              <button class="slider-nav prev" onclick="changeSlide(-1)"><i class="uil uil-angle-left-b"></i></button>
              <button class="slider-nav next" onclick="changeSlide(1)"><i class="uil uil-angle-right-b"></i></button>
              <div class="slider-counter"><span id="currentSlide">1</span> / {{ $images->count() }}</div>
            @endif
          </div>
          @if($hasMultipleImages)
            <div class="slider-thumbnails">
              @foreach($images as $index => $image)
                @php
                  $thumbPath = $image->image_path;
                  $thumbSrc = ($thumbPath && str_starts_with($thumbPath, '/images/')) ? asset($thumbPath) : asset('storage/' . $thumbPath);
                @endphp
                <div class="slider-thumb {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})" data-index="{{ $index }}">
                  <img src="{{ $thumbSrc }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('images/no-image.png') }}';">
                </div>
              @endforeach
            </div>
          @endif
        </div>
        <script>
          const productImages = [
            @foreach($images as $image)
              @php
                $imgPath = $image->image_path;
                $imgSrc = ($imgPath && str_starts_with($imgPath, '/images/')) ? asset($imgPath) : asset('storage/' . $imgPath);
              @endphp
              "{{ $imgSrc }}",
            @endforeach
          ];
          let currentIndex = 0;

          function changeSlide(direction) {
            currentIndex += direction;
            if (currentIndex < 0) currentIndex = productImages.length - 1;
            if (currentIndex >= productImages.length) currentIndex = 0;
            updateSlider();
          }

          function goToSlide(index) {
            currentIndex = index;
            updateSlider();
          }

          function updateSlider() {
            document.getElementById('mainImage').src = productImages[currentIndex];
            document.getElementById('currentSlide').textContent = currentIndex + 1;
            
            document.querySelectorAll('.slider-thumb').forEach((thumb, idx) => {
              thumb.classList.toggle('active', idx === currentIndex);
            });
          }
        </script>
      @endif

      <script>
        function toggleDescription() {
          const text = document.getElementById('descriptionText');
          const btn = document.getElementById('toggleDescBtn');
          
          if (text.classList.contains('collapsed')) {
            text.classList.remove('collapsed');
            text.classList.add('expanded');
            btn.classList.add('expanded');
            btn.innerHTML = '<i class="uil uil-angle-up"></i> Lihat lebih sedikit';
          } else {
            text.classList.remove('expanded');
            text.classList.add('collapsed');
            btn.classList.remove('expanded');
            btn.innerHTML = '<i class="uil uil-angle-down"></i> Lihat lebih banyak';
          }
        }

        document.addEventListener('DOMContentLoaded', function() {
          const descText = document.getElementById('descriptionText');
          const toggleBtn = document.getElementById('toggleDescBtn');
          if (descText && toggleBtn) {
            if (descText.scrollHeight <= 120) {
              toggleBtn.style.display = 'none';
              descText.classList.remove('collapsed');
            }
          }
        });
      </script>

      @if($showFallback)
        @php
          $prodImgPath = $product->image_url;
          $prodImgSrc = ($prodImgPath && str_starts_with($prodImgPath, '/images/')) ? asset($prodImgPath) : asset('storage/' . $prodImgPath);
        @endphp
        <img src="{{ $prodImgSrc }}" alt="{{ $product->name }}" class="product-image" style="width: 100%;" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
        <div class="product-image" style="width: 100%; background: linear-gradient(135deg, #667eea 20%, #764ba2 100%); display: none; align-items: center; justify-content: center;">
          <i class="uil uil-image" style="font-size: 80px; color: rgba(255,255,255,0.5);"></i>
        </div>
      @endif

      @if($showPlaceholder)
        <div class="product-image" style="width: 100%; background: linear-gradient(135deg, #667eea 20%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
          <i class="uil uil-image" style="font-size: 80px; color: rgba(255,255,255,0.5);"></i>
        </div>
      @endif
      
      <!-- Additional Product Info -->
      <div class="info-grid" style="margin-top: 24px;">
        <div class="info-item">
          <div class="info-label">Kategori</div>
          <div class="info-value">{{ ucfirst(str_replace('-', ' ', $product->category_slug ?? 'Umum')) }}</div>
        </div>
        <div class="info-item">
          <div class="info-label">Kondisi</div>
          <div class="info-value">{{ ucfirst($product->condition ?? 'Baru') }}</div>
        </div>
      </div>
    </div>
    
    <!-- Product Details -->
    <div>
      <div style="margin-bottom: 16px;">
        @if($product->stock > 0)
          <span class="badge badge-success">
            <i class="uil uil-check-circle"></i>
            Tersedia
          </span>
        @else
          <span class="badge badge-warning">
            <i class="uil uil-exclamation-triangle"></i>
            Stok Habis
          </span>
        @endif
      </div>
      
      <h1 class="product-title">
        {{ $product->name }}
      </h1>
      
      <!-- Rating -->
      <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
        <div class="rating-stars">
          @for ($i=1; $i<=5; $i++)
            <span class="star {{ $i <= floor($avg) ? '' : 'empty' }}">★</span>
          @endfor
        </div>
        <span class="product-text" style="font-size: 14px; font-weight: 500;">
          {{ $avg }} dari 5 · {{ $count }} ulasan
        </span>
      </div>
      
      <!-- Price -->
      <div class="price-tag" style="margin-bottom: 8px;">
        Rp {{ number_format($product->price, 0, ',', '.') }}
      </div>
      
      <div class="product-text" style="font-size: 14px; margin-bottom: 28px;">
        <i class="uil uil-layers"></i>
        Stok: <strong style="color: var(--page-title-color);">{{ $product->stock }}</strong> unit
      </div>
      
      <hr style="border: none; height: 1px; background: var(--card-border); margin: 28px 0;">
      
      <!-- Description -->
      <div>
        <h3 class="section-title">
          <i class="uil uil-file-alt"></i> Deskripsi Produk
        </h3>
        <div class="description-wrapper">
          <p id="descriptionText" class="product-text description-text collapsed" style="line-height: 1.7; white-space: pre-wrap;">{{ $product->description }}</p>
          @if(strlen($product->description) > 300)
          <button type="button" id="toggleDescBtn" class="toggle-desc-btn" onclick="toggleDescription()">
            <i class="uil uil-angle-down"></i> Lihat lebih banyak
          </button>
          @endif
        </div>
      </div>
      
      <hr style="border: none; height: 1px; background: var(--card-border); margin: 28px 0;">
      
      <!-- Seller Info -->
      <div>
        <h3 class="section-title">
          <i class="uil uil-shop"></i> Informasi Penjual
        </h3>
        <div class="seller-box">
          <div style="font-weight: 600; color: var(--page-title-color); margin-bottom: 4px;">
            {{ $product->seller_name ?? $product->seller->nama_toko ?? 'Penjual' }}
          </div>
          @if($product->seller)
            <div class="product-text" style="font-size: 13px;">
              <i class="uil uil-map-marker"></i>
              {{ $product->seller->kota ?? 'Semarang' }}, {{ $product->seller->provinsi ?? 'Jawa Tengah' }}
            </div>
          @endif
        </div>
      </div>
      
      <div style="margin-top: 32px;">
        <a href="#review-form">
          <button class="btn-primary">
            <i class="uil uil-edit-alt"></i>
            Tulis Ulasan
          </button>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Reviews Section -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px; align-items: start;">
  <!-- Reviews List -->
  <div>
    <h2 class="reviews-title">
      <i class="uil uil-comment-alt-lines"></i>
      Ulasan Pembeli
    </h2>
    
    @forelse ($product->reviews as $r)
      <div class="review-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
          <div>
            <div class="review-author">
              <i class="uil uil-user-circle"></i>
              {{ $r->user ? $r->user->name : $r->guest_name }}
            </div>
            <div class="review-time">
              <i class="uil uil-clock"></i>
              {{ $r->created_at->diffForHumans() }}
            </div>
          </div>
          <div class="rating-stars">
            @for ($i=1; $i<=5; $i++)
              <span class="star {{ $i <= $r->rating ? '' : 'empty' }}">★</span>
            @endfor
          </div>
        </div>
        <p class="review-body">{{ $r->body }}</p>
      </div>
    @empty
      <div class="empty-reviews">
        <i class="uil uil-comment-alt-slash" style="font-size: 60px; color: #4b5563; margin-bottom: 16px;"></i>
        <p class="product-text" style="font-size: 15px;">Belum ada ulasan untuk produk ini</p>
        <p class="product-text" style="font-size: 13px; margin-top: 8px; opacity: 0.7;">Jadilah yang pertama memberikan ulasan!</p>
      </div>
    @endforelse
  </div>
  
  <!-- Review Form -->
  <div style="position: sticky; top: 120px;">
    @if($isSeller)
      <div class="form-card" style="background: rgba(245,158,11,0.1); border: 2px solid rgba(245,158,11,0.5);">
        <div style="text-align: center; padding: 20px;">
          <i class="uil uil-info-circle" style="font-size: 48px; color: #f59e0b; margin-bottom: 12px;"></i>
          <h3 style="font-size: 18px; font-weight: 700; color: #f59e0b; margin-bottom: 8px;">
            Ini Produk Anda
          </h3>
          <p class="product-text" style="font-size: 14px; line-height: 1.6;">
            Anda tidak dapat memberikan ulasan pada produk Anda sendiri. Hanya pembeli yang dapat memberikan ulasan.
          </p>
        </div>
      </div>
    @else
    <div id="review-form" class="form-card">
      <h3 class="section-title" style="font-size: 20px; margin-bottom: 20px;">
        <i class="uil uil-pen"></i>
        Tulis Ulasan
      </h3>
      
      <form method="POST" action="{{ route('reviews.store', $product) }}">
        @csrf
        
        @guest
        <div class="form-group">
          <label class="form-label">Nama Anda</label>
          <input type="text" name="guest_name" value="{{ old('guest_name') }}" class="form-input" placeholder="Masukkan nama Anda" required>
          @error('guest_name')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Nomor HP</label>
          <input type="text" name="guest_phone" value="{{ old('guest_phone') }}" class="form-input" placeholder="08xxxxxxxxxx" required>
          @error('guest_phone')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" name="guest_email" value="{{ old('guest_email') }}" class="form-input" placeholder="email@example.com" required>
          @error('guest_email')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Provinsi</label>
          <select name="guest_province" id="guest_province" class="form-select" required>
            <option value="">Pilih Provinsi...</option>
          </select>
          @error('guest_province')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        @endguest
        
        <div class="form-group">
          <label class="form-label">Rating</label>
          <select name="rating" class="form-select" required>
            <option value="">Pilih rating...</option>
            @for ($i=5; $i>=1; $i--)
              <option value="{{ $i }}">{{ $i }} - {{ str_repeat('★', $i) }}</option>
            @endfor
          </select>
          @error('rating')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Ulasan Anda</label>
          <textarea name="body" rows="5" class="form-textarea" placeholder="Bagikan pengalaman Anda dengan produk ini..." required>{{ old('body') }}</textarea>
          @error('body')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
          <i class="uil uil-message"></i>
          Kirim Ulasan
        </button>
      </form>
    </div>
    @endif
  </div>
</div>

<style>
  @media (max-width: 1024px) {
    .product-container > div {
      grid-template-columns: 1fr !important;
    }
    
    div[style*="grid-template-columns: 2fr 1fr"] {
      grid-template-columns: 1fr !important;
    }
    
    .form-card {
      position: static !important;
    }
  }
</style>

@guest
<script>
document.addEventListener('DOMContentLoaded', async function() {
    const provinsiSelect = document.getElementById('guest_province');
    if (!provinsiSelect) return;
    
    try {
        const response = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        const provinces = await response.json();
        
        provinces.forEach(prov => {
            const option = document.createElement('option');
            option.value = prov.name;
            option.textContent = prov.name;
            provinsiSelect.appendChild(option);
        });
        
        // Restore old value if exists
        const oldValue = "{{ old('guest_province') }}";
        if (oldValue) {
            provinsiSelect.value = oldValue;
        }
    } catch (error) {
        console.error('Gagal memuat data provinsi:', error);
        // Fallback: tambahkan beberapa provinsi manual
        const fallbackProvinces = [
            'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Jambi', 
            'Sumatera Selatan', 'Bengkulu', 'Lampung', 'Kepulauan Bangka Belitung',
            'Kepulauan Riau', 'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 
            'DI Yogyakarta', 'Jawa Timur', 'Banten', 'Bali', 'Nusa Tenggara Barat',
            'Nusa Tenggara Timur', 'Kalimantan Barat', 'Kalimantan Tengah',
            'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara',
            'Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan', 'Sulawesi Tenggara',
            'Gorontalo', 'Sulawesi Barat', 'Maluku', 'Maluku Utara', 'Papua Barat', 'Papua'
        ];
        fallbackProvinces.forEach(prov => {
            const option = document.createElement('option');
            option.value = prov;
            option.textContent = prov;
            provinsiSelect.appendChild(option);
        });
    }
});
</script>
@endguest
@endsection
