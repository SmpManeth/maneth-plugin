<?php

/**
 * @package Maneth's Plugin
 */

class ManethPluginActivate
{
    public static function activate( $var = null)
    {
        flush_rewrite_rules();
    }
}
