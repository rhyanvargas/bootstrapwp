<?php

/**
 *  Custom Read More Button
 */
function modify_read_more_link() {
    return '<p><a class="more-link btn btn-default" href="' . get_permalink() . '">Read More...</a></p>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

/**
 *  Custom 'Edit Post' Link
 */
function custom_edit_post_link($output) {
    $output = str_replace('class="post-edit-link"', 
                          'class="post-edit-link btn btn-danger btn-xs"', 
                          $output);
    return $output;
    
}
add_filter('edit_post_link', 'custom_edit_post_link');

/**
 *  Custom Comment Form
 */
function custom_comment_form( $args ) {
    // submit button
    $args['class_submit'] = 'btn btn-primary btn-md'; // since WP 4.1
    
    return $args;
    
}

add_filter( 'comment_form_defaults', 'custom_comment_form' );