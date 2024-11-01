<?php
/**
 * Plugin Name: Simple Post Lists
 * Plugin URI: https://github.com/andrewoons/simple-post-lists
 * Description: Wordpress plugin that generates a really simple post list, divided by year 
 * Version: 1.0
 * Author: Andre Woons
 * Author URI: http://andrewoons.com
 * License: GNU General Public License v3.0
 */

if ( !class_exists( 'Simple_Post_List' ) ) {
    class Simple_Post_List {

        public static function register_shortcode() {
            add_shortcode('posts', array( 'Simple_Post_List' , 'get_list' ) );
        }

        public static function get_list() {
            ob_start();

            $the_query = new WP_Query('showposts=-1');
            $lastyear;

            while ($the_query -> have_posts()) : $the_query -> the_post();

            if (empty($lastyear) || (int)get_the_date('Y') < $lastyear ) {
                $lastyear = (int)get_the_date('Y');
                echo '<h2 class="posts-divider">' . $lastyear . '</h2>';
            }

            echo '<p><a class="posts-link" href="' . get_the_permalink() . '">' . get_the_title() . '</a></p>';
            
            endwhile;

            return ob_get_clean();
            wp_reset_postdata();
        }
    }

    Simple_Post_List::register_shortcode();
}
?>