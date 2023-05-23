<?php

/**
 * Trigger this on Uninstallaion
 * @package Maneth's Plugin
 * 
 */

//Security Check
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die();
}


// //Clear DB Post Type
// $books = get_posts( array('post_type' => 'book' , 'numberposts' => -1) );

// foreach ($books as $key => $book) {
//    wp_delete_post($book->ID , true);
// }

# This is Mandatory When Deleting a Plugin
//Access The DB With SQL
global $wpdb;
$wpdb->query("DELETE FROM wp_posts where post_type = 'book' ");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");