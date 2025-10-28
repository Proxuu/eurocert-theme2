<?php
get_header(); 
?>


<style>
:root{
  --accent: #07285c;
  --accent-light: #eaf4ff;
  --muted: #6f8aa0;
  --card-bg: #f3f8fb;
  --radius: 14px;
  --maxw: 1200px;
}

.blog-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 60px;
    font-size: 16px;
    font-weight: 500;
    color: var(--eurocert-cyan-light);
    background-color: transparent;
    letter-spacing: 0.05em;
}

.blog-section-title {
    font-size: 36px;
    font-weight: 700;
    color: var(--eurocert-dark-blue);
    line-height: 1.3;
    margin-bottom: 1.4rem;
}

.search-wrap-custom{
  max-width: 550px;
  margin-inline: auto;
}

.btn-search{
    background-color: var(--eurocert-primary-blue);
    color: white;
    white-space: nowrap;
    gap: 16;
}

.search-wrap-custom .form-control {
  border-radius: 14px;
  background: #f6fbff;
  padding: 12px 18px;
  border: 0;
}

.search-wrap-custom .btn {
  border-radius: 14px;
  padding: 12px 40px;
}

/* category pills custom tweaks */
.cat-pills-custom a { margin:6px; }
.cat-pills-custom .btn {
  border-radius: 999px;
  font-size: 0.85rem;
  padding: 6px 16px;
}

