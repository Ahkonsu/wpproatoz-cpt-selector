<?php
/**
 * Plugin Name: WPProAtoZ CPT Selector for Elementor
 * Plugin URI: https://wpproatoz.com
 * Description: Select multiple Custom Post Types and display them as a fully styled linked list using the shortcode [cpt_list]. Supports ACF custom Archive Slugs with rich admin styling controls.
 * Version: 1.2.5
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * Author: WPProAtoZ.com
 * Author URI: https://wpproatoz.com
 * Text Domain: wpproatoz-cpt-selector
 * Update URI: https://github.com/Ahkonsu/wpproatoz-cpt-selector/releases
 * GitHub Plugin URI: https://github.com/Ahkonsu/wpproatoz-cpt-selector/releases
 * GitHub Branch: main
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/* === Plugin Update Checker === */
if ( ! class_exists( 'YahnisElsts\PluginUpdateChecker\v5\PucFactory' ) ) {
    require_once __DIR__ . '/plugin-update-checker/plugin-update-checker.php';
}
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/Ahkonsu/wpproatoz-cpt-selector/',
    __FILE__,
    'wpproatoz-cpt-selector'
);
$myUpdateChecker->setBranch('main');

/* === Register Settings === */
function wpproatoz_cpt_register_settings() {
    register_setting( 'wpproatoz_cpt_settings_group', 'wpproatoz_selected_cpts' );
    register_setting( 'wpproatoz_cpt_settings_group', 'wpproatoz_cpt_styles' );
}
add_action( 'admin_init', 'wpproatoz_cpt_register_settings' );

/* === Add Settings Page === */
function wpproatoz_cpt_add_settings_page() {
    add_options_page(
        __( 'WPProAtoZ CPT List', 'wpproatoz-cpt-selector' ),
        __( 'WPProAtoZ CPT List', 'wpproatoz-cpt-selector' ),
        'manage_options',
        'wpproatoz-cpt-settings',
        'wpproatoz_cpt_render_settings_page'
    );
}
add_action( 'admin_menu', 'wpproatoz_cpt_add_settings_page' );

