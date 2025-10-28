</main>


<footer class="border-top pt-5" style="color: var(--sc); position: relative; bottom: 0;">
  <div class="container">
    <div class="row gy-4 gy-lg-0 pb-3">

      <div class="col-12 col-sm-6 col-lg-3 footer-menu">
        <p class="fw-semibold mb-3 ">OGÓLNE</p>
        <?php
          wp_nav_menu([
            'theme_location' => 'footer',
            'menu_class'     => 'nav flex-column small gap-2',
            'container'      => false,
            'depth'          => 1,
            'fallback_cb'    => false,
          ]);
        ?>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 footer-menu">
        <p class="fw-semibold mb-3">PRODUKTY</p>
        <?php
          wp_nav_menu([
            'theme_location' => 'footer2',
            'menu_class'     => 'nav flex-column small gap-2',
            'container'      => false,
            'depth'          => 1,
            'fallback_cb'    => false,
          ]);
        ?>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 footer-menu">
        <p class="fw-semibold mb-3">POMOC</p>
        <?php
          wp_nav_menu([
            'theme_location' => 'footer3',
            'menu_class'     => 'nav flex-column small gap-2',
            'container'      => false,
            'depth'          => 1,
            'fallback_cb'    => false,
          ]);
        ?>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-end">
        <div class="mb-4">
          <img 
            src="<?php echo get_theme_mod('custom_logo') ? wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0] : get_template_directory_uri() . '/assets/img/logo.png'; ?>" 
            alt="EuroCert" 
            class="img-fluid" 
            style="max-height: 60px;"
          >
        </div>

        <p class="mb-2" style="color: var(--tc2);">
          Potrzebujesz pomocy<br> lub masz pytania?
        </p><br>

        <!-- kontener przycisków -->
        <div class="d-flex flex-column align-items-center align-items-sm-end">
          <a href="/kontakt" class="btn-shop btn-contact px-4 mb-3">KONTAKT →</a>
          <a href="tel:+48223905995" class="btn-number btn-shop px-4">+48 22 390 59 95</a>
        </div>
      </div>


    </div>

    <!-- NOWA SEKCJA -->
    <hr class="my-4">

    <div class="row align-items-center text-center text-lg-start pt-5" style="padding-bottom: 28px;">
      <div class="col-12 col-lg-6 mb-4 mb-lg-0">
        <p class="fw-semibold text-uppercase small mb-4" style="color: var(--sc);">
          KWALIFIKOWANY DOSTAWCA USŁUG ZAUFANIA
        </p>
        <div class="d-flex flex-column flex-lg-row gap-4 align-items-center align-items-lg-start">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/eidas.png" alt="eIDAS" style="max-height: 45px; object-fit: contain;">
          <div class="w-100">
        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start" style="gap: 14px; margin-bottom: 14px;">
          <span class="badge rounded-1 px-3 py-2 fw-normal btn-yellow" style="cursor: pointer; background-color: #FFCC00; color: #000;">QCert for ESig</span>
          <span class="badge rounded-1 px-3 py-2 fw-normal btn-yellow" style="cursor: pointer; background-color: #FFCC00; color: #000;">QCert for ESeal</span>
        </div>
        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start" style="gap: 14px;">
          <span class="badge rounded-1 px-3 py-2 fw-normal btn-yellow" style="cursor: pointer; background-color: #FFCC00; color: #000;">QTimeStamp</span>
          <span class="badge rounded-1 px-3 py-2 fw-normal btn-yellow" style="cursor: pointer; background-color: #FFCC00; color: #000;">QWAC</span>
        </div>
          </div>
        </div>
      </div>
<style>
  .btn-yellow:hover{
    filter: brightness(1.05);
  }
  .btn-yellow{
    transition: all 0.2s ease;
  }
</style>
      <div class="col-12 col-lg-6 text-lg-end">
        <p class="fw-semibold text-uppercase small mb-3" style="color: var(--sc);">
          USŁUGI ZAUFANIA ŚWIADCZONE ZGODNIE ZE STANDARDAMI NA<br> TERENIE CAŁEJ UNII EUROPEJSKIEJ
        </p>
        <div class="d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center gap-4">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/mc.png" alt="Ministerstwo Cyfryzacji" style="max-height: 50px; object-fit: contain;">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/nccert.png" alt="NCCert" style="max-height: 50px; object-fit: contain;">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img.svg" alt="error img" style="max-height: 50px; object-fit: contain;">
        </div>
      </div>
    </div>

    <hr class="my-4">

    <!-- SOCIAL MEDIA + OPINIE -->
    <div class="d-flex flex-column text-center gap-3 py-4">
      <div class="d-flex gap-4 align-items-center fs-5 flex-column flex-lg-row justify-content-center justify-content-lg-start">
      <div class="d-flex gap-3 flex-row flex-lg-row justify-content-center">
       

        
        <a href="#" class="d-flex align-items-center justify-content-center border border-2 rounded-circle text-decoration-none"
          style="width: 48px; height: 48px; color: #002855; transition: all 0.3s;">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
          </svg>
        </a>

        <a href="#" class="d-flex align-items-center justify-content-center border border-2 rounded-circle text-decoration-none"
          style="width: 48px; height: 48px; border-color: #002855; color: #002855; transition: all 0.3s;">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
            <rect width="4" height="12" x="2" y="9"></rect>
            <circle cx="4" cy="4" r="2"></circle>
          </svg>
        </a>

        <a href="#" class="d-flex align-items-center justify-content-center border border-2 rounded-circle text-decoration-none"
          style="width: 48px; height: 48px; border-color: #002855; color: #002855; transition: all 0.3s;">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"></path>
            <path d="m10 15 5-3-5-3z"></path>
          </svg>
        </a>

        <a href="#" class="d-flex align-items-center justify-content-center border border-2 rounded-circle text-decoration-none"
          style="width: 48px; height: 48px; border-color: #002855; color: #002855; transition: all 0.3s;">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
          </svg>
        </a>
      </div>

      <style>
        .border{
          border-color: var(--sc) !important;
        }
        .border:hover {
          border-color: #007bff !important;
          color: #007bff !important;
        }
        svg {
          transition: color 0.3s ease;
        }
        a:hover svg {
          stroke: #007bff;
        }
        @media (max-width: 575.98px) {
          .rating-google {
            transform: scale(0.7);
            margin-left: -35px !important;
          }
        }
      </style>

