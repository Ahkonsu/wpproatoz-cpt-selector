/*
Plugin Name: WPProAtoZ CPT Selector for Elementor
Plugin URI: https://wpproatoz.com
Description: Select multiple Custom Post Types and display them as a fully styled linked list using [cpt_list]. Features a powerful Styling tab with colors, borders, padding, margin, and more. Perfect for Elementor.
Version: 1.2.5
Requires at least: 6.0
Requires PHP: 8.0
Author: WPProAtoZ.com
Author URI: https://wpproatoz.com
Text Domain: wpproatoz-cpt-selector
Update URI: https://github.com/Ahkonsu/wpproatoz-cpt-selector/releases
GitHub Plugin URI: https://github.com/Ahkonsu/wpproatoz-cpt-selector/releases
GitHub Branch: main
*/

# WPProAtoZ CPT Selector for Elementor

## Description
**WPProAtoZ CPT Selector for Elementor** is a lightweight yet powerful WordPress plugin that lets you select any number of Custom Post Types from a central settings page and display them as a beautiful, fully customizable linked list.

It works seamlessly with **Elementor** (via the Shortcode widget) and fully supports **Advanced Custom Fields (ACF) Post Types**. Links automatically use the custom Archive Slug set in ACF.

Now includes a comprehensive **Styling tab** so you can control colors, borders, spacing, and more directly from the admin dashboard — no extra CSS needed!

Ideal for directory sites, portfolio showcases, service listings, or any site that needs a clean navigation list of custom post type archives.

## Features
- **Dedicated Settings Page** with two tabs: **General** and **Styling**
- **Rich Styling Options**:
  - Background Color
  - Border (Color, Style, Width, Radius)
  - Padding (inside) & Margin (outside)
  - Font Size, Line Spacing, Link & Hover Colors
  - List Style (disc, circle, square, none)
  - Custom CSS field for advanced users
- **Automatic Archive Linking** – Respects custom Archive Slug from ACF Post Types
- **Shortcode Support** – `[cpt_list]` fully compatible with Elementor
- **Customizable Output** – Change wrapper (`ul`/`div`) and add your own CSS class
- **Settings Link** directly on the Plugins page
- **Lightweight & Clean** – No bloat, loads only what’s needed
- **ACF Compatible** – Works with ACF, CPT UI, or manually coded post types

## Installation
1. Upload the `wpproatoz-cpt-selector` folder to `/wp-content/plugins/`
2. Activate the plugin through the WordPress Plugins screen
3. Go to **Settings → WPProAtoZ CPT List** to select your post types and customize styling
4. Use the shortcode `[cpt_list]` anywhere (especially in Elementor)

## Requirements
- WordPress 6.0 or higher
- PHP 8.0 or higher
- **Advanced Custom Fields** (Free or Pro) – Recommended for full Archive Slug support
- Custom Post Types (created via any method)

## Usage

### Configuring the Plugin
1. Go to **Settings → WPProAtoZ CPT List**
2. On the **General** tab, select the Custom Post Types you want to display
3. Switch to the **Styling** tab to customize appearance
4. Click **Save Changes**

### Shortcode
```shortcode
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

1.2.5 – April 24, 2026

Major update: Added full Styling tab in admin dashboard
New styling options: Background, Border (color/style/width/radius), Padding, Margin, Font Size, Line Spacing, Link/Hover colors, and Custom CSS
Improved admin interface with proper tab handling and cross-tab saving
Enhanced dynamic CSS output with better sanitization
Updated plugin description and documentation

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