/* === Enqueue Color Picker === */
function wpproatoz_cpt_enqueue_color_picker( $hook ) {
    if ( 'settings_page_wpproatoz-cpt-settings' !== $hook ) {
        return;
    }
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_add_inline_script( 'wp-color-picker', '
        jQuery(document).ready(function($){
            $(".wpproatoz-color-picker").wpColorPicker();
        });
    ');
}
add_action( 'admin_enqueue_scripts', 'wpproatoz_cpt_enqueue_color_picker' );

/* === Render Settings Page === */
function wpproatoz_cpt_render_settings_page() {
    $selected = get_option( 'wpproatoz_selected_cpts', array() );
    $styles   = get_option( 'wpproatoz_cpt_styles', array() );
    $post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );

    $active_tab = isset($_GET['tab']) && $_GET['tab'] === 'style' ? 'style' : 'general';
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

        <h2 class="nav-tab-wrapper">
            <a href="?page=wpproatoz-cpt-settings&tab=general" class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>">General</a>
            <a href="?page=wpproatoz-cpt-settings&tab=style"   class="nav-tab <?php echo $active_tab === 'style'   ? 'nav-tab-active' : ''; ?>">Styling</a>
        </h2>

        <form method="post" action="options.php">
            <?php settings_fields( 'wpproatoz_cpt_settings_group' ); ?>

            <?php if ( $active_tab === 'general' ) : ?>

                <!-- General Tab -->
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="wpproatoz_selected_cpts">Select Custom Post Types</label></th>
                        <td>
                            <select name="wpproatoz_selected_cpts[]" id="wpproatoz_selected_cpts" multiple="multiple" size="12" style="width: 500px;">
                                <?php foreach ( $post_types as $pt ) : ?>
                                    <option value="<?php echo esc_attr( $pt->name ); ?>" <?php echo in_array( $pt->name, (array) $selected ) ? 'selected' : ''; ?>>
                                        <?php echo esc_html( $pt->label . ' (' . $pt->name . ')' ); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="description">Hold Ctrl (Windows) or Command (Mac) to select multiple.</p>
                        </td>
                    </tr>
                </table>

                <!-- Preserve Styling -->
                <?php foreach ( $styles as $key => $value ) : ?>
                    <input type="hidden" name="wpproatoz_cpt_styles[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>">
                <?php endforeach; ?>

            <?php else : ?>

                <!-- Styling Tab -->
                <table class="form-table">
                    <tr>
                        <th>List Style</th>
                        <td>
                            <select name="wpproatoz_cpt_styles[list_style]">
                                <option value="disc"   <?php selected( $styles['list_style'] ?? 'disc', 'disc' ); ?>>Disc</option>
                                <option value="circle" <?php selected( $styles['list_style'] ?? 'disc', 'circle' ); ?>>Circle</option>
                                <option value="square" <?php selected( $styles['list_style'] ?? 'disc', 'square' ); ?>>Square</option>
                                <option value="none"   <?php selected( $styles['list_style'] ?? 'disc', 'none' ); ?>>None</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Font Size (px)</th>
                        <td><input type="number" name="wpproatoz_cpt_styles[font_size]" value="<?php echo esc_attr( $styles['font_size'] ?? '16' ); ?>" min="10" max="36"> px</td>
                    </tr>

                    <tr><th colspan="2"><hr><strong>Box Styling (Container)</strong></th></tr>
                    <tr>
                        <th>Background Color</th>
                        <td><input type="text" name="wpproatoz_cpt_styles[background_color]" value="<?php echo esc_attr( $styles['background_color'] ?? 'transparent' ); ?>" class="wpproatoz-color-picker" /></td>
                    </tr>
                    <tr>
                        <th>Padding (inside)</th>
                        <td><input type="number" name="wpproatoz_cpt_styles[padding]" value="<?php echo esc_attr( $styles['padding'] ?? '20' ); ?>" min="0" max="100"> px</td>
                    </tr>
                    <tr>
                        <th>Margin (outside)</th>
                        <td><input type="number" name="wpproatoz_cpt_styles[margin]" value="<?php echo esc_attr( $styles['margin'] ?? '1.5' ); ?>" step="0.1" min="0" max="5"> em</td>
                    </tr>
                    <tr>
                        <th>Border Color</th>
                        <td><input type="text" name="wpproatoz_cpt_styles[border_color]" value="<?php echo esc_attr( $styles['border_color'] ?? '#dddddd' ); ?>" class="wpproatoz-color-picker" /></td>
                    </tr>
                    <tr>
                        <th>Border Style</th>
                        <td>
                            <select name="wpproatoz_cpt_styles[border_style]">
                                <option value="solid"  <?php selected( $styles['border_style'] ?? 'solid', 'solid' ); ?>>Solid</option>
                                <option value="dashed" <?php selected( $styles['border_style'] ?? 'solid', 'dashed' ); ?>>Dashed</option>
                                <option value="dotted" <?php selected( $styles['border_style'] ?? 'solid', 'dotted' ); ?>>Dotted</option>
                                <option value="none"   <?php selected( $styles['border_style'] ?? 'solid', 'none' ); ?>>None</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Border Width</th>
                        <td><input type="number" name="wpproatoz_cpt_styles[border_width]" value="<?php echo esc_attr( $styles['border_width'] ?? '1' ); ?>" min="0" max="20"> px</td>
                    </tr>
                    <tr>
                        <th>Border Radius</th>
                        <td><input type="number" name="wpproatoz_cpt_styles[border_radius]" value="<?php echo esc_attr( $styles['border_radius'] ?? '6' ); ?>" min="0" max="50"> px</td>
                    </tr>

                    <tr><th colspan="2"><hr><strong>Link Styling</strong></th></tr>
                    <tr>
                        <th>Link Color</th>
                        <td><input type="text" name="wpproatoz_cpt_styles[link_color]" value="<?php echo esc_attr( $styles['link_color'] ?? '#0066cc' ); ?>" class="wpproatoz-color-picker" /></td>
                    </tr>
                    <tr>
                        <th>Hover Color</th>
                        <td><input type="text" name="wpproatoz_cpt_styles[hover_color]" value="<?php echo esc_attr( $styles['hover_color'] ?? '#ff6600' ); ?>" class="wpproatoz-color-picker" /></td>
                    </tr>
                    <tr>
                        <th>Line Spacing (em)</th>
                        <td><input type="number" step="0.1" name="wpproatoz_cpt_styles[line_height]" value="<?php echo esc_attr( $styles['line_height'] ?? '1.6' ); ?>" min="1" max="3"></td>
                    </tr>

                    <tr>
                        <th>Custom CSS (advanced)</th>
                        <td>
                            <textarea name="wpproatoz_cpt_styles[custom_css]" rows="6" style="width:100%; max-width:700px; font-family:monospace;"><?php echo esc_textarea( $styles['custom_css'] ?? '' ); ?></textarea>
                            <p class="description">Extra CSS targeting <code>.wpproatoz-cpt-list</code></p>
                        </td>
                    </tr>
                </table>

                <!-- Preserve Selected CPTs -->
                <?php foreach ( (array) $selected as $cpt ) : ?>
                    <input type="hidden" name="wpproatoz_selected_cpts[]" value="<?php echo esc_attr($cpt); ?>">
                <?php endforeach; ?>

            <?php endif; ?>

            <?php submit_button(); ?>
        </form>

        <h2>Usage</h2>
        <p><code>[cpt_list]</code> or <code>[cpt_list class="my-list" wrapper="div"]</code></p>
    </div>
    <?php
}

