@php
    $footerSettings = \App\Models\SiteSetting::getSettings();
@endphp
<footer id="footer" class="footer dark-background">
    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>{{ $footerSettings->footer_address ?? 'A108 Adam Street, New York, NY 535022' }}</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>{{ $footerSettings->footer_phone ?? '+1 5589 55488 55' }}</span><br>
              <strong>Email:</strong> <span>{{ $footerSettings->footer_email ?? 'info@example.com' }}</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>{{ $footerSettings->footer_timing ?? 'Mon-Sat: 11AM - 23PM' }}</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            @if($footerSettings->twitter_url)
            <a href="{{ $footerSettings->twitter_url }}" class="twitter" target="_blank"><i class="bi bi-twitter-x"></i></a>
            @endif
            @if($footerSettings->facebook_url)
            <a href="{{ $footerSettings->facebook_url }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
            @endif
            @if($footerSettings->instagram_url)
            <a href="{{ $footerSettings->instagram_url }}" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
            @endif
            @if($footerSettings->youtube_url)
            <a href="{{ $footerSettings->youtube_url }}" class="youtube" target="_blank"><i class="bi bi-youtube"></i></a>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>{{ $footerSettings->copyright_text ?? '© Copyright Yummy All Rights Reserved' }}</p>
      
    </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
