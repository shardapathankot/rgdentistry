<?php
/*
 * This is the child theme for Hello Elementor theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles');
function hello_elementor_child_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
add_theme_support('post-thumbnails');
/*
 * Your code goes below
 */

// for Services 
function create_services_post_type()
{
    register_post_type(
        'services',
        array(
            'labels' => array(
                'name' => __('Services'),
                'singular_name' => __('Service')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'services'),
            'supports' => array('title', 'editor', 'thumbnail', 'template')
        )
    );
}
add_action('init', 'create_services_post_type');
function display_services_shortcode()
{
    $args = array(
        'post_type' => 'services',
        'posts_per_page' => -1
    );
    $services_query = new WP_Query($args);
    if ($services_query->have_posts()) {
        $output = '<div class="services">';
        while ($services_query->have_posts()) {
            $services_query->the_post();
            $output .= '<div class="service">';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';
            $output .= '<h2 class="title">' . get_the_title() . '</h2>';
            $content = wp_trim_words(get_the_content(), 20);
            $output .= '<div class="description">' . $content . '</div>';
            $output .= '<a href="' . get_permalink() . '" class="read-more-button">Read More &#10230;</a>';
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>No services found</p>';
    }
}
add_shortcode('display_services', 'display_services_shortcode');
// add_shortcode( 'display_services', 'display_services_shortcode' );

// function create_services_post_type()
// {
//     $labels = array(
//         'name'               => 'Services',
//         'singular_name'      => 'Service',
//         'menu_name'          => 'Services',
//         'name_admin_bar'     => 'Service',
//         'add_new'            => 'Add New',
//         'add_new_item'       => 'Add New Service',
//         'new_item'           => 'New Service',
//         'edit_item'          => 'Edit Service',
//         'view_item'          => 'View Service',
//         'all_items'          => 'All Services',
//         'search_items'       => 'Search Services',
//         'parent_item_colon'  => 'Parent Services:',
//         'not_found'          => 'No services found.',
//         'not_found_in_trash' => 'No services found in Trash.'
//     );

//     $args = array(
//         'labels'             => $labels,
//         'public'             => true,
//         'publicly_queryable' => true,
//         'show_ui'            => true,
//         'show_in_menu'       => true,
//         'query_var'          => true,
//         'rewrite'            => array('slug' => 'services'),
//         'capability_type'    => 'post',
//         'has_archive'        => true,
//         'hierarchical'       => false,
//         'menu_position'      => null,
//         'supports'           => array('title', 'editor', 'thumbnail')
//     );

//     register_post_type('services', $args);
// }

// function display_services_shortcode()
// {
//     $args = array(
//         'post_type' => 'services',
//         'posts_per_page' => -1
//     );
//     $services_query = new WP_Query($args);
//     if ($services_query->have_posts()) {
//         $output = '<div class="services">';
//         while ($services_query->have_posts()) {
//             $services_query->the_post();
//             $output .= '<div class="service">';
//             $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';
//             $output .= '<h2 class="title">' . get_the_title() . '</h2>';
//             $output .= '<div class="description">' . get_the_content() . '</div>';
//             $output .= '<a href="' . get_permalink() . '" class="read-more-button">Read More</a>';
//             $output .= '</div>';
//         }
//         $output .= '</div>';
//         wp_reset_postdata();
//         return $output;
//     } else {
//         return '<p>No services found</p>';
//     }
// }
// add_shortcode('display_services', 'display_services_shortcode');

// Register custom post type for Doctors
function create_doctors_post_type()
{
    register_post_type(
        'doctors',
        array(
            'labels' => array(
                'name' => __('Doctors'),
                'singular_name' => __('Doctor'),
                'add_new' => __('Add New Doctor'),
                'add_new_item' => __('Add New Doctor'),
                'edit_item' => __('Edit Doctor'),
                'new_item' => __('New Doctor'),
                'view_item' => __('View Doctor'),
                'search_items' => __('Search Doctors'),
                'not_found' => __('No doctors found'),
                'not_found_in_trash' => __('No doctors found in Trash'),
                'all_items' => __('All Doctors'),
                'menu_name' => __('Doctors'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'doctors'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'show_in_rest' => true, // Enable Gutenberg editor
        )
    );
}
add_action('init', 'create_doctors_post_type');

// Add meta boxes for Doctors
function add_doctors_meta_boxes()
{
    add_meta_box(
        'doctors_info',
        'Doctor Information',
        'display_doctors_meta_box',
        'doctors',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_doctors_meta_boxes');

// Display the meta box for Doctors
function display_doctors_meta_box($post)
{
    // Add nonce for security and authentication.
    wp_nonce_field('doctors_meta_box_nonce_action', 'doctors_meta_box_nonce');

    // Retrieve existing values from the database.
    $meta_values = get_post_meta($post->ID);
?>
    <table class="form-table">
        <tr>
            <th><label for="doctor_contact">Contact</label></th>
            <td><input type="text" name="doctor_contact" value="<?php echo esc_attr($meta_values['doctor_contact'][0] ?? ''); ?>" class="widefat"></td>
        </tr>
        <tr>
            <th><label for="doctor_email">Email</label></th>
            <td><input type="email" name="doctor_email" value="<?php echo esc_attr($meta_values['doctor_email'][0] ?? ''); ?>" class="widefat"></td>
        </tr>
        <tr>
            <th><label for="doctor_designation">Designation</label></th>
            <td><input type="text" name="doctor_designation" value="<?php echo esc_attr($meta_values['doctor_designation'][0] ?? ''); ?>" class="widefat"></td>
        </tr>
        <tr>
            <th><label for="doctor_summary">Professional Summary</label></th>
            <td><textarea name="doctor_summary" rows="5" class="widefat"><?php echo esc_textarea($meta_values['doctor_summary'][0] ?? ''); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="doctor_experience">Experience</label></th>
            <td><textarea name="doctor_experience" rows="5" class="widefat"><?php echo esc_textarea($meta_values['doctor_experience'][0] ?? ''); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="doctor_education">Education</label></th>
            <td><textarea name="doctor_education" rows="5" class="widefat"><?php echo esc_textarea($meta_values['doctor_education'][0] ?? ''); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="doctor_memberships">Memberships</label></th>
            <td><textarea name="doctor_memberships" rows="5" class="widefat"><?php echo esc_textarea($meta_values['doctor_memberships'][0] ?? ''); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="doctor_skills">Skills</label></th>
            <td><textarea name="doctor_skills" rows="5" class="widefat"><?php echo esc_textarea($meta_values['doctor_skills'][0] ?? ''); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="doctor_languages">Languages</label></th>
            <td><textarea name="doctor_languages" rows="5" class="widefat"><?php echo esc_textarea($meta_values['doctor_languages'][0] ?? ''); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="doctor_personal">Personal</label></th>
            <td><textarea name="doctor_personal" rows="5" class="widefat"><?php echo esc_textarea($meta_values['doctor_personal'][0] ?? ''); ?></textarea></td>
        </tr>
    </table>
    <?php
}

// Save the meta box data for Doctors
function save_doctors_meta_box($post_id)
{
    // Check if our nonce is set.
    if (!isset($_POST['doctors_meta_box_nonce'])) {
        return $post_id;
    }

    $nonce = $_POST['doctors_meta_box_nonce'];

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'doctors_meta_box_nonce_action')) {
        return $post_id;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check the user's permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Save the data
    $fields = [
        'doctor_contact' => 'sanitize_text_field',
        'doctor_email' => 'sanitize_email',
        'doctor_designation' => 'sanitize_text_field',
        'doctor_summary' => 'sanitize_textarea_field',
        'doctor_experience' => 'sanitize_textarea_field',
        'doctor_education' => 'sanitize_textarea_field',
        'doctor_memberships' => 'sanitize_textarea_field',
        'doctor_skills' => 'sanitize_textarea_field',
        'doctor_languages' => 'sanitize_textarea_field',
        'doctor_personal' => 'sanitize_textarea_field',
    ];

    foreach ($fields as $field => $sanitizer) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, call_user_func($sanitizer, $_POST[$field]));
        }
    }
}
add_action('save_post', 'save_doctors_meta_box');

// Shortcode to display Doctors
function display_doctors_shortcode()
{
    $args = array(
        'post_type' => 'doctors',
        'posts_per_page' => -1 // Display all doctors
    );
    $doctors_query = new WP_Query($args);
    if ($doctors_query->have_posts()) {
        $output = '<div class="doctors">';
        while ($doctors_query->have_posts()) {
            $doctors_query->the_post();
            // $contact = get_post_meta(get_the_ID(), 'doctor_contact', true);
            // $email = get_post_meta(get_the_ID(), 'doctor_email', true);
            $designation = get_post_meta(get_the_ID(), 'doctor_designation', true);
            // $summary = get_post_meta(get_the_ID(), 'doctor_summary', true);
            // $experience = get_post_meta(get_the_ID(), 'doctor_experience', true);
            // $education = get_post_meta(get_the_ID(), 'doctor_education', true);
            // $memberships = get_post_meta(get_the_ID(), 'doctor_memberships', true);
            // $skills = get_post_meta(get_the_ID(), 'doctor_skills', true);
            // $languages = get_post_meta(get_the_ID(), 'doctor_languages', true);
            // $personal = get_post_meta(get_the_ID(), 'doctor_personal', true);

            $output .= '<div class="doctor">';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';
            $output .= '<h2 class="name">' . get_the_title() . '</h2>';
            $output .= '<p class="designation">' . esc_html($designation) . '</p>';
            // $output .= '<p class="contact"><strong>Contact:</strong> ' . esc_html($contact) . '</p>';
            // // $output .= '<p class="email"><strong>Email:</strong> ' . esc_html($email) . '</p>';
            // // $output .= '<div class="summary"><strong>Professional Summary:</strong> ' . esc_html($summary) . '</div>';
            // // $output .= '<div class="experience"><strong>Experience:</strong> ' . esc_html($experience) . '</div>';
            // // $output .= '<div class="education"><strong>Education:</strong> ' . esc_html($education) . '</div>';
            // // $output .= '<div class="memberships"><strong>Memberships:</strong> ' . esc_html($memberships) . '</div>';
            // // $output .= '<div class="skills"><strong>Skills:</strong> ' . esc_html($skills) . '</div>';
            // // $output .= '<div class="languages"><strong>Languages:</strong> ' . esc_html($languages) . '</div>';
            // // $output .= '<div class="personal"><strong>Personal:</strong> ' . esc_html($personal) . '</div>';

            $output .= '<a href="' . get_permalink() . '" class="read-more-button">View Profile</a>';
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>No doctors found</p>';
    }
}
add_shortcode('display_doctors', 'display_doctors_shortcode');

function block_next_48_hours($args) {
    $today = current_time('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day', strtotime($today)));
    $day_after_tomorrow = date('Y-m-d', strtotime('+2 days', strtotime($today)));

    // Block the next 48 hours
    if ($args['start_date'] == $today || $args['start_date'] == $tomorrow || $args['start_date'] == $day_after_tomorrow) {
        return false; // Make these dates unavailable
    }
    
    return $args; // Allow all other dates
}
add_filter('wpbc_check_availability', 'block_next_48_hours', 10, 1);