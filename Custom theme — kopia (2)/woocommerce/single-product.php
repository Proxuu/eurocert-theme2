<?php
defined( 'ABSPATH' ) || exit;
get_header( 'shop' );

global $post, $product;
if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_ID() );
}
?>

<section class="sp-product-section">
    <div class="container">
        <div class="st-breadcrumb">
            <?php 
            if ( function_exists( 'woocommerce_breadcrumb' ) ) {
                woocommerce_breadcrumb(); 
            } else {
                echo '<nav aria-label="breadcrumb"><ol class="sp-breadcrumb-list"><li class="sp-breadcrumb-item"><a href="' . esc_url( home_url() ) . '" class="sp-breadcrumb-link">Strona główna</a></li><li class="sp-breadcrumb-separator">/</li><li class="sp-breadcrumb-item"><a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '" class="sp-breadcrumb-link">Produkty</a></li><li class="sp-breadcrumb-separator">/</li><li class="sp-breadcrumb-item"><span class="sp-breadcrumb-page">' . esc_html( get_the_title() ) . '</span></li></ol></nav>';
            }
            ?>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="sp-gallery">
                    <div class="sp-gallery-thumbnails">
                        <?php
                        $gallery_ids = $product->get_gallery_image_ids();
                        $thumbs = array();
                        if ( has_post_thumbnail( $post->ID ) ) $thumbs[] = get_post_thumbnail_id( $post->ID );
                        if ( ! empty( $gallery_ids ) ) {
                            foreach ( $gallery_ids as $gid ) {
                                if ( ! in_array( $gid, $thumbs, true ) ) $thumbs[] = $gid;
                            }
                        }
                        if ( empty( $thumbs ) ) {
                            echo '<div class="sp-thumbnail sp-thumbnail-active">' . wc_placeholder_img( 'woocommerce_single' ) . '</div>';
                        } else {
                            $first = true;
                            foreach ( $thumbs as $tid ) {
                                $img = wp_get_attachment_image_src( $tid, 'medium' );
                                $img_html = $img ? '<img src="' . esc_url( $img[0] ) . '" alt="' . esc_attr( get_the_title() ) . '">' : wc_placeholder_img( 'woocommerce_thumbnail' );
                                echo '<div class="sp-thumbnail' . ( $first ? ' sp-thumbnail-active' : '' ) . '" data-full-id="' . esc_attr( $tid ) . '">' . $img_html . '</div>';
                                $first = false;
                            }
                        }
                        ?>
                    </div>
                    <div class="sp-gallery-main">
                        <?php
                        if ( has_post_thumbnail( $post->ID ) ) {
                            echo get_the_post_thumbnail( $post->ID, 'large', [ 'class' => 'sp-main-image', 'alt' => get_the_title() ] );
                        } elseif ( ! empty( $gallery_ids ) ) {
                            echo wp_get_attachment_image( $gallery_ids[0], 'large', false, [ 'class' => 'sp-main-image', 'alt' => get_the_title() ] );
                        } else {
                            echo wc_placeholder_img( 'woocommerce_single', array( 'class' => 'sp-main-image' ) );
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="sp-product-info">
                    <h2 class="sp-product-title"><?php echo esc_html( get_the_title() ); ?></h2>

                    <?php
                    if ( $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ) : ?>
                        <div class="sp-options">
                            <?php if ( $product->is_type( 'variable' ) ) : ?>
                                <?php
                                // Render WooCommerce variable product form (z selectami)
                                $available_variations = $product->get_available_variations();
                                $attributes            = $product->get_variation_attributes();
                                $selected_attributes   = $product->get_default_attributes();
                                wc_get_template( 'single-product/add-to-cart/variable.php', array(
                                    'available_variations' => $available_variations,
                                    'attributes'           => $attributes,
                                    'selected_attributes'  => $selected_attributes,
                                ) );
                                ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    

                    <div class="sp-add-to-cart">
                        <?php
                        switch ( $product->get_type() ) {
                            case 'variable':
                                break;
                            case 'grouped':
                                wc_get_template( 'single-product/add-to-cart/grouped.php' );
                                break;
                            case 'external':
                                wc_get_template( 'single-product/add-to-cart/external.php' );
                                break;
                            default:
                                wc_get_template( 'single-product/add-to-cart/simple.php' );
                                break;
                        }
                        ?>
                    </div>

                    <!-- CTA -->
                    <div class="sp-cta-section">
                        <div class="sp-cta-wrapper">
                            <p class="sp-cta-text">Masz dodatkowe pytania lub potrzebujesz indywidualną ofertę? 📊</p>
                            <a href="#contact" class="sp-btn sp-btn-secondary">ZAMÓW ROZMOWĘ</a>
                        </div>
                    </div>

                    <!-- Footer info -->
                    <div class="sp-footer-info">
                        <div class="sp-footer-grid">
                            <button class="sp-link-btn" type="button" onclick="document.getElementById('panel-opis').scrollIntoView({behavior:'smooth'});">Zobacz opis produktu</button>
                            <div class="sp-location-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="sp-location-icon">
                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>Kup online i odbierz stacjonarnie w Autoryzowanym Punkcie</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
$cross_sells = $product->get_cross_sell_ids();
if ( ! empty( $cross_sells ) ) : ?>
<section class="sp-services-section">
    <div class="container">
        <div class="sp-services-container">
            <div class="sp-services-layout">
                <div class="sp-services-header">
                    <h2 class="sp-services-title">Dodatkowe usługi:</h2>
                </div>
                <div class="sp-services-content">
                    <div class="sp-services-grid">
                        <?php foreach ( $cross_sells as $cross_id ) :
                            $cross = wc_get_product( $cross_id );
                            if ( ! $cross ) continue;

                            // Cena netto i brutto
                            $price_excl_tax = wc_get_price_excluding_tax( $cross );
                            $price_incl_tax = $cross->get_price();
                            ?>
                            <div class="sp-service-item">
                                <div class="sp-service-icon">
                                    <?php
                                    $thumbnail_id = $cross->get_image_id(); // ID obrazka produktu
                                    if ( $thumbnail_id ) {
                                        echo wp_get_attachment_image( $thumbnail_id, 'thumbnail', false, array(
                                            'alt' => esc_attr( $cross->get_name() ),
                                            'class' => 'sp-service-thumbnail'
                                        ) );
                                    } else {
                                        // fallback jeśli brak obrazka
                                        echo wc_placeholder_img( 'thumbnail' );
                                    }
                                    ?>
                                </div>

                                <div class="sp-service-content">
                                    <div class="sp-service-header">
                                        <h3 class="sp-service-name"><?php echo esc_html( $cross->get_name() ); ?></h3>
                                    </div>
                                    <div class="sp-service-price">
                                        <div style="font-size:14px; font-weight: 600; line-height: 0.9; margin-top: 0.3rem;"><?php echo wc_price( $price_excl_tax ); ?> netto</div>
                                        <div style="font-size:12px; color: var(--eurocert-medium-blue);">(<?php echo wc_price( $price_incl_tax ); ?> brutto)</div>
                                    </div>
                                </div>
                                <a class="sp-add-btn" href="<?php echo esc_url( get_permalink( $cross_id ) ); ?>">+</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
$dostawa = get_field('product_tab_dostawa');
$informacje = get_field('product_tab_informacje');

$opis = apply_filters('the_content', $post->post_content);

$has_tabs = $opis || $dostawa || $informacje;

?>

<?php if ( $has_tabs ) : ?>
<!-- Zakładki -->
<section class="sp-tabs-section">
    <div class="container">
        <div class="sp-tabs">
            <div class="sp-tabs-header">
                <?php if ( $opis ) : ?><button class="sp-tab sp-tab-active" data-tab="opis">Opis produktu</button><?php endif; ?>
                <?php if ( $dostawa ) : ?><button class="sp-tab <?php echo !$opis ? 'sp-tab-active' : ''; ?>" data-tab="dostawa">Dostawa i aktywacja</button><?php endif; ?>
                <?php if ( $informacje ) : ?><button class="sp-tab <?php echo (!$opis && !$dostawa) ? 'sp-tab-active' : ''; ?>" data-tab="informacje">Informacje dodatkowe</button><?php endif; ?>
            </div>

            <div class="sp-tabs-content">
                <?php if ( $opis ) : ?>
                    <div class="sp-tab-panel sp-tab-panel-active" id="panel-opis">
                        <?php echo wp_kses_post( $opis ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $dostawa ) : ?>
                    <div class="sp-tab-panel <?php echo !$opis ? 'sp-tab-panel-active' : ''; ?>" id="panel-dostawa">
                        <?php echo wp_kses_post( $dostawa ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $informacje ) : ?>
                    <div class="sp-tab-panel <?php echo (!$opis && !$dostawa) ? 'sp-tab-panel-active' : ''; ?>" id="panel-informacje">
                        <?php echo wp_kses_post( $informacje ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Contact Section -->
<section class="fr-contact-section">
    <div class="container fr-contact-bg">
        <div class="fr-contact-wrapper">
            <div class="fr-section-header text-center">
                <span class="fr-badge">KONTAKT</span>
                <h2 class="fr-section-title">Masz dodatkowe pytania lub chcesz złożyć zamówienie telefonicznie?</h2>
                <p class="fr-text">Wypełnij formularz i poczekaj na kontakt od nas.</p>
            </div>
            <div class="fr-contact-form-wrapper">
                <form class="fr-contact-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Imię i nazwisko</label>
                        <input type="text" class="form-control fr-form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adres e-mail</label>
                        <input type="email" class="form-control fr-form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Numer telefonu</label>
                        <input type="tel" class="form-control fr-form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="consent" required>
                            <label class="form-check-label" for="consent">
                                Wyrażam zgodę na przetwarzanie danych osobowych przez EuroCert Sp. z o.o. jako Administratora w celu otrzymania odpowiedzi. Zgodę mogę wycofać poprzez zgłoszenie na kontakt@eurocert.pl.
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="fr-btn fr-btn-primary w-100">WYŚLIJ WIADOMOŚĆ</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // gallery thumbnails
    document.querySelectorAll('.sp-thumbnail').forEach(function(thumbnail){
        thumbnail.addEventListener('click', function(){
            document.querySelectorAll('.sp-thumbnail').forEach(function(t){ t.classList.remove('sp-thumbnail-active'); });
            this.classList.add('sp-thumbnail-active');
            var img = this.querySelector('img'), main = document.querySelector('.sp-main-image');
            if ( img && main ) main.src = img.getAttribute('src');
        });
    });

    // tabs
    document.querySelectorAll('.sp-tab').forEach(function(tab){
        tab.addEventListener('click', function(){
            var target = this.getAttribute('data-tab');
            document.querySelectorAll('.sp-tab').forEach(function(t){ t.classList.remove('sp-tab-active'); });
            document.querySelectorAll('.sp-tab-panel').forEach(function(p){ p.classList.remove('sp-tab-panel-active'); });
            this.classList.add('sp-tab-active');
            var panel = document.getElementById('panel-' + target);
            if ( panel ) panel.classList.add('sp-tab-panel-active');
        });
    });
});
</script>

<?php get_footer('shop'); ?>
