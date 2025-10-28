<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>

</head>

<?php
get_header();
?>

<body class="main-font text-primary">


<div id="scroll-progress"></div>

<script>
  window.addEventListener('scroll', function() {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollPercent = (scrollTop / docHeight) * 100;
    document.getElementById('scroll-progress').style.width = scrollPercent + '%';
  });
</script>

<div class="sticky-header border-bottom">

<div class="d-none d-lg-block bg-light bg-opacity-25 ">
  <div class="container-lg d-flex justify-content-between align-items-center text-sm border-bottom">
    <div class="menu-top d-flex gap-4">
        <?php
        wp_nav_menu([
            'theme_location'  => 'top1',
            'depth'           => 2,
            'container'       => false,
            'menu_class'      => 'navbar-nav flex-row gap-4',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ]);
        ?>
    </div>

    <div class="menu-top d-flex gap-4 align-items-center">
        <?php
        wp_nav_menu([
            'theme_location'  => 'top2',
            'depth'           => 2,
            'container'       => false,
            'menu_class'      => 'navbar-nav flex-row gap-4',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ]);
        ?>

        <div class="d-flex align-items-center lang-wrapper">
            <svg class="lang-svg" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle><path d="M2 12h20" stroke="currentColor" stroke-width="2"></path><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" stroke="currentColor" stroke-width="2"></path></svg>
            <?php echo do_shortcode( '[language-switcher]' ) ?>
        </div>
    </div>

  </div>
</div>

<nav class="navbar navbar-expand-lg">
  <div class="container-lg">
    <div class="d-flex">
        <?php if (has_custom_logo()) :
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full'); ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand">
            <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="main-logo-img">
        </a>
        <?php else : ?>
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <?php endif; ?>

        <div class="d-flex align-items-center lang-wrapper d-lg-none">
            <svg class="lang-svg" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle><path d="M2 12h20" stroke="currentColor" stroke-width="2"></path><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" stroke="currentColor" stroke-width="2"></path></svg>
            <?php echo do_shortcode( '[language-switcher]' ) ?>
          </div>
            
        </div>
          
          <div class="collapse navbar-collapse" id="primaryNavbar">
    <div class="primary-menu d-flex gap-3 gap-xxl-3 gap-1">
        <?php
        wp_nav_menu([
            'theme_location'  => 'primary',
            'depth'           => 3,
            'container'       => false,
            'menu_class'      => 'navbar-nav flex-row gap-3 gap-xxl-3 gap-1',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ]);
        ?>
        </div>
    </div>


    <div class="d-flex">

        <a href="<?php echo get_post_type_archive_link('product'); ?>" class="btn btn-primary typing-btn d-none d-lg-flex">
            <span id="typing-text"></span>
        </a>

        <script>
        (function() {
            const phrases = ["KUP PODPIS", "ODNÓW CERTYFIKAT", "SKLEP ONLINE"];
            let phraseIndex = 0;
            let letterIndex = 0;
            let typing = true;
            const typingSpeed = 100;
            const deletingSpeed = 60;
            const pauseAfterTyping = 1200;
            const pauseAfterDeleting = 400;
            const el = document.getElementById('typing-text');

            function type() {
                if (typing) {
                    if (letterIndex < phrases[phraseIndex].length) {
                        el.textContent += phrases[phraseIndex][letterIndex];
                        letterIndex++;
                        setTimeout(type, typingSpeed);
                    } else {
                        typing = false;
                        setTimeout(type, pauseAfterTyping);
                    }
                } else {
                    if (letterIndex > 0) {
                        el.textContent = phrases[phraseIndex].substring(0, letterIndex - 1);
                        letterIndex--;
                        setTimeout(type, deletingSpeed);
                    } else {
                        typing = true;
                        phraseIndex = (phraseIndex + 1) % phrases.length;
                        setTimeout(type, pauseAfterDeleting);
                    }
                }
            }
            type();
        })();
        </script>

        <?php if (class_exists('WooCommerce')): ?>
        <div class="">
            <a href="<?php echo wc_get_cart_url(); ?>" class="cart-btn cart-link ms-lg-3 position-relative d-flex align-items-center group" title="Koszyk">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart w-6 h-6 text-eurocert-primary-blue cart-svg transition-colors duration-300" aria-hidden="true"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                <?php $count = WC()->cart->get_cart_contents_count(); ?>
                <?php if ($count > 0): ?>
                    <span class="cart-count badge bg-primary position-absolute top-0 start-100 translate-middle"><?php echo esc_html($count); ?></span>
                <?php endif; ?>
            </a>
        </div>
        <?php endif; ?>


        <button class="btn btn-outline-none hamburger-btn ms-2 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
            <svg class="hamburger-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16"></path><path d="M4 12h16"></path><path d="M4 19h16"></path></svg>
        </button>



 
</div>

  </div>
</nav>

<div class="offcanvas offcanvas-end" style="z-index: 9999999;" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
  <div class="offcanvas-header">
        <?php if (has_custom_logo()) :
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full'); ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand">
            <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" style="max-height:50px; height:auto; width:auto; object-fit:contain;">
        </a>
        <?php else : ?>
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <?php endif; ?>

    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body mobile-menu">
    <?php
      wp_nav_menu([
          'theme_location' => 'primary-mobile',
          'depth' => 3,
          'container' => false,
          'menu_class' => 'navbar-nav flex-column gap-2',
          'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
          'walker' => new WP_Bootstrap_Navwalker(),
      ]);
    ?>

    <hr style="opacity: 0.1;">

        <a href="<?php echo get_post_type_archive_link('product'); ?>" class="btn btn-primary" style="margin-top: 20px; max-width: 200px;">
            SKLEP ONLINE
        </a>

        <div class="top1-mobile-menu">
        <?php
        wp_nav_menu([
            'theme_location'  => 'top1',
            'depth'           => 2,
            'container'       => false,
            'menu_class'      => 'navbar-nav flex-row gap-4',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ]);
        ?>
        </div>

  </div>
</div>




</div>


<main>
