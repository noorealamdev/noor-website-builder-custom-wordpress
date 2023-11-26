<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Noor_Core_Subscribe' ) ) {
    class Noor_Core_Subscribe {
        protected static $instance = null;

        public static function instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        private $svg_icon_uri = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTI4IiBoZWlnaHQ9IjEyOCIgdmlld0JveD0iMCAwIDI0IDI0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGZpbGw9IiMwMDAwMDAiIGQ9Ik0xOC41IDEzYy0xLjkzIDAtMy41IDEuNTctMy41IDMuNXMxLjU3IDMuNSAzLjUgMy41czMuNS0xLjU3IDMuNS0zLjVzLTEuNTctMy41LTMuNS0zLjV6bTIgNGgtNHYtMWg0djF6bS02Ljk1IDBjLS4wMi0uMTctLjA1LS4zMy0uMDUtLjVjMC0yLjc2IDIuMjQtNSA1LTVjLjkyIDAgMS43Ni4yNiAyLjUuNjlWNWMwLTEuMS0uOS0yLTItMkg1Yy0xLjEgMC0yIC45LTIgMnYxMGMwIDEuMS45IDIgMiAyaDguNTV6TTEyIDEwLjVMNSA3VjVsNyAzLjVMMTkgNXYybC03IDMuNXoiLz48L3N2Zz4=';

        public function initialize() {
            add_action('admin_menu', [$this, 'noor_subscribe_admin_menu']);
            add_action('init', [$this, 'create_db_table']);
        }

        public function create_db_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . "subscribers";

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                  id int(11) NOT NULL AUTO_INCREMENT,
                  email VARCHAR(100) NOT NULL,
                  ip VARCHAR(20) NOT NULL,
                  created_at datetime NOT NULL,
                  PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
        public function noor_subscribe_admin_menu() {
            add_menu_page(
                'Subscribers', // Page title
                'Subscribers', // Menu title
                'manage_options', // Capability required to access the menu
                'noor-subscribers', // Menu slug
                [$this, 'noor_subscribers_custom_menu_callback'], // Callback function to render the menu page
                $this->svg_icon_uri, // Menu icon (optional)
                99 // Menu position (optional)
            );

            add_submenu_page(
                'noor-subscribers',
                'Add New Subscriber',
                'Add New',
                'manage_options',
                'noor-subscribers-new',
                [$this, 'noor_subscribers_custom_submenu_new_callback']
            );
        }

        public function noor_subscribers_custom_menu_callback() {
            // Add your menu page content here
            if ( $_GET['page'] && $_GET['page'] == 'noor-subscribers' ) {
                // Bootstrap
                wp_enqueue_style('noorcore-admin-bootstrap');
                wp_enqueue_script('noorcore-admin-bootstrap-script');

                // Datatable
                wp_enqueue_style('noorcore-admin-datatable');
                wp_enqueue_script('noorcore-admin-datatable-script');
            }

            $add_new_url = menu_page_url('noor-subscribers-new', false);
            ?>
            <div class="wrap" id="noor-subscribers-list-table">
                <h1 class="wp-heading-inline"><?php echo esc_html( __( 'Subscribers', 'noor-core' ) ); ?></h1>
                <hr class="wp-header-end">

                <div class="row">
                    <div class="col-xl-8">
                        <div class="table-responsive mb-4 mt-4">
                            <table id="datatable-basic" class="table noor-subscribers text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">IP</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="product-list">
                                    <td>email@domain.com</td>
                                    <td>192.168.0.1</td>
                                    <td><a class="delete-subscriber" href="#" data-bs-toggle="modal" data-bs-target="#deleteSubscriberModal">Delete</a></td>
                                </tr>

                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteSubscriberModal" tabindex="-1" role="dialog"
                                     aria-labelledby="teamModalCenterTitle" aria-hidden="false">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="teamModalCenterTitle">Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center"><h5>Are you sure?</h5></div>
                                            <div class="modal-footer">
                                                <form class="d-inline-block"
                                                      action="{{ route('items.destroy', $item->id) }}" method="POST">
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .dataTables_wrapper .dataTables_length select {
                    width: 50px;
                }
            </style>
            <script>
                jQuery(document).ready(function ($) {
                    $('#datatable-basic').DataTable({
                        "pageLength": 50
                    });
                });
            </script>
            <?php
        }

        public function noor_subscribers_custom_submenu_new_callback() {
            ?>
            <div class="wrap">
                <?php //echo $_GET['widget'] ?>

                <h1 class="wp-heading-inline"><?php
                    echo esc_html( __( 'Add New Subscriber', 'noor-core' ) );
                    ?></h1>

                <hr class="wp-header-end">

            </div>
            <?php
        }



    }

    Noor_Core_Subscribe::instance()->initialize();
}