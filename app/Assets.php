<?php

namespace App\StoreSearch;

class Assets
{
    private $permissions = [
        "toplevel_page_store-search-dashboard",
    ];

    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'adminScripts']);
        add_action('wp_enqueue_scripts', [$this, 'frontScripts']);
    }

    public function adminScripts($hook)
    {
        if (in_array($hook, $this->permissions)):
            wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css', [], '5.9.0');
            wp_enqueue_style('bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css', [], '5.2.3');
            wp_enqueue_style('sweetalert2-css', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css', [], '11.10.5');
            wp_enqueue_style('styles', STORE_SEARCH_PLUGIN_URI . '/resources/css/admin.css', [], false);

            wp_enqueue_media();
            wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js', [], '5.2.3', true);
            wp_enqueue_script('sweetalert2-js', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js', [], '11.10.5', true);
            wp_enqueue_script('app', STORE_SEARCH_PLUGIN_URI . '/resources/js/app.js', ['jquery'], filemtime(STORE_SEARCH_PLUGIN_PATH . '/resources/js/app.js'), true);

            wp_localize_script('app', 'obj', [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'adminurl' => admin_url(),
                'ajax_nonce' => wp_create_nonce(-1),
            ]);
        endif;
    }

    public function frontScripts()
    {
        wp_enqueue_style('sweetalert2-css', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css', [], '11.10.5');
        wp_enqueue_style('front-css', STORE_SEARCH_PLUGIN_URI . '/resources/css/front.css', [], STORE_SEARCH_PLUGIN_PATH . '/resources/css/front.css');

        wp_enqueue_script('sweetalert2-js', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js', [], '11.10.5', true);
        wp_enqueue_script('api_places', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyD10o8PT8CEbyzDTkCLj9xnCSL02Y-NP3E&libraries=places', [], null, true);
        wp_enqueue_script('mask', STORE_SEARCH_PLUGIN_URI . '/resources/js/jquery.mask.min.js', [], null, true);
        wp_enqueue_script('front-js', STORE_SEARCH_PLUGIN_URI . '/resources/js/front.js', ['jquery'], filemtime(STORE_SEARCH_PLUGIN_PATH . '/resources/js/front.js'), true);

        wp_localize_script('front-js', 'obj', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'adminurl' => admin_url(),
            'ajax_nonce' => wp_create_nonce(-1),
        ]);
    }
}