<?php
/*
Plugin Name:  MozRobi News Timeline
Plugin URI:   https://www.mymentech.com
Description:  Basic WordPress Plugin to display News Timeline
Version:      1.0
Author:       MymenTech
Author URI:   https://www.mymentech.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  mozrobi
*/

include_once plugin_dir_path(__FILE__) . 'admin/moz-robi-cpt.php';
include_once plugin_dir_path(__FILE__) . 'admin/moz-robi-metabox.php';

class Mozrobi
{
    private $VERSION = '1.0';

    public function __construct() {
        $this->VERSION = time();
        add_action('plugins_loaded', array($this, 'mozrobi_plugin_textdomain'));
        add_action('wp_enqueue_scripts', array($this, 'mozrobi_scripts'));
        add_shortcode('mozrobi-announcements', array($this, 'create_mozrobiannouncement_shortcode'));


    }

    public function mozrobi_plugin_textdomain() {
        load_plugin_textdomain('mozrobi', false, plugin_dir_path(__FILE__) . "/languages");
    }

    public function mozrobi_scripts() {
        wp_enqueue_style('mozrobi-style', plugin_dir_url(__FILE__) . 'public/css/mozrobi-style.css', null, $this->VERSION);
        wp_enqueue_script('mozrobi-js', plugin_dir_url(__FILE__) . 'public/js/mozrobi-script.js', array('jquery'), $this->VERSION);
        $ajaxurl = admin_url('admin-ajax.php');
        wp_localize_script('mozrobi-js', 'wpfurls', array('ajaxurl' => $ajaxurl));

    }

    // Create Shortcode mozrobi-announcements
    // Shortcode: [mozrobi-announcements count="5"]
    public function create_mozrobiannouncement_shortcode($atts) {

        $atts = shortcode_atts(
            array(
                'count' => '5',
            ),
            $atts,
            'mozrobi-announcements'
        );

        $count = $atts['count'];
        $count = intval($count, 10);

        return $this->get_mozrobi_posts($count);

    }

    public function get_mozrobi_posts($count = 5) {
        $html                    = '<div class="mozrobi-container">';
        $args_announcement_query = array(
            'post_type'      => array('mozrobiannouncement'),
            'posts_per_page' => $count,
            'order'          => 'DESC',
        );

        $announcement_query = new WP_Query($args_announcement_query);

        if ($announcement_query->have_posts()) {
            while ($announcement_query->have_posts()) {
                $announcement_query->the_post();
                $title = get_the_title();
                $date  = get_the_date();
                $time  = get_the_time();

                $url = get_post_meta(get_the_ID(), 'mozrobi-url', true);
                $html .= "<div class='mozrobi-item'>";

                $date_html = "<div class='mozrobi-time'><span class='mr-date'>{$date}</span> <span class='mr-time'>{$time}</span></div>";
                $date_html = apply_filters('mozrobi-date-html', $date_html, $date, $time);


                $html .= $date_html;

                if (isset($url) && '#' != $url && !empty($url)) {
                    $link = "<a href='{$url}'>{$title}</a>";
                    $html .= "<div class='mozrobi-announcement'>{$link}</div>";
                } else {
                    $html .= "<div class='mozrobi-announcement'>{$title}</div>";
                }

                $html .= '</div>';
            }
        }

        wp_reset_postdata();

        $html .= '</div>';

        return $html;

    }

}

if (class_exists('Mozrobi')) {
    new Mozrobi();
}


?>


