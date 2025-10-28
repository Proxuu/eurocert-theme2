<div class="st-product-card">
    <div class="st-product-image-wrapper">
        <div class="st-product-image">
            <a href="<?php the_permalink(); ?>">
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('medium', ['class' => 'st-product-img', 'alt' => get_the_title()]);
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/img/default-product.png" class="st-product-img" alt="Produkt">';
                }
                ?>
            </a>
        </div>
		<?php 
            global $product;

			$subtitle = get_post_meta($product->get_id(), '_product_subtitle', true);

			if ($subtitle) {
				echo '<p class="st-product-badge">' . esc_html($subtitle) . '</p>';
			}
		?>
    </div>
    <div class="st-product-content">
        <div class="st-product-info">
            <h4 class="st-product-title"><?php the_title(); ?></h4>
            
            <!-- Krótki opis produktu -->
            <?php 
            $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
            if ( $short_description ) : ?>
                <div class="st-product-subtitle"><?php echo $short_description; ?></div>
            <?php endif; ?>
        </div>
        <div class="st-product-price">
            <?php

            if ($product->get_price()) :
                $price_net = wc_get_price_excluding_tax($product);
                $price_gross = wc_get_price_including_tax($product);
            ?>
            <div class="st-price-main">
                <span class="st-price-amount">od <?php echo wc_price($price_net); ?></span>
                <span class="st-price-label">netto</span>
            </div>
            <div class="st-price-gross">od <?php echo wc_price($price_gross); ?> brutto</div>
            <?php endif; ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="st-product-btn">WYBIERZ WARIANT</a>
    </div>
</div>
