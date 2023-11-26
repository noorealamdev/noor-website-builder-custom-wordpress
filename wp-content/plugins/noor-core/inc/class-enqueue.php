<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Noor_Core_Enqueue' ) ) {
    class Noor_Core_Enqueue {
        protected static $instance = null;

        public static function instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }

            return self::$instance;
        }


        public function initialize() {
            add_action( 'admin_enqueue_scripts', [$this, 'noorcore_admin_enqueue_scripts'] );
            add_action( 'wp_enqueue_scripts', [$this, 'noorcore_enqueue_scripts'] );
        }

        public function noorcore_admin_enqueue_scripts() {

            // Datatables
            wp_register_style('noorcore-admin-datatable', '//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' );
            wp_register_script('noorcore-admin-datatable-script', '//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js', array('jquery'), '1.0', true);

            // Bootstrap
            wp_register_style('noorcore-admin-bootstrap', NOORCORE_URL . 'assets/admin/bootstrap/bootstrap.min.css' );
            wp_register_script('noorcore-admin-bootstrap-script', NOORCORE_URL . 'assets/admin/bootstrap/bootstrap.min.js', array('jquery'), '1.0', true);

            // CSS
            wp_enqueue_style('noorcore-admin-style', NOORCORE_URL . 'assets/admin/admin-style.css' );

            // JS
            wp_enqueue_script('noorcore-admin-script', NOORCORE_URL . 'assets/admin/admin-script.js', array('jquery'), '1.0', true);
            wp_localize_script( 'noorcore-admin-script', 'noorAjax', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
        }


        public function noorcore_enqueue_scripts() {
            // CSS
            wp_enqueue_style('noorcore-style', NOORCORE_URL . 'assets/css/noor-core.css' );

            // JS
            wp_enqueue_script('noorcore-script', NOORCORE_URL . 'assets/js/noor-core.js', array('jquery'), '1.0', true);
        }


    }

    Noor_Core_Enqueue::instance()->initialize();
}