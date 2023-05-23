<?php

/**
 * 
 * @package Maneth's Plugin
 * 
 */

/*
 * 
  Plugin Name:Maneth's Plugin
  Plugin URI: https://manethpathirana.site/plugin
  Description: This is My Second Plugin
  Version:1.0.0
  Author: Maneth Pathirana
  Author URI:https://manethpathirana.site
  License: GPLv2 or later
  Text Domain: maneth-plugin
/*
Version 2, June 1991

Copyright (C) 1989, 1991 Free Software Foundation, Inc.  
51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA

Everyone is permitted to copy and distribute verbatim copies
of this license document, but changing it is not allowed.
 */

//  To Increase the Security of the Website 
if (!defined('ABSPATH')) {
    die;
}

class ManethPlugin
{
    public $plugin_name;
    function __construct()
    {
        $this->plugin_name = plugin_basename(__FILE__);
    }

    function register()
    {
        //registering the Styles
        add_action('admin_enqueue_scripts', array($this, 'enqueue')); //admin side
        //add_action('wp_enqueue_scripts', array($this, 'enqueue')); //froneend side
        // $this->create_post_type();


        //Createa a Dashboard menu button for the Plugin
        add_action('admin_menu', array($this, 'add_admin_pages'));


        // Add Links to the Plugins page 
        add_filter("plugin_action_links_$this->plugin_name", array($this, 'settings_link'));
    }

    //Settings Link
    public function settings_link($links)
    {
        $settings_link = '<a href="admin.php?page=maneth_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
    //Add Admin Oages to the dashboard
    public function add_admin_pages()
    {

        add_menu_page("Manth's Plugin", "Maneth", 'manage_options', 'maneth_plugin', array($this, 'admin_index'), 'dashicons-fullscreen-exit-alt', 110);
    }
    
    public function admin_index()
    {
        #require Template html
        require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
    }

    public static function custome_post_type()
    {
        //This is Similar to a Post. but a new Post type. in this case this is not a post. this is a book
        register_post_type('book', ['public' => true, 'label' => 'Books']);
    }

    function enqueue()
    {
        //enqueue all our Sripts(Register the Scripts and Styles)
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/assets/myscripts.js', __FILE__));
    }
    public static function create_post_type()
    {
        //When Running this , this calles the custome_post_type function.
        add_action('init', array('ManethPlugin', 'custome_post_type'));
    }
}

if (class_exists('ManethPlugin')) {
    $manethPluginClass = new ManethPlugin();
    $manethPluginClass->register();
    ManethPlugin::create_post_type();
}

// Calling Static FUnctions  
//Run this File on Activation
require_once plugin_dir_path(__FILE__) . 'inc/maneth-plugin-activate.php';
register_activation_hook(__FILE__, array('ManethPluginActivate', 'activate'));

//Run this File on Deactivation
require_once plugin_dir_path(__FILE__) . 'inc/maneth-plugin-deactivate.php';
register_deactivation_hook(__FILE__, array('ManethPluginDeactivate', 'deactivate'));
