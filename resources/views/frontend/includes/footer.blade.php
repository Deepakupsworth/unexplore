<div class="footer-top-image">
  <img src="frontend/assets/footer-top.png" alt="Footer">
</div>
<footer class="bg-white">
  <div class="footer-top">
    <div class="container">
      <div class="row align-items-start">
        <!-- Logo -->
        <div class="col-md-12 col-lg-2 mb-4">
          <img src="frontend/assets/logo.png" alt="Unxplord Saudi" class="footer__logo">
        </div>
        <!-- Links columns -->
        <div class="col-md-12 col-lg-7">
          <div class="row footer-links-section">
            <div class="col-md-4 mb-4">
              <p class="footer-link-heading p-large">Popular Links</p>
              <ul class="list-unstyled">
                <li><a href="#" class="footer-link">Explore Saudi</a></li>
                <li><a href="#" class="footer-link">Things to do</a></li>
                <li><a href="#" class="footer-link">Plan Your Trip</a></li>
                <li><a href="#" class="footer-link">Events & Festivals</a></li>
                <li><a href="#" class="footer-link">Saudi Calendar</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-4">
              <p class="footer-link-heading p-large">Information</p>
              <ul class="list-unstyled">
                <li><a href="#" class="footer-link">Terms & conditions</a></li>
                <li><a href="#" class="footer-link">Privacy Policy</a></li>
                <li><a href="#" class="footer-link">FAQs</a></li>
                <li><a href="#" class="footer-link">News and Events</a></li>
                <li><a href="#" class="footer-link">Cookie Policy</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-4">
              <p class="footer-link-heading p-large">Our company</p>
              <ul class="list-unstyled">
                <li><a href="{{ asset('/about-us') }}" class="footer-link">About us</a></li>
                <li><a href="{{ asset('/contact-us') }}" class="footer-link">Contact Us</a></li>
                <li><a href="#" class="footer-link">Sitemap</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Social & Newsletter -->
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="footer-icons-section">
            <a href="#" class="footer-icon">
              <img src="frontend/assets/icons/instagram.svg" alt="instagram">
            </a>
            <a href="#" class="footer-icon">
              <img src="frontend/assets/icons/facebook.svg" alt="facebook">
            </a>
            <a href="#" class="footer-icon">
              <img src="frontend/assets/icons/x.svg" alt="x">
            </a>
          </div>
          <div class="footer-newsletter-section">
            <p class="mb-2 heading p-large">Subscribe to our newsletter</p>
            <form class="d-flex flex-column">
              <div class="custom-input-group mb-2">
                <span class="input-text" id="newsletter-email">
                  <i class="fa-solid fa-envelope"></i>
                </span>
                <input type="email" class="form-control rounded-pill" placeholder="Your email" aria-describedby="newsletter-email">
              </div>
              <button type="submit" class="btn btn-primary justify-content-center rounded-pill">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Copyright bar -->
  <div class="footer-bottom bg-dark text-white text-center">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-sm-2">
      <span>Copyrights &copy;2025 All rights reserved. Unxplord Saudi</span>
      <span>
        <a href="#" class="footer-link text-white mx-2">Terms and Conditions</a>
        &bull;
        <a href="#" class="footer-link text-white mx-2">Privacy Policy</a>
        &bull;
        <a href="#" class="footer-link text-white mx-2">Cookie notice</a>
        &bull;
        <a href="#" class="footer-link text-white mx-2">Sitemap</a>
      </span>
    </div>
  </div>
</footer>