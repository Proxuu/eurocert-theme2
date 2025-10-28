<?php
require_once get_template_directory() . '/assets/navwalker/class-wp-bootstrap-navwalker.php';

// Podstawowa konfiguracja
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('site-icon');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'theme_setup');
// Usunięcie gutenberga dla stron i postów
add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
    if (in_array($post_type, ['page', 'post'], true)) {
        return false;
    }
    return $use_block_editor;
}, 10, 2);
// Usunięcie własnych pól
add_action('admin_init', function () {
    remove_post_type_support('page', 'custom-fields');
    remove_post_type_support('post', 'custom-fields');
});
// Usunięcie dodawania automatycznych <p> w CF7
add_filter('wpcf7_autop_or_not', '__return_false');
// Wyłączenie admin-bara
add_filter('show_admin_bar', '__return_false');

function theme_enqueue_style(){

    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_style( 'aos-css', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', array(), '2.3.4' );
    wp_enqueue_script( 'aos-js', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', array('jquery'), '2.3.4', true );
    wp_add_inline_script( 'aos-js', 'document.addEventListener("DOMContentLoaded", function(){ AOS.init({duration: 1200,}); });' );
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', [], filemtime(get_template_directory() . '/style.css'));
    wp_enqueue_style('theme-main-style', get_template_directory_uri() . '/assets/css/main.css', [], filemtime(get_template_directory() . '/assets/css/main.css'));
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', [], null, true);

     if ( class_exists('WooCommerce') && is_product() ) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }

}
add_action('wp_enqueue_scripts', 'theme_enqueue_style');

function register_menus() {
register_nav_menus(array(
        'top1' => __( 'Menu top left' ),
        'top2' => __( 'Menu top right' ),
        'primary' => __( 'Menu główne' ),
        'primary-mobile' => __( 'Menu główne - mobilka' ),
        'footer' => __( 'Menu w stopce 1 (Ogólne)' ),
        'footer2' => __( 'Menu w stopce 2 (Produkty)' ),
        'footer3' => __( 'Menu w stopce 3 (Pomoc)' ),
    ));
}
add_action( 'init', 'register_menus' );




// ================ woocommerce =============




add_action( 'template_redirect', function() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
});




// Dodanie nowego pola w zakładce 'General' w edycji produktu
add_action('woocommerce_product_options_general_product_data', function() {

    woocommerce_wp_text_input([
        'id' => '_product_subtitle', // unikalny klucz meta
        'label' => __('Dodatkowy tekst', 'textdomain'),
        'placeholder' => 'Wpisz krótki tekst',
        'desc_tip' => true,
        'description' => __('Ten tekst będzie wyświetlany na zdjęciu produktu na niebieskim tle', 'textdomain'),
    ]);

});

add_action('woocommerce_process_product_meta', function($post_id) {

    if (isset($_POST['_product_subtitle'])) {
        update_post_meta($post_id, '_product_subtitle', sanitize_text_field($_POST['_product_subtitle']));
    }
});



add_filter( 'woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumbs' );
function custom_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => '<span class="delimiter">/</span>', // separator
        'wrap_before' => '<nav class="woocommerce-breadcrumb">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => 'EuroCert', // tekst dla linku do strony głównej
    );
}




// Ukryj pole ilości na stronie produktu prostego (ale zachowaj przycisk)
add_filter( 'woocommerce_is_sold_individually', 'my_hide_quantity_on_single_product', 10, 2 );
function my_hide_quantity_on_single_product( $sold_individually, $product ) {
    if ( is_product() && is_a( $product, 'WC_Product' ) && $product->is_type( 'simple' ) ) {
        return true; // traktuj jako sprzedawany pojedynczo -> WooCommerce nie pokaże pola quantity
    }
    return $sold_individually;
}




add_filter( 'woocommerce_get_price_html', 'custom_price_display_all_products', 10, 2 );
function custom_price_display_all_products( $price_html, $product ) {

    // Cena netto (bez VAT)
    $price_excl_tax = wc_get_price_excluding_tax( $product );
    $price_excl_tax_html = '<span class="sp-price-main">' . wc_price( $price_excl_tax, array( 'decimal_separator' => '.', 'thousand_separator' => ' ', 'decimals' => 2 ) ) . ' netto</span>';

    // Cena brutto
    $price_incl_tax_html = '<span class="sp-price-gross">(' . wc_price( $product->get_price(), array( 'decimal_separator' => '.', 'thousand_separator' => ' ', 'decimals' => 2 ) ) . ' brutto)</span>';

    // Cała sekcja z ceną
    return '<div class="sp-price-section">' . $price_excl_tax_html . '&nbsp;&nbsp;' . $price_incl_tax_html . '</div>';
}