<div class="d-flex align-items-center flex-wrap ">
  <!-- Logo Google -->
  <div class="rating-google d-flex">
    <div class="d-flex align-items-center me-2 ">
      <svg width="22" height="22" viewBox="0 0 24 24" class="me-2">
        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"></path>
        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"></path>
        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"></path>
        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"></path>
      </svg>
    </div>

    <!-- Ocena -->
    <span id="rating-number" class="me-2 fw-semibold" style="color: #ff8c00;">4,1</span>

    <!-- Gwiazdki -->
    <div id="stars" class="d-flex me-3">
      <span class="star fs-5 me-1" data-value="1">★</span>
      <span class="star fs-5 me-1" data-value="2">★</span>
      <span class="star fs-5 me-1" data-value="3">★</span>
      <span class="star fs-5 me-1" data-value="4">★</span>
      <span class="star fs-5 me-1" data-value="5">★</span>
    </div>
  </div>
  <!-- Linki -->

  <div class="text-opinie">
    <style>
      @media (max-width: 575.98px) {
        .text-opinie {
          margin-left: -35px !important;
        }
      }
    </style>
    <a href="https://www.google.com/maps/place/EuroCert+-+Oficjalny+Punkt+Sprzedaży+-+Kwalifikowany+Podpis+Elektroniczny+%7C+Pieczęć+Elektroniczna+%7C+KSeF/@52.1188615,21.0158829,16.92z/data=!4m8!3m7!1s0x471932096afc5a85:0x51ea6f25df712ad4!8m2!3d52.1188159!4d21.01759!9m1!1b1!16s%2Fg%2F11c533yp51?entry=ttu"
      target="_blank"
      rel="noopener noreferrer"
      class="text-decoration-none footer-link"
      style="color: var(--tc2); font-size: 15px;">
      (144 opinii)
    </a>

    <span class="mx-sm-2 mx-1 footer-link-sep" style="color: var(--tc2); font-size: 15px;">|</span>

    <a href="https://g.page/r/CdQqcd8lb-pREAE/review"
      target="_blank"
      rel="noopener noreferrer"
      class="text-decoration-none footer-link"
      style="color: var(--tc2); font-size: 15px;">
      Wystaw opinię
    </a>
  </div>
  <style>
    @media (max-width: 575.98px) {
      .footer-link,
      .footer-link-sep {
        font-size: 13px !important;
      }
    }
  </style>
</div>

<style>
  .star {
    color: #d1d5db;
    cursor: pointer;
    transition: transform 0.15s ease, color 0.15s ease;
  }

  .star.active {
    color: #ff8c00;
  }

  .star:hover {
    transform: scale(1.2);
  }

  a:hover {
    color: #007bff !important;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingNumber = document.getElementById("rating-number");
    const defaultRating = 4;
    const defaultText = "4,1";
    const reviewUrl = "https://g.page/r/CdQqcd8lb-pREAE/review";

    function updateStars(rating) {
      stars.forEach(star => {
        const value = star.getAttribute("data-value");
        star.classList.toggle("active", value <= rating);
      });
    }

    stars.forEach(star => {
      star.addEventListener("mouseenter", (e) => {
        const value = e.target.getAttribute("data-value");
        updateStars(value);
        ratingNumber.textContent = value + ".0";
      });

      star.addEventListener("mouseleave", () => {
        updateStars(defaultRating);
        ratingNumber.textContent = defaultText;
      });

      star.addEventListener("click", () => {
        window.open(reviewUrl, "_blank");
      });
    });

    // Domyślne podświetlenie
    updateStars(defaultRating);
  });
</script>


      </div>
    </div>

    

    

  </div>

  
</footer>
<div style="background-color: #0064bc09; font-size: 12px; padding-bottom: 8px;">
    <div  class="container d-flex flex-column flex-lg-row justify-content-between align-items-center  pt-3">
      <div class="mb-3 mb-lg-0 text-center text-lg-start">
        <a href="#" class="text-decoration-none " style="color: var(--tc2)">Polityka prywatności</a>
        <span class="px-2" style="color: var(--tc2)">|</span>
        <a href="#" class="text-decoration-none " style="color: var(--tc2)">Regulamin strony internetowej</a>
        <span class="px-2" style="color: var(--tc2)">|</span>
        <a href="#" class="text-decoration-none " style="color: var(--tc2)">Regulamin usług zaufania</a>
      </div>
      <div style="color: var(--tc2);" class="text-center text-lg-start">
        Centrum kwalifikowane Eurocert<br>
        EuroCert Sp. z o.o., Puławska 479, 02-844 Warszawa, NIP 5251252979
      </div>
    </div>
</div>


<script>
document.querySelectorAll('[data-toggle="dropdown"]').forEach(el => {
  el.setAttribute('data-bs-toggle', 'dropdown');
  el.removeAttribute('data-toggle');
});
</script>

<?php wp_footer(); ?>
</body>
</html>
