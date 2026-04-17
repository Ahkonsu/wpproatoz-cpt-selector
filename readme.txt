/*
Plugin Name:       WPProAtoZ CPT Selector for Elementor
Plugin URI:        https://wpproatoz.com
Description:       Easily select multiple Custom Post Types from a dedicated settings page and display them as a clean, linked list using the shortcode [cpt_list]. Automatically respects the custom Archive Slug set in ACF Post Types (Advanced Configuration > URLs tab). Perfect for use with Elementor via the Shortcode widget.
Version:           1.2.0
Requires at least: 6.0
Requires PHP:      8.0
Author:            WPProAtoZ.com
Author URI:        https://wpproatoz.com
Text Domain:       wpproatoz-cpt-selector
Update URI:        https://github.com/Ahkonsu/wpproatoz-cpt-selector/releases
GitHub Plugin URI: https://github.com/Ahkonsu/wpproatoz-cpt-selector/releases
GitHub Branch:     main
*/

# WPProAtoZ CPT Selector for Elementor

## Description

**WPProAtoZ CPT Selector for Elementor** is a lightweight and user-friendly WordPress plugin that lets you select any number of Custom Post Types from a central settings page and display them as a beautiful linked list on any page.

It works seamlessly with **Elementor** (using the Shortcode widget) and fully supports **Advanced Custom Fields (ACF) Post Types**. The plugin automatically links each post type name to its archive page, using the **custom Archive Slug** you set in ACF (under Advanced Configuration → URLs tab).

Ideal for directory sites, portfolio showcases, service listings, or any site that needs a quick navigation list of custom post type archives.

## Features

- **Dedicated Settings Page** – Select multiple Custom Post Types from one clean admin screen (no more per-page metaboxes).
- **Settings Link** on the Plugins page for quick access.
- **Automatic Archive Linking** – Uses the custom **Archive Slug** defined in ACF Post Types (respects `has_archive` and rewrite rules).
- **Shortcode Support** – Simple `[cpt_list]` shortcode, fully compatible with Elementor.
- **Customizable Output** – Change wrapper (`ul`/`div`) and add your own CSS class via shortcode attributes.
- **Lightweight & Clean** – No unnecessary assets or bloat. Includes subtle default styling.
- **ACF Compatible** – Works whether you created CPTs with ACF, CPT UI, or code.

## Installation

1. Upload the `wpproatoz-cpt-selector` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** screen in WordPress.
3. Go to **Settings → WPProAtoZ CPT List** to configure which custom post types to display.
4. Use the shortcode `[cpt_list]` anywhere (especially inside Elementor Shortcode widget).

## Requirements

- WordPress 6.0 or higher
- PHP 8.0 or higher
- **Advanced Custom Fields** (Free or Pro) – Recommended for full Archive Slug support
- Custom Post Types (created via ACF Post Types, CPT UI, or code)

## Usage

### Configuring the Plugin

1. After activation, go to **Settings → WPProAtoZ CPT List**.
2. Select the Custom Post Types you want to display (hold **Ctrl** / **Command** to select multiple).
3. Click **Save Changes**.

### Displaying the List

Use this shortcode in any page, post, or **Elementor Shortcode widget**:

### shortcode
[cpt_list]
[cpt_list wrapper="ul" class="my-custom-cpt-list"]
[cpt_list wrapper="div" class="cpt-grid"]
wrapper → ul (default) or div
class → Add your own CSS class for custom styling

Each post type name will automatically link to its archive page using the custom Archive Slug set in ACF.
Important: After changing any Archive Slug in ACF, go to Settings → Permalinks and click Save Changes to flush rewrite rules.

### Screenshots

Plugin Settings Page – Select multiple custom post types from a clean, user-friendly interface.<img src="screenshot-1.png" alt="WPProAtoZ CPT Selector Settings">
Shortcode in Elementor – Adding the [cpt_list] shortcode using Elementor’s Shortcode widget.<img src="screenshot-2.png" alt="Shortcode in Elementor">
Frontend Display – Example of the linked custom post types list on the front end.<img src="screenshot-3.png" alt="Frontend CPT List">

### Changelog

1.2.0 – April 2026

New: Automatic linking to custom post type archive pages.
Now respects the Archive Slug set in ACF Post Types → Advanced Configuration → URLs tab.
Falls back gracefully to default get_post_type_archive_link() when no custom slug is set.
Improved shortcode output with proper escaping and link handling.
Updated plugin description and documentation.

1.1.0

Converted from per-page ACF metabox to a dedicated plugin settings page.
Added "Settings" link directly on the Plugins screen.
Cleaner admin interface with better instructions.
Shortcode now pulls from centralized plugin option.

1.0.0

Initial release.
ACF field group for selecting post types per page.
Basic shortcode [cpt_list] with support for custom class and wrapper.
Default styling for unordered lists.

Support
For questions, suggestions, or issues, please contact support@wpproatoz.com or open an issue on the GitHub repository.
Credits

Built with the assistance of Grok AI by xAI.
Uses WordPress core functions (get_post_type_object(), get_post_type_archive_link()).
Designed for seamless integration with Advanced Custom Fields Post Types feature.

License
This plugin is licensed under the GPL v2 or later.
For more information, see GNU General Public License.



