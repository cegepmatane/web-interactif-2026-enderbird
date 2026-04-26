
<?php

/**
 * THEME SETUP (SEO + CORE WP)
 */
function mytheme_setup() {

    // SEO: title tag
    add_theme_support('title-tag');

    // Featured images
    add_theme_support('post-thumbnails');

    // Clean semantic HTML
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);

    // Logo support
    add_theme_support('custom-logo');

    // RSS feeds (SEO discovery)
    add_theme_support('automatic-feed-links');

    // Menus
    register_nav_menus([
        'primary' => 'Menu principal',
        'footer'  => 'Menu pied de page'
    ]);
}
add_action('after_setup_theme', 'mytheme_setup');


/**
 * LOAD ASSETS (CSS + JS)
 */
function mytheme_assets() {

    wp_enqueue_style(
        'mytheme-style',
        get_stylesheet_uri()
    );

    wp_enqueue_style(
        'mytheme-general',
        get_template_directory_uri() . '/decoration/css/general.css',
        [],
        filemtime(get_template_directory() . '/decoration/css/general.css')
    );

    wp_enqueue_script(
        'mytheme-js',
        get_template_directory_uri() . '/decoration/js/general.js',
        [],
        filemtime(get_template_directory() . '/decoration/js/general.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'mytheme_assets');


/**
 * SIDEBAR (widgets + SEO blocks)
 */
function mytheme_widgets() {

    register_sidebar([
        'name'          => 'Sidebar principale',
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'mytheme_widgets');


/**
 * EXCERPT SEO
 */
function mytheme_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'mytheme_excerpt_length');

function mytheme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'mytheme_excerpt_more');


/**
 * BODY CLASSES (CSS + SEO hooks)
 */
function mytheme_body_classes($classes) {

    if (is_singular()) {
        $classes[] = 'is-single';
    } else {
        $classes[] = 'is-archive';
    }

    return $classes;
}
add_filter('body_class', 'mytheme_body_classes');


/**
 * COMMENT CALLBACK (SAFE + CUSTOM DESIGN)
 */
function mytheme_comment_callback($comment, $args, $depth) { ?>

    <div <?php comment_class('comment-card'); ?> id="comment-<?php comment_ID(); ?>">

        <div class="comment-avatar">
            <?php echo get_avatar($comment, 45); ?>
        </div>

        <div class="comment-body">

            <div class="comment-author">
                <?php echo get_comment_author_link(); ?>
            </div>

            <div class="comment-text">
                <?php comment_text(); ?>
            </div>

            <div class="comment-meta">
                <?php echo get_comment_date('', $comment); ?>
            </div>

            <div class="comment-reply">
                <?php
                comment_reply_link([
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth']
                ]);
                ?>
            </div>

        </div>
    </div>

<?php }


function add_project_note_metabox() {
    add_meta_box(
        'project_note_box',
        'Project Note',
        'render_project_note_metabox',
        'post', // change to your CPT if needed
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_project_note_metabox');

function render_project_note_metabox($post) {

    $value = get_post_meta($post->ID, 'project_note', true);

    wp_nonce_field('project_note_save', 'project_note_nonce');

    echo '<textarea name="project_note" style="width:100%;height:100px;">' . esc_textarea($value) . '</textarea>';
}

function save_project_note($post_id) {

    if (!isset($_POST['project_note_nonce'])) return;

    if (!wp_verify_nonce($_POST['project_note_nonce'], 'project_note_save')) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (!isset($_POST['project_note'])) return;

    update_post_meta(
        $post_id,
        'project_note',
        sanitize_textarea_field($_POST['project_note'])
    );
}
add_action('save_post', 'save_project_note');


function disable_wp_emojis() {
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_wp_emojis');