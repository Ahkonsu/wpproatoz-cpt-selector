# WPProAtoZ CPT Selector for Elementor

![Plugin Version](https://img.shields.io/badge/version-1.2.0-blue)
![WordPress Compatibility](https://img.shields.io/badge/WordPress-6.0%2B-green)
![PHP Compatibility](https://img.shields.io/badge/PHP-8.0%2B-green)
![License](https://img.shields.io/badge/license-GPLv2%2B-blue)

A lightweight WordPress plugin that lets you select multiple Custom Post Types from a central settings page and display them as a clean, automatically linked list using a simple shortcode. Fully compatible with Elementor and respects custom Archive Slugs set in ACF Post Types.

## Overview

**WPProAtoZ CPT Selector for Elementor** provides an easy way to create a navigation list of your custom post type archives.  

Select any number of Custom Post Types once in the plugin settings, and display a linked list anywhere on your site — especially useful inside **Elementor** using the Shortcode widget.  

The plugin automatically links each post type name to its archive page, using the **custom Archive Slug** you configure in **ACF > Post Types > Advanced Configuration > URLs tab**.

## Features
- Dedicated Settings page with **General** and **Styling** tabs
- Full visual styling controls (colors, borders, padding, margin, etc.)
- WordPress Color Picker with manual hex input
- **Dedicated Settings Page** — Select multiple Custom Post Types from one clean admin screen (no per-page metaboxes).
- **Settings Link** on the Plugins page for quick access.
- **Automatic Archive Linking** — Fully respects the custom **Archive Slug** set in ACF Post Types.
- **Elementor Ready** — Works perfectly with the Elementor Shortcode widget.
- **Flexible Shortcode** — Simple `[cpt_list]` with options for wrapper and custom CSS class.
- **Lightweight & Clean** — Minimal code, subtle default styling, no bloat.
- **ACF Compatible** — Works whether your CPTs were created with ACF Post Types, CPT UI, or code.

Shortcode: `[cpt_list]`

## Installation

1. Upload the `wpproatoz-cpt-selector` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** screen in WordPress.
3. Go to **Settings → WPProAtoZ CPT List** to select your desired Custom Post Types.
4. Add the shortcode `[cpt_list]` to any page or Elementor Shortcode widget.

## Usage

### Configuring the Plugin
- Navigate to **Settings → WPProAtoZ CPT List**.
- Select the Custom Post Types you want to display (hold **Ctrl** / **Command** to select multiple).
- Click **Save Changes**.

### Displaying the List
Add the following shortcode to any page or inside an Elementor Shortcode widget:

### shortcode
[cpt_list]
[cpt_list wrapper="ul" class="my-custom-cpt-list"]
[cpt_list wrapper="div" class="cpt-grid"]

Important Tip: After changing any Archive Slug in ACF, go to Settings → Permalinks and click Save Changes to flush rewrite rules.
Screenshots

Plugin Settings Page – Select multiple custom post types from a clean interface.<img src="screenshot-1.png" alt="Plugin Settings">
Shortcode in Elementor – Adding the shortcode using Elementor’s Shortcode widget.<img src="screenshot-2.png" alt="Elementor Shortcode">
Frontend Display – Example of the linked custom post types list on the front end.<img src="screenshot-3.png" alt="Frontend List">

### Requirements

WordPress 6.0+
PHP 8.0+
Advanced Custom Fields (Free or Pro) – Recommended for custom Archive Slug support
Custom Post Types (created via ACF, CPT UI, or manually)

### Changelog


**1.2.5 – April 24, 2026**
- Added comprehensive styling panel with tabs (General + Styling)
- New styling options:
  - Background Color
  - Padding (inside)
  - Margin (outside)
  - Border Color, Style, Width, and Radius
  - Font Size, Line Spacing, Link & Hover Colors
  - Custom CSS field
- Improved admin interface with proper cross-tab saving
- Enhanced default styles and sanitization
- Updated plugin description and documentation

**1.2.0 – April 2026**
- Automatic linking to custom post type archive pages (ACF Archive Slug support)
- Improved shortcode output and escaping

**1.1.0**
- Converted to dedicated plugin settings page
- Added Settings link on Plugins page

**1.0.0**
- Initial release

### Support
For questions, feature requests, or issues, please contact support@wpproatoz.com or open an issue on the GitHub repository.
Credits

Built with the assistance of Grok AI by xAI.
Uses WordPress core functions for reliable archive linking.

### License
This plugin is licensed under GPLv2 or later.
For more information, see GNU General Public License.
Contributing
Fork, branch, and submit Pull Requests — contributions are welcome!
Report issues on the GitHub repository.
