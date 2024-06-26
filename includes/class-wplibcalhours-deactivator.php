<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/ucsf-ckm/wplibcalhours
 * @since      1.0.0
 *
 * @package    WpLibCalHours
 * @subpackage WpLibCalHours/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 * @package    WpLibCalHours
 * @subpackage WpLibCalHours/includes
 * @author     Stefan Topfstedt <stefan.topfstedt@ucsf.edu>
 */
class WpLibCalHours_Deactivator {
    /**
     * Deactivation callback.
     *
     * Clears out any transient data that may have been set by this plugin.
     */
    public static function deactivate() {
        delete_transient( 'wplibcalhours_data' );
    }
}
