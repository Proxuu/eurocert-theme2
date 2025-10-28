<?php
defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock"><?php echo esc_html__( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
    <?php else : ?>
        <table class="variations" cellspacing="0" role="presentation">
            <tbody>
                <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                    <tr>
                        <th class="label">
							<label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
								<?php echo wc_attribute_label( $attribute_name ); ?>
							</label>

							<div class="tooltip-container">
								<svg class="sp-svgicon sp-help-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<circle cx="12" cy="12" r="10"></circle>
									<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
									<path d="M12 17h.01"></path>
								</svg>
								<div class="hover-text2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
							</div>

						</th>

                        <td class="value">
                            <div class="custom-dropdown-wrapper">
                                <?php
                                wc_dropdown_variation_attribute_options( [
                                    'options'   => $options,
                                    'attribute' => $attribute_name,
                                    'product'   => $product,
                                ] );
                                ?>

                                <div class="custom-dropdown-header">Wybierz opcję</div>
                                <ul class="custom-dropdown">
                                    <?php foreach ( $options as $option ) : ?>
                                        <li data-value="<?php echo esc_attr( $option ); ?>">
                                            <?php echo esc_html( $option ); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <?php
                                if ( end( $attribute_keys ) === $attribute_name ) {
                                    echo wp_kses_post(
                                        apply_filters(
                                            'woocommerce_reset_variations_link',
                                            '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>'
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="single_variation_wrap">
            <?php
            do_action( 'woocommerce_before_single_variation' );
            do_action( 'woocommerce_single_variation' );
            do_action( 'woocommerce_after_single_variation' );
            ?>
        </div>
    <?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<!-- STYLE -->
<style>
.variations{
	width: 100%;
	border-collapse: separate;
	border-spacing: 0 1.5rem;
	margin-top: -1rem;
}

.variations .label{
    color: var(--eurocert-medium-blue);
    font-size: 0.875rem;
    cursor: help;
    margin: 0;
    position: relative;
	font-weight: 400;
	width: 200px;
}

.tooltip-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
}


.custom-dropdown-wrapper {
    position: relative;
    display: block;
    width: 100%;
}

.custom-dropdown-wrapper select {
    display: none !important;
}

.custom-dropdown-header {
    width: 100%;
    padding: 0.7rem 3rem 0.7rem 3rem;
    border-radius: 60px;
    border: 1px solid #e6e8ed;
    background-color: #f8f9fa;
    font-size: 0.875rem;
    color: var(--eurocert-dark-blue);
    cursor: pointer;
    user-select: none;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
}

.custom-dropdown-header svg {
    width: 1rem;
    height: 1rem;
    opacity: 0.5;
    pointer-events: none;
}

.custom-dropdown {
    display: none;
    position: absolute;
    z-index: 10;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    margin-top: 0.3rem;
    padding: 0;
    list-style: none;
}

.custom-dropdown li {
    padding: 8px 15px;
    cursor: pointer;
    transition: background 0.2s;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0.3rem;
    border-radius: 5px;
	color: var(--eurocert-dark-blue);
	font-size: 14px;
}

.custom-dropdown li:hover {
    background-color: #f1f3f8;
}

.custom-dropdown li.active {
    background-color: #e9edf5;
    color: var(--eurocert-dark-blue);
    font-weight: 500;
}

/* Ptaszek przy zaznaczonej opcji */
.custom-dropdown li.active::after {
    margin-left: 0.5rem;
    color: var(--eurocert-dark-blue);
    font-weight: bold;
}
/* Usuń content z CSS, zostaw tylko miejsce dla SVG */
.custom-dropdown li.active svg.checkmark {
    margin-left: 0.5rem;
    width: 0.8rem;
    height: 0.8rem;
    fill: var(--eurocert-dark-blue);
}

</style>

<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.custom-dropdown-wrapper').forEach(wrapper => {
        const dropdown = wrapper.querySelector('.custom-dropdown');
        const select = wrapper.querySelector('select');
        const header = wrapper.querySelector('.custom-dropdown-header');

        // Dodaj strzałkę do headera
        if (!header.querySelector('svg.chevron')) {
            header.innerHTML += `<svg class="lucide lucide-chevron-down chevron" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"></path></svg>`;
        }

        // Funkcja do dodania SVG checkmark
        const addCheckmark = li => {
            // Usuń istniejące
            li.querySelectorAll('svg.checkmark').forEach(el => el.remove());
            // Dodaj SVG
            li.insertAdjacentHTML('beforeend', `<svg class="checkmark" fill="#000000" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M1827.701 303.065 698.835 1431.801 92.299 825.266 0 917.564 698.835 1616.4 1919.869 395.234z" fill-rule="evenodd"></path> </g></svg>`);
        };

        // Ustawienie początkowej wartości
        const selectedOption = select.options[select.selectedIndex];
        if (selectedOption && selectedOption.value !== '') {
            header.childNodes[0].textContent = selectedOption.textContent;
            dropdown.querySelectorAll('li').forEach(li => {
                if (li.dataset.value === selectedOption.value) {
                    li.classList.add('active');
                    addCheckmark(li);
                }
            });
        }

        header.addEventListener('click', e => {
            e.stopPropagation();
            const isOpen = dropdown.style.display === 'block';
            document.querySelectorAll('.custom-dropdown').forEach(d => d.style.display = 'none');
            dropdown.style.display = isOpen ? 'none' : 'block';
        });

        dropdown.querySelectorAll('li').forEach(li => {
            li.addEventListener('click', e => {
                e.stopPropagation();
                dropdown.querySelectorAll('li').forEach(el => {
                    el.classList.remove('active');
                    el.querySelectorAll('svg.checkmark').forEach(svg => svg.remove());
                });
                li.classList.add('active');
                addCheckmark(li);
                header.childNodes[0].textContent = li.textContent;

                select.value = li.dataset.value;
                select.dispatchEvent(new Event('change', { bubbles: true }));

                dropdown.style.display = 'none';
            });
        });

        document.addEventListener('click', () => {
            dropdown.style.display = 'none';
        });
    });
});

</script>
