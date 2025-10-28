<?php
/**
 * The Template for displaying product archives (shop page)
 * Template overrides WooCommerce archive structure but keeps all dynamic features.
 */

defined('ABSPATH') || exit;

get_header('shop');
?> 

<section class="st-hero-section">
    <div class="st-decorative-bg">
        <!-- Dots (pozostają bez zmian) -->
        <?php for ($i = 0; $i < 15; $i++): ?>
            <div class="st-dot" style="background-color: rgba(0, 100, 188, 0.3); width: <?= 8 + $i ?>px; height: <?= 8 + $i ?>px; top: <?= 10 + $i * 7 ?>%; left: <?= 5 + $i * 11 ?>%; transform: rotate(<?= $i * 30 ?>deg); opacity: 0.3;"></div>
        <?php endfor; ?>
    </div>

    <div class="container">
        <div class="st-breadcrumb">
            <?php woocommerce_breadcrumb(); ?>
        </div>

        <div class="st-hero-banner">
            <div class="st-hero-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/hero-bg.png');">
                <div class="st-hero-content d-none d-md-flex">
                    <div class="st-hero-text">
                        <p class="st-hero-badge">ESHOP</p>
                        <h1 class="st-hero-title">Kwalifikowany<br> podpis elektroniczny</h1>
                        <p class="st-hero-description">Oficjalny sklep online Kwalifikowanego Dostawcy Usług Zaufania (QTSP).</p>
                    </div>
                </div>
                <div class="st-hero-content d-md-none">
                    <div class="st-hero-text">
                        <p class="st-hero-badge">ESHOP</p>
                        <h1 class="st-hero-title st-hero-title-mobile"><?php woocommerce_page_title(); ?></h1>
                        <p class="st-hero-description st-hero-description-mobile">Oficjalny sklep online Kwalifikowanego Dostawcy Usług Zaufania (QTSP).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop Section -->
<section class="st-shop-section">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="st-sidebar">
                    <h2 class="st-sidebar-title">Kategorie</h2>

					<nav class="st-sidebar-nav">
						<?php
						$class = is_post_type_archive('product') ? 'class="shop-all-products"' : '';
						echo '<a href="' . get_post_type_archive_link('product') . '" ' . $class . '>Wszystkie produkty</a>';

						wp_list_categories([
							'taxonomy'     => 'product_cat',
							'title_li'     => '',
							'walker'       => new Walker_Category(),
							'show_count'   => false,
							'exclude'      => '53', // ID kategorii "Bez kategorii"
							'orderby'      => 'ID',
							'order'        => 'ASC',
						]);
						?>
					</nav>

                </div>
            </div>

            <!-- Products -->
            <div class="col-lg-8">
                <div class="st-toolbar">
                    <div class="st-results">
                        <?php woocommerce_result_count(); ?>
                    </div>
                    <div class="st-view-switcher d-none d-md-flex">
                        <span class="st-view-label">Widok:</span>
                        <div class="st-view-buttons">
                            <button class="st-view-btn st-view-btn-active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="st-icon"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path><path d="M3 15h18"></path><path d="M9 3v18"></path><path d="M15 3v18"></path></svg>
                            </button>
                            <button class="st-view-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="st-icon"><path d="M3 12h.01"></path><path d="M3 18h.01"></path><path d="M3 6h.01"></path><path d="M8 12h13"></path><path d="M8 18h13"></path><path d="M8 6h13"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <?php if (woocommerce_product_loop()) : ?>
					<div class="row row-cols-1 row-cols-md-2 g-4">
						<?php while (have_posts()) : the_post(); ?>
							<div class="col">
								<?php wc_get_template_part( 'content', 'product' ); ?>
							</div>
						<?php endwhile; ?>
					</div>
					<?php woocommerce_pagination(); ?>
				<?php else : ?>
					<?php do_action('woocommerce_no_products_found'); ?>
				<?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="st-contact-section">
    <div class="container">
        <div class="st-contact-container">
            <div class="st-contact-inner">
                <div class="st-contact-header">
                    <div class="st-contact-badge-wrapper">
                        <span class="st-contact-badge">KONTAKT</span>
                    </div>
                    <h2 class="st-contact-title">Masz dodatkowe pytania lub chcesz złożyć zamówienie telefonicznie?</h2>
                    <p class="st-contact-description">Wypełnij formularz i poczekaj na kontakt od nas.</p>
                </div>
                <div class="st-contact-form-wrapper">
                    <form class="st-contact-form">
                        <div class="st-form-group">
                            <label for="name" class="st-form-label">Imię i nazwisko</label>
                            <input type="text" class="st-form-control" id="name" name="name">
                        </div>
                        <div class="st-form-group">
                            <label for="email" class="st-form-label">Adres e-mail</label>
                            <input type="email" class="st-form-control" id="email" name="email">
                        </div>
                        <div class="st-form-group">
                            <label for="phone" class="st-form-label">Numer telefonu</label>
                            <input type="tel" class="st-form-control" id="phone" name="phone">
                        </div>
                        <div class="st-form-check-group">
                            <input type="checkbox" class="st-form-checkbox" id="consent" required>
                            <label for="consent" class="st-consent-label">
                                Wyrażam zgodę na przetwarzanie danych osobowych przez EuroCert Sp. z o.o. jako Administratora w celu otrzymania odpowiedzi.
                            </label>
                        </div>
                        <button type="submit" class="st-submit-btn">WYŚLIJ WIADOMOŚĆ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer('shop'); ?>
