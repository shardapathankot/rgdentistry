<?php
// single-services.php

get_header(); // Include the header

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="single-service">
        <h1><?php the_title(); ?></h1>

        <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail('large');
        } ?>

        <div class="service-content">
            <?php the_content(); ?>
        </div>
    </div>

    <div class="service-navigation">
        <?php previous_post_link('%link', '« Previous Service'); ?>
        <?php next_post_link('%link', 'Next Service »'); ?>
    </div>

<?php endwhile; else : ?>

    <p>No service found</p>

<?php endif;

get_footer(); // Include the footer
