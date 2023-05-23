<?php

/**
 * @package Maneth's Plugin
 */

class ManethPluginDeactivate
{
    public static function deactivate( $var = null)
    {

        flush_rewrite_rules();
    }
}