/* cards */
.post-card {
  border-radius: var(--radius);
  overflow: hidden;
  border: 1px solid #eef6fb;
  background: #fff;
  box-shadow: 0 6px 18px rgba(9,30,66,0.04);
}
.post-card .card-body {
  background: var(--card-bg);
  padding: 18px;
  min-height: 160px;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
}
.post-card .post-date { font-size: 0.8rem; color:#94a6b8; }
.post-card h5 { color: var(--accent); font-weight:700; font-size:1.05rem; margin-top:8px; }
.post-card .excerpt { color:#3a556b; font-size:0.95rem; margin-top:8px; }

/* responsive tweaks */
@media (max-width: 767.98px){
  .site-hero h1 { font-size: 1.9rem; }
  .post-card .card-img-top { height:180px; object-fit:cover; }
}
</style>

<section class="my-5">

  <div class="container">

    <div class="st-breadcrumb">
        <?php woocommerce_breadcrumb(); ?>
    </div>


    <!-- HEADER / HERO -->
    <div class="text-center mb-4">
      <span class="blog-badge">BAZA WIEDZY</span>
      <h1 class="blog-section-title">Blog</h1>
      <p class="fr-text">Baza wiedzy, case studies, artykuły, webinary, materiały do pobrania.</p>
    </div>


    <!-- SEARCH -->
    <div class="row justify-content-center mb-3">
    <div class="col-12 col-md-10">
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="d-flex align-items-center search-wrap-custom">
        <input
            type="search"
            name="s"
            class="form-control me-3"
            placeholder="Wpisz czego szukasz..."
            value="<?php echo esc_attr(get_search_query()); ?>"
            aria-label="Szukaj"
        />
        <button class="btn btn-search" type="submit">SZUKAJ →</button>
        </form>
    </div>
    </div>


    <!-- CATEGORIES (pills) -->
    <div class="row justify-content-center mb-4">
      <div class="col-12">
        <div class="d-flex flex-wrap justify-content-center cat-pills-custom">
          <?php
            $categories = get_categories( array( 'orderby' => 'name' ) );
            $current_cat = 0;
            if ( isset( $_GET['cat'] ) ) {
              $current_cat = intval( $_GET['cat'] );
            } elseif ( get_query_var('cat') ) {
              $current_cat = intval( get_query_var('cat') );
            }
            // "Wszystkie artykuły" button
            $all_link = remove_query_arg('cat', home_url( add_query_arg( array() ) ));
            // build base url preserving 's' (search) when present
            $base_url = home_url('/');
            $search_param = '';
            if ( ! empty( $_GET['s'] ) ) {
              $search_param = '?s=' . urlencode( wp_unslash( $_GET['s'] ) );
            }
            // print all
            $all_url = $base_url . $search_param;
          ?>
          <a style="font-weight: 500;" href="<?php echo esc_url( $all_url ); ?>" class="fr-btn <?php echo $current_cat===0 ? 'fr-btn-primary' : 'btn-outline-primary'; ?>">WSZYSTKIE ARTYKUŁY</a>

          <?php foreach ( $categories as $cat ) : 
            // build link keeping search param if any
            $cat_link = add_query_arg( array_merge( array( 'cat' => $cat->term_id ), ( ! empty( $_GET['s'] ) ? array( 's' => wp_unslash( $_GET['s'] ) ) : array() ) ), home_url('/') ); 
            $is_active = $current_cat === intval($cat->term_id);
          ?>
            <a href="<?php echo esc_url($cat_link); ?>" class="btn <?php echo $is_active ? 'btn-primary' : 'btn-outline-primary'; ?>"><?php echo esc_html( $cat->name ); ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- POSTS GRID -->
    <?php
      // Prepare query: support pagination, category filter and search
      $paged = max( 1, get_query_var('paged') ? get_query_var('paged') : ( get_query_var('page') ? get_query_var('page') : 1 ) );
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
        'paged' => $paged,
      );
      if ( $current_cat > 0 ) {
        $args['cat'] = $current_cat;
      }
      if ( ! empty( $_GET['s'] ) ) {
        $args['s'] = sanitize_text_field( wp_unslash( $_GET['s'] ) );
      }

      $query = new WP_Query( $args );
    ?>

    <?php if ( $query->have_posts() ) : ?>
      <div class="row g-4">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-6 col-lg-4'); ?>>
            <div class="post-card">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top img-fluid', 'loading' => 'lazy', 'alt' => the_title_attribute( array('echo'=>false) ) ) ); ?>
                </a>
              <?php else: ?>
                <!-- placeholder image -->
                <a href="<?php the_permalink(); ?>">
                  <div class="card-img-top" style="height:200px;background:#e6e6e6;"></div>
                </a>
              <?php endif; ?>

              <div class="card-body">
                <div>
                  <div class="post-date"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></div>
                  <h5 class="mt-2"><a href="<?php the_permalink(); ?>" style="text-decoration:none; color:inherit;"><?php the_title(); ?></a></h5>
                  <div class="excerpt">
                    <?php
                      if ( has_excerpt() ) {
                        echo wp_kses_post( wp_trim_words( get_the_excerpt(), 20, '...' ) );
                      } else {
                        echo wp_kses_post( wp_trim_words( get_the_content(), 20, '...' ) );
                      }
                    ?>
                  </div>
                </div>

                <div class="mt-3">
                  <a href="<?php the_permalink(); ?>" class="read-more btn btn-link p-0" style="font-weight:700; color:var(--accent);">Przeczytaj artykuł →</a>
                </div>
              </div>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>

      <!-- PAGINATION -->
      <?php
        $big = 999999999; // need an unlikely integer
        $paginate_links = paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, $paged ),
          'total' => $query->max_num_pages,
          'type' => 'array',
          'prev_text' => '&laquo;',
          'next_text' => '&raquo;',
        ) );

        if ( is_array( $paginate_links ) ) : ?>
          <nav aria-label="Stronicowanie" class="mt-5">
            <ul class="pagination justify-content-center">
              <?php foreach ( $paginate_links as $link ) {
                // wrap default links in li.pagination-item (they already contain <a> or <span>)
                echo '<li class="page-item">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
              } ?>
            </ul>
          </nav>
      <?php endif; ?>

    <?php else: ?>
      <div class="row">
        <div class="col-12 text-center py-5">
          <p class="lead">Brak artykułów do wyświetlenia.</p>
        </div>
      </div>
    <?php endif; ?>

  </div> <!-- /.container -->
</section>

<?php get_footer(); ?>
