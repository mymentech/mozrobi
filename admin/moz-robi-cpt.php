<?php
// Register Custom Post Type Announcement
function create_mozrobiannouncement_cpt() {

    $labels = array(
        'name' => _x( 'Announcements', 'Post Type General Name', 'mozrobi' ),
        'singular_name' => _x( 'Announcement', 'Post Type Singular Name', 'mozrobi' ),
        'menu_name' => _x( 'Announcements', 'Admin Menu text', 'mozrobi' ),
        'name_admin_bar' => _x( 'Announcement', 'Add New on Toolbar', 'mozrobi' ),
        'archives' => __( 'Announcement Archives', 'mozrobi' ),
        'attributes' => __( 'Announcement Attributes', 'mozrobi' ),
        'parent_item_colon' => __( 'Parent Announcement:', 'mozrobi' ),
        'all_items' => __( 'All Announcements', 'mozrobi' ),
        'add_new_item' => __( 'Add New Announcement', 'mozrobi' ),
        'add_new' => __( 'Add New', 'mozrobi' ),
        'new_item' => __( 'New Announcement', 'mozrobi' ),
        'edit_item' => __( 'Edit Announcement', 'mozrobi' ),
        'update_item' => __( 'Update Announcement', 'mozrobi' ),
        'view_item' => __( 'View Announcement', 'mozrobi' ),
        'view_items' => __( 'View Announcements', 'mozrobi' ),
        'search_items' => __( 'Search Announcement', 'mozrobi' ),
        'not_found' => __( 'Not found', 'mozrobi' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'mozrobi' ),
        'featured_image' => __( 'Featured Image', 'mozrobi' ),
        'set_featured_image' => __( 'Set featured image', 'mozrobi' ),
        'remove_featured_image' => __( 'Remove featured image', 'mozrobi' ),
        'use_featured_image' => __( 'Use as featured image', 'mozrobi' ),
        'insert_into_item' => __( 'Insert into Announcement', 'mozrobi' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Announcement', 'mozrobi' ),
        'items_list' => __( 'Announcements list', 'mozrobi' ),
        'items_list_navigation' => __( 'Announcements list navigation', 'mozrobi' ),
        'filter_items_list' => __( 'Filter Announcements list', 'mozrobi' ),
    );
    $args = array(
        'label' => __( 'Announcement', 'mozrobi' ),
        'description' => __( 'Publish Announcement for Channeli website', 'mozrobi' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-microphone',
        'supports' => array('title'),
        'taxonomies' => array(),
        //'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'mozrobiannouncement', $args );

}
add_action( 'init', 'create_mozrobiannouncement_cpt', 0 );