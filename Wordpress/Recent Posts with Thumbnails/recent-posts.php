<?php
/**
 * Plugin Name: Recent Posts ( with thumbnails ) - Shortcode
 * Plugin URI: https://github.com/vrx10/recent-posts-thumbnails-shortcode
 * Description: A lightweight plugin to display recent posts with thumbnails using a shortcode.
 * Version: 1.0.0
 * Author: Vsantos
 * Author URI: https://vsantos.pt
 * License: MIT
 * Text Domain: recent-posts-thumbnails-shortcode
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Shortcode to display recent posts with thumbnails.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output of recent posts.
 */
function rpt_recent_posts_shortcode( $atts ) {
    // Default attributes.
    $atts = shortcode_atts(
        array(
            'posts_per_page' => 5,
            'category'       => '',
            'show_date'      => true,
            'thumbnail_size' => 'thumbnail', // You can set also other sizes (e.g., 'thumbnail', 'medium', 'large').
        ),
        $atts,
        'recent_posts'
    );

    // Query arguments.
    $query_args = array(
        'posts_per_page' => intval( $atts['posts_per_page'] ),
        'post_status'    => 'publish',
    );

    if ( ! empty( $atts['category'] ) ) {
        $query_args['category_name'] = sanitize_text_field( $atts['category'] );
    }

    $recent_posts = new WP_Query( $query_args );

    // Generate output.
    if ( $recent_posts->have_posts() ) {
        $output = '<ul class="recent-posts-thumbnails">';
        while ( $recent_posts->have_posts() ) {
            $recent_posts->the_post();

            $output .= '<li class="recent-post-item">';

            // Add thumbnail.
            if ( has_post_thumbnail() ) {
                $output .= '<div class="recent-post-thumbnail">';
                $output .= '<a href="' . esc_url( get_permalink() ) . '">';
                $output .= get_the_post_thumbnail( get_the_ID(), esc_attr( $atts['thumbnail_size'] ), array( 'alt' => get_the_title() ) );
                $output .= '</a>';
                $output .= '</div>';
            }

            // Add title.
            $output .= '<div class="recent-post-content">';
            $output .= '<a href="' . esc_url( get_permalink() ) . '" class="recent-post-title">' . get_the_title() . '</a>';

            // Add date if enabled.
            if ( filter_var( $atts['show_date'], FILTER_VALIDATE_BOOLEAN ) ) {
                $output .= '<span class="post-date">' . get_the_date() . '</span>';
            }
            $output .= '</div>';

            $output .= '</li>';
        }
        $output .= '</ul>';
        wp_reset_postdata();
    } else {
        $output = '<p>No recent posts found.</p>';
    }

    return $output;
}

// Register the shortcode.
add_shortcode( 'recent_posts', 'rpt_recent_posts_shortcode' );

/**
 * Enqueue plugin styles.
 */
function rpt_enqueue_styles() {
    wp_enqueue_style(
        'recent-posts-thumbnails',
        plugin_dir_url( __FILE__ ) . 'css/recent-posts-thumbnails.css',
        array(),
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'rpt_enqueue_styles' );