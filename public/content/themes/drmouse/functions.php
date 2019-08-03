<?php

function createCustomPostTypes() {
    register_post_type('customers', [
        'labels' => [
            'name' => __( 'Customers' ),
            'singular_name' => __( 'Customer' ),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'movies'],
        'menu_icon' => 'dashicons-admin-users',
        'supports' => ['title'],
    ]);

    register_post_type('repairs', [
        'labels' => [
            'name' => __( 'Repairs' ),
            'singular_name' => __( 'Repair' ),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'repairs'],
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => ['title'],
    ]);
}
// Hooking up our function to theme setup
add_action( 'init', 'createCustomPostTypes' );

function addAcfColumnsCustomers( $columns ) {
    return array_merge($columns, [
        'phone_number' => __ ( 'Phone Number' ),
    ]);
}
add_filter( 'manage_customers_posts_columns', 'addAcfColumnsCustomers' );

function addAcfColumnsDataCustomers( $column, $post_id ) {
    switch ( $column ) {
        case 'phone_number':
            echo get_post_meta ( $post_id, 'phone_number', true );
            break;
    }
}
add_action ( 'manage_customers_posts_custom_column', 'addAcfColumnsDataCustomers', 10, 2 );
