<style type="text/css">
    .row_product {
    display: flex;
    flex-wrap: wrap;
    margin-top: 3rem;
    margin-right: 3rem;
    margin-left: 3rem;
}
.row_product .col {
    flex: 0 0 auto;
    width: 33.33333%;
    max-width: 100%;
    padding-right: 0rem;
    padding-left: 0rem;
    padding-top: 0rem;
}
.row_product .col article {
    padding-right: 2rem;
    padding-left: 2rem;
    padding-top: 2rem;
}
.row_product .col article img {
    width: 100%;
    height: 325px;
    object-fit: cover;
}
</style>

<?php
/*
Template Name: Services Page
*/
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="services">
            <div class="row_product"> <!-- Start the initial row -->
                <?php
                $args = array(
                    'post_type' => 'services',
                    'posts_per_page' => -1
                );
                $services_query = new WP_Query( $args );

                $count = 0;
                while ( $services_query->have_posts() ) {
                    $services_query->the_post();
                    if ($count % 3 == 0 && $count != 0) {
                        echo ''; // Close the previous row and start a new row after every 3 services
                    }
                    ?>
                    <div class="col"> <!-- Start a new column for each service -->
                        <article id="post-<?php the_ID(); ?>" <?php post_class('service'); ?>>
                            <div class="entry-content">
                                <?php the_post_thumbnail(); ?>
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </header>
                            </div>
                        </article>
                    </div>
                    <?php
                    $count++;
                }
                wp_reset_postdata();

                // Close the final row if the total number of services is not divisible by 3
                if ($count % 3 != 0) {
                    echo '';
                }
                ?>
            </div> <!-- Close the final row -->
        </section>
    </main>
</div>
<?php get_footer(); ?>
