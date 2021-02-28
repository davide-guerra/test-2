<?php

// Enqueue parent theme style
function add_parent_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' ); 
}
add_action( 'wp_enqueue_scripts', 'add_parent_style');


// Enqueue child theme style
function add_child_style() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'add_child_style', 11 );


// Display discount percentage
function display_discount_percentage( $price, $product ) {
    if( $product->is_type('simple') && $product->is_on_sale() ) {
         
        // Get normal price and discount price
        $normal_price = (float) $product->get_regular_price();
        $sale_price = (float) $product->get_price();

        // Calculate discount percentage
        $discount_percentage = round( 100 - ( $sale_price / $normal_price * 100 ) ) . '%';

        // Edit the price
        $price .= ' <span class="percentage">(-' . $discount_percentage . ')</span>';
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'display_discount_percentage', 10, 2 );