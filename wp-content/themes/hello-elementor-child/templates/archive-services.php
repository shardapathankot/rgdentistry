<?php
// archive-services.php

get_header(); // Include the header

if ( have_posts() ) : ?>

    <div class="services-list">
        <h1>Our Services</h1>

        <?php
        while ( have_posts() ) : the_post(); ?>
            <div class="service-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail();
                    } ?>
                </a>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="service-excerpt"><?php the_excerpt(); ?></div>
                <a href="<?php the_permalink(); ?>" class="read-more">Read More &#10230;</a>
            </div>
        <?php endwhile; ?>

    </div>

    <?php
    // Pagination
    the_posts_pagination();

else : ?>

    <p>No services found</p>

<?php endif;

get_footer(); // Include the footer
