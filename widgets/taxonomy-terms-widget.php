<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPProAtoZ_Taxonomy_Terms_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'wpproatoz_taxonomy_terms';
    }

    public function get_title() {
        return __( 'Taxonomy Terms List (WPProAtoZ)', 'wpproatoz-cpt-selector' );
    }

    public function get_icon() {
        return 'eicon-folder-o';
    }

    public function get_categories() {
        return [ 'wpproatoz' ];
    }

    public function get_keywords() {
        return [ 'taxonomy', 'terms', 'categories', 'tags', 'list' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [ 'label' => __( 'Content', 'wpproatoz-cpt-selector' ) ]
        );

        $taxonomies = get_taxonomies( ['public' => true], 'objects' );
        $tax_options = [];
        foreach ( $taxonomies as $tax ) {
            $tax_options[$tax->name] = $tax->label . ' (' . $tax->name . ')';
        }

        $this->add_control(
            'selected_taxonomies',
            [
                'label'       => __( 'Select Taxonomies', 'wpproatoz-cpt-selector' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $tax_options,
                'multiple'    => true,
                'default'     => ['category'],
                'label_block' => true,
            ]
        );

        $post_types = get_post_types( ['public' => true, '_builtin' => false], 'objects' );
        $cpt_options = [];
        foreach ( $post_types as $pt ) {
            $cpt_options[$pt->name] = $pt->label;
        }

        $this->add_control(
            'filter_by_cpt',
            [
                'label'       => __( 'Filter Terms by Post Type (Optional)', 'wpproatoz-cpt-selector' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $cpt_options,
                'multiple'    => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wrapper',
            [
                'label'   => __( 'Wrapper', 'wpproatoz-cpt-selector' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'ul',
                'options' => [
                    'ul'  => __( 'Unordered List', 'wpproatoz-cpt-selector' ),
                    'div' => __( 'Div Container', 'wpproatoz-cpt-selector' ),
                ],
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'label'       => __( 'Additional CSS Class', 'wpproatoz-cpt-selector' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => 'my-taxonomy-list',
            ]
        );

        $this->end_controls_section();

        // Box Styling
        $this->start_controls_section(
            'section_style_box',
            [
                'label' => __( 'Box Styling', 'wpproatoz-cpt-selector' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __( 'Background Color', 'wpproatoz-cpt-selector' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => 'transparent',
                'global'    => [ 'active' => true ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label'      => __( 'Padding', 'wpproatoz-cpt-selector' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
                'default'    => [ 'size' => 20 ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label'      => __( 'Margin (Top & Bottom)', 'wpproatoz-cpt-selector' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'em' ],
                'range'      => [ 'em' => [ 'min' => 0, 'max' => 5, 'step' => 0.1 ] ],
                'default'    => [ 'size' => 1.5 ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .wpproatoz-taxonomy-terms-list',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => __( 'Border Radius', 'wpproatoz-cpt-selector' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
                'default'    => [ 'size' => 6 ],
            ]
        );

        $this->end_controls_section();

        // Link Styling
        $this->start_controls_section(
            'section_style_links',
            [
                'label' => __( 'Link Styling', 'wpproatoz-cpt-selector' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => __( 'Link Color', 'wpproatoz-cpt-selector' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#0066cc',
                'global'    => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label'     => __( 'Hover Color', 'wpproatoz-cpt-selector' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ff6600',
                'global'    => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'font_size',
            [
                'label'      => __( 'Font Size', 'wpproatoz-cpt-selector' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 10, 'max' => 36 ] ],
                'default'    => [ 'size' => 16 ],
            ]
        );

        $this->add_control(
            'line_height',
            [
                'label'      => __( 'Line Height', 'wpproatoz-cpt-selector' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'em' ],
                'range'      => [ 'em' => [ 'min' => 1, 'max' => 3, 'step' => 0.1 ] ],
                'default'    => [ 'size' => 1.6 ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $unique_class = 'wpproatoz-tax-terms-' . $this->get_id();

        $classes = ['wpproatoz-taxonomy-terms-list', $unique_class];
        if ( ! empty( $settings['custom_class'] ) ) {
            $classes[] = $settings['custom_class'];
        }

        $output = '<' . esc_attr( $settings['wrapper'] ?? 'ul' ) . ' class="' . esc_attr( implode( ' ', $classes ) ) . '">';

        $taxonomies = (array) ($settings['selected_taxonomies'] ?? ['category']);

        foreach ( $taxonomies as $taxonomy ) {
            $args = [
                'taxonomy'   => $taxonomy,
                'hide_empty' => true,
                'orderby'    => 'name',
                'order'      => 'ASC',
            ];

            if ( ! empty( $settings['filter_by_cpt'] ) ) {
                $args['object_type'] = $settings['filter_by_cpt'];
            }

            $terms = get_terms( $args );

            if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
                foreach ( $terms as $term ) {
                    $term_link = get_term_link( $term );
                    $output .= '<li><a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a></li>';
                }
            }
        }

        $output .= '</' . esc_attr( $settings['wrapper'] ?? 'ul' ) . '>';

        // Global Color Support
        $bg_color    = $settings['background_color'] ?? 'transparent';
        $link_color  = $settings['link_color'] ?? '#0066cc';
        $hover_color = $settings['hover_color'] ?? '#ff6600';

        echo '<style>';
        echo '.' . $unique_class . ' {';
        echo 'background-color: ' . esc_attr( $bg_color ) . ' !important;';
        echo 'padding: ' . (int)($settings['padding']['size'] ?? 20) . 'px;';
        echo 'margin: ' . (float)($settings['margin']['size'] ?? 1.5) . 'em 0;';
        echo 'font-size: ' . (int)($settings['font_size']['size'] ?? 16) . 'px;';
        echo 'line-height: ' . (float)($settings['line_height']['size'] ?? 1.6) . ';';
        echo 'border-radius: ' . (int)($settings['border_radius']['size'] ?? 6) . 'px;';
        echo '}';

        echo '.' . $unique_class . ' a { color: ' . esc_attr( $link_color ) . ' !important; text-decoration: none; }';
        echo '.' . $unique_class . ' a:hover { color: ' . esc_attr( $hover_color ) . ' !important; text-decoration: underline; }';
        echo '</style>';

        echo $output;
    }
}