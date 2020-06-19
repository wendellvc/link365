<?php
/**
 * Register CTP Case Studies.
 *
 * @package   WDC\Theme
 * @author    Wendell Cabalhin <wendell.cabalhin@intimation.co.uk>
 * @copyright Copyright (c) 2019, Intimation Creative
 * @copyright MIT
 */
function case_studies() {
    // Array of custom labels for our custom post type backend.
    $labels = array(
        'name'               => 'Case Studies', // General name. ie: Posts/Pages
        'singular_name'      => 'Case Study', // Name for single object. ie: Post/Page
        'menu_name'          => 'Case Studies', // Name used in the menu
        'name_admin_bar'     => 'Case Study', // String for use in admin menu bar. - New Book
        'add_new_item'       => 'Add New Case Study', // Default is 'Add New Post/Add New Page'
        'new_item'           => 'New Case Study', // Default is New Post/New Page.
        'edit_item'          => 'Edit Case Study', // Default is Edit Post/Edit Page.
        'view_item'          => 'View Case Study', // Default is View Post/View Page.
        'all_items'          => 'All Case Studies', // String for the submenu. ie: All Posts/All Pages.
        'search_items'       => 'Search Case Studies', // Default is Search Posts/Pages
        'parent_item_colon'  => 'Parent Case Studies:', // This string is used in hierarchical types. The default is 'Parent Page:'.
        'not_found'          => 'No case studies found.', // Default is No posts found/No pages found.
        'not_found_in_trash' => 'No case studies found in Trash.', // Default is No posts found in Trash/No pages found in Trash.
        'featured_image'        => 'Case Study Featured Image', // Default is Featured Image.
        'set_featured_image'    => 'Set case study featured image', // Default is Set featured image.
        'remove_featured_image' => 'Remove case study featured image', // Default is Remove featured image.
        'use_featured_image'    => 'Use as case study featured image', // Default is Use as featured image.
        'items_list'            => 'Case Studies list', // String for the table hidden heading.
        'items_list_navigation' => 'Case Studies list navigation', // String for the table pagination hidden heading.
        'filter_items_list'     => 'Filter items list' // String for the table views hidden heading.
    );

    $args = array(
        // A plural descriptive name for the post type marked for translation. If you don'’'t declare a custom label, WordPress will use the name of the custom post type by default.
        'label'                 => 'Case Studies',
        'labels'                => $labels, // Applying our labels array from above.
        'supports'              => array(
                            'title',
                            'editor',
                            'author',
                            'thumbnail',
                            'comments',
                            'custom-fields', ), // Array of features that the CPT will support.
        'taxonomies'            => array( 'category', 'post_tag' ), // An array of registered taxonomies like category or post_tag.
        'hierarchical'          => false, // Whether the post type is hierarchical (e.g. page).
        'public'                => true, // Whether a post type is intended to be used publicly.
        'show_ui'               => true, // Generates a default UI for managing this CPT in the admin.
        'show_in_menu'          => true, // Whether the custom post type should be visible in the menu.
        'menu_position'         => 5,     // The position in the menu order in admin.
        'menu_icon'             => 'dashicons-admin-post', // This declares a custom icon for this CPT in the admin area.
        'show_in_admin_bar'     => true, // Whether to make this post type available in the WordPress admin bar.
        'show_in_nav_menus'     => true, //Whether post_type is available for selection in navigation menus.
        'has_archive'           => true, // Enables post type archives.
        'exclude_from_search'   => false, // Exclude for search engine.
        'publicly_queryable'    => true, // Whether queries can be performed on the front end as part of parse_request().
        'capability_type'       => 'page', // Type of custom post type we will be dealing with.
        'show_in_rest'          => true // Whether to expose this post type in the REST API.
    );
    // The register_post_type() is a function that WordPress recognizes as a custom post type generator. In this, it accepts two parameters which are the name of the post type itself and any arguments you would like to call.
    register_post_type( 'case-studies', $args );
}
// This line of code returns or calls our function above.
add_action( 'init', 'case_studies' );