/* === Shortcode === */
function wpproatoz_cpt_list_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'wrapper' => 'ul',
        'class'   => 'wpproatoz-cpt-list',
    ), $atts, 'cpt_list' );

    $selected = get_option( 'wpproatoz_selected_cpts', array() );
    if ( empty( $selected ) ) {
        return '<p>No custom post types selected yet.</p>';
    }

    $output = '<' . esc_attr( $atts['wrapper'] ) . ' class="' . esc_attr( $atts['class'] ) . '">';

    foreach ( (array) $selected as $pt_slug ) {
        $post_type_obj = get_post_type_object( $pt_slug );
        if ( ! $post_type_obj ) continue;

        $archive_url = get_post_type_archive_link( $pt_slug );
        $name = $post_type_obj->label;

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

/* === Dynamic Styles === */
function wpproatoz_cpt_output_styles() {
    $styles = get_option( 'wpproatoz_cpt_styles', array() );

    $list_style     = sanitize_text_field( $styles['list_style'] ?? 'disc' );
    $font_size      = absint( $styles['font_size'] ?? 16 );
    $padding        = absint( $styles['padding'] ?? 20 );
    $margin         = floatval( $styles['margin'] ?? 1.5 );
    $background     = sanitize_hex_color( $styles['background_color'] ?? 'transparent' );
    $border_color   = sanitize_hex_color( $styles['border_color'] ?? '#dddddd' );
    $border_style   = sanitize_text_field( $styles['border_style'] ?? 'solid' );
    $border_width   = absint( $styles['border_width'] ?? 1 );
    $border_radius  = absint( $styles['border_radius'] ?? 6 );
    $link_color     = sanitize_hex_color( $styles['link_color'] ?? '#0066cc' );
    $hover_color    = sanitize_hex_color( $styles['hover_color'] ?? '#ff6600' );
    $line_height    = floatval( $styles['line_height'] ?? 1.6 );
    $custom_css     = wp_kses_post( $styles['custom_css'] ?? '' );

    echo '<style id="wpproatoz-cpt-styles">
        .wpproatoz-cpt-list {
            list-style: ' . esc_attr( $list_style ) . ';
            padding: ' . $padding . 'px;
            margin: ' . $margin . 'em 0;
            font-size: ' . $font_size . 'px;
            line-height: ' . $line_height . ';
            background-color: ' . esc_attr( $background ) . ';
            border: ' . $border_width . 'px ' . esc_attr( $border_style ) . ' ' . esc_attr( $border_color ) . ';
            border-radius: ' . $border_radius . 'px;
        }
        .wpproatoz-cpt-list li {
            margin-bottom: 0.8em;
        }
        .wpproatoz-cpt-list a {
            color: ' . $link_color . ';
            text-decoration: none;
        }
        .wpproatoz-cpt-list a:hover {
            color: ' . $hover_color . ';
            text-decoration: underline;
        }
        ' . $custom_css . '
    </style>';
}
add_action( 'wp_head', 'wpproatoz_cpt_output_styles' );

/* === Plugin Action Links === */
function wpproatoz_cpt_plugin_action_links( $links ) {
    $settings_link = '<a href="' . admin_url( 'options-general.php?page=wpproatoz-cpt-settings' ) . '">Settings</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wpproatoz_cpt_plugin_action_links' );