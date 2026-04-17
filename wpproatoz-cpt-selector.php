<?php
/**
 * Plugin Name:       WPProAtoZ CPT Selector for Elementor
 * Plugin URI:        https://wpproatoz.com
 * Description:       Select multiple Custom Post Types from a plugin settings page and display them as a linked list using the shortcode [cpt_list]. Links automatically use the custom Archive Slug set in ACF Post Types (URLs tab).
 * Version:           1.2.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            WPProAtoZ.com
 * Author URI:        https://wpproatoz.com
 * Text Domain:       wpproatoz-cpt-selector
 * Update URI:        https://github.com/Ahkonsu/wpproatoz-cpt-selector/releases
 * GitHub Plugin URI: https://github.com/Ahkonsu/wpproatoz-cpt-selector/releases
 * GitHub Branch:     main
 */
////***check for updates code

require 'plugin-update-checker-5.5/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

try {
    $myUpdateChecker = PucFactory::buildUpdateChecker(
        'https://github.com/Ahkonsu/wpproatoz-cpt-selector/',
        __FILE__,
        'wpproatoz-cpt-selector'
    );

    //Set the branch that contains the stable release.
    $myUpdateChecker->setBranch('main');

    //$myUpdateChecker->getVcsApi()->enableReleaseAssets();
    
    //Optional: If you're using a private repository, specify the access token like this:
    //$myUpdateChecker->setAuthentication('your-token-here');
////

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Add Settings page
 */
function wpproatoz_cpt_add_settings_page() {
    add_options_page(
        __( 'WPProAtoZ Custom Post Types List', 'wpproatoz-cpt-selector' ),
        __( 'WPProAtoZ CPT List', 'wpproatoz-cpt-selector' ),
        'manage_options',
        'wpproatoz-cpt-settings',
        'wpproatoz_cpt_render_settings_page'
    );
}
add_action( 'admin_menu', 'wpproatoz_cpt_add_settings_page' );

/**
 * Register setting
 */
function wpproatoz_cpt_register_settings() {
    register_setting( 'wpproatoz_cpt_settings_group', 'wpproatoz_selected_cpts' );
}
add_action( 'admin_init', 'wpproatoz_cpt_register_settings' );

/**
 * Render Settings Page
 */
function wpproatoz_cpt_render_settings_page() {
    $selected = get_option( 'wpproatoz_selected_cpts', array() );
    $post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        
        <form method="post" action="options.php">
            <?php
            settings_fields( 'wpproatoz_cpt_settings_group' );
            do_settings_sections( 'wpproatoz_cpt_settings_group' );
            ?>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="wpproatoz_selected_cpts"><?php _e( 'Select Custom Post Types', 'wpproatoz-cpt-selector' ); ?></label>
                    </th>
                    <td>
                        <select name="wpproatoz_selected_cpts[]" id="wpproatoz_selected_cpts" multiple="multiple" size="10" style="width: 400px;">
                            <?php foreach ( $post_types as $pt ) : ?>
                                <option value="<?php echo esc_attr( $pt->name ); ?>" 
                                    <?php echo in_array( $pt->name, (array) $selected ) ? 'selected' : ''; ?>>
                                    <?php echo esc_html( $pt->label . ' (' . $pt->name . ')' ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="description"><?php _e( 'Hold Ctrl (Windows) or Command (Mac) to select multiple.', 'wpproatoz-cpt-selector' ); ?></p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>

        <h2>Usage in Elementor</h2>
        <p>Use this shortcode in a Shortcode widget:</p>
        <code>[cpt_list]</code><br><br>
        <p><strong>Optional attributes:</strong> <code>[cpt_list class="my-list" wrapper="div"]</code></p>
    </div>
    <?php
}

/**
 * Add Settings link on Plugins page
 */
function wpproatoz_cpt_plugin_action_links( $links ) {
    $settings_link = '<a href="' . admin_url( 'options-general.php?page=wpproatoz-cpt-settings' ) . '">' . __( 'Settings', 'wpproatoz-cpt-selector' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wpproatoz_cpt_plugin_action_links' );

/**
 * Shortcode: [cpt_list]
 * Now automatically links to the archive using custom Archive Slug from ACF
 */
function wpproatoz_cpt_list_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'wrapper' => 'ul',
        'class'   => 'wpproatoz-cpt-list',
    ), $atts, 'cpt_list' );

    $selected = get_option( 'wpproatoz_selected_cpts', array() );

    if ( empty( $selected ) ) {
        return '<p>' . __( 'No custom post types selected yet.', 'wpproatoz-cpt-selector' ) . '</p>';
    }

    $output = '<' . esc_attr( $atts['wrapper'] ) . ' class="' . esc_attr( $atts['class'] ) . '">';

    foreach ( (array) $selected as $pt_slug ) {
        $post_type_obj = get_post_type_object( $pt_slug );
        if ( ! $post_type_obj ) {
            continue;
        }

        $name = $post_type_obj->label;

        // Get archive link - respects custom Archive Slug set in ACF Post Types > URLs
        $archive_url = get_post_type_archive_link( $pt_slug );

        if ( $archive_url ) {
            $output .= '<li><a href="' . esc_url( $archive_url ) . '">' . esc_html( $name ) . '</a></li>';
        } else {
            $output .= '<li>' . esc_html( $name ) . '</li>';
        }
    }

    $output .= '</' . esc_attr( $atts['wrapper'] ) . '>';

    return $output;
}
add_shortcode( 'cpt_list', 'wpproatoz_cpt_list_shortcode' );

/**
 * Default styling
 */
function wpproatoz_cpt_list_styles() {
    echo '<style>
        .wpproatoz-cpt-list { list-style: disc; padding-left: 1.5em; margin: 1em 0; }
        .wpproatoz-cpt-list li { margin-bottom: 0.6em; }
        .wpproatoz-cpt-list a { text-decoration: none; }
        .wpproatoz-cpt-list a:hover { text-decoration: underline; }
    </style>';
}
add_action( 'wp_head', 'wpproatoz_cpt_list_styles' );