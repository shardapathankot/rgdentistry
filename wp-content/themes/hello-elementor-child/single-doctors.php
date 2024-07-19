<?php get_header(); ?>

<div class="doctor-detail">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            // Display the post thumbnail
            if (has_post_thumbnail()) {
                the_post_thumbnail('large');
            }
            
            // Display the title
            echo '<h1>' . get_the_title() . '</h1>';
            
            // Retrieve and display custom meta fields
            $contact = get_post_meta(get_the_ID(), 'doctor_contact', true);
            $email = get_post_meta(get_the_ID(), 'doctor_email', true);
            $designation = get_post_meta(get_the_ID(), 'doctor_designation', true);
            $summary = get_post_meta(get_the_ID(), 'doctor_summary', true);
            $experience = get_post_meta(get_the_ID(), 'doctor_experience', true);
            $education = get_post_meta(get_the_ID(), 'doctor_education', true);
            $memberships = get_post_meta(get_the_ID(), 'doctor_memberships', true);
            $skills = get_post_meta(get_the_ID(), 'doctor_skills', true);
            $languages = get_post_meta(get_the_ID(), 'doctor_languages', true);
            $personal = get_post_meta(get_the_ID(), 'doctor_personal', true);

            echo '<p><strong>Designation:</strong> ' . esc_html($designation) . '</p>';
            echo '<p><strong>Contact:</strong> ' . esc_html($contact) . '</p>';
            echo '<p><strong>Email:</strong> ' . esc_html($email) . '</p>';
            echo '<div><strong>Professional Summary:</strong> ' . wpautop(esc_html($summary)) . '</div>';
            echo '<div><strong>Experience:</strong> ' . wpautop(esc_html($experience)) . '</div>';
            echo '<div><strong>Education:</strong> ' . wpautop(esc_html($education)) . '</div>';
            echo '<div><strong>Memberships:</strong> ' . wpautop(esc_html($memberships)) . '</div>';
            echo '<div><strong>Skills:</strong> ' . wpautop(esc_html($skills)) . '</div>';
            echo '<div><strong>Languages:</strong> ' . wpautop(esc_html($languages)) . '</div>';
            echo '<div><strong>Personal:</strong> ' . wpautop(esc_html($personal)) . '</div>';
        endwhile;
    else :
        echo '<p>No doctor details found.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
