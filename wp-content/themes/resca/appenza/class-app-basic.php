<?php
    /**
     * Created by PhpStorm.
     * User: Mustafa Shaaban
     * Date: 2/20/2020
     * Time: 4:10 PM
     */

    namespace APPENZA;

    use APPENZA\INC\App_init;

    define('APP_ID', 'appenza');
    define('APP_THEME_DIR', trailingslashit(get_template_directory()));
    define('APP_THEME_URI', trailingslashit(get_template_directory_uri()));
    define('APP_ASSETS', APP_THEME_URI.'appenza/assets/');
    define('APP_CSS', APP_ASSETS.'css/');
    define('APP_JS', APP_ASSETS.'js/');
    define('APP_VENDORS', APP_ASSETS.'vendors/');
    define('APP_IMG', APP_ASSETS.'img/');
    define('APP_INC', APP_THEME_DIR.'appenza/inc/');

    if (!defined('ADMIN')) {
        define('ADMIN', 'administrator');
    }
    if (!defined('SHOP_MANAGER')) {
        define('SHOP_MANAGER', 'shop_manager');
    }
    if (!defined('CUSTOMER')) {
        define('CUSTOMER', 'customer');
    }
    if (!defined('CASHIER')) {
        define('CASHIER', 'cashier');
    }

    class App_basic
    {
        public static $instance;
        protected $css;
        protected $js;
        protected $inc;

        public function __construct()
        {
            self::$instance = $this;
            $this->css      = APP_CSS;
            $this->js       = APP_JS;

            $this->actions();
            $this->filters();
            $this->include_files();

            $this->inc = new App_init();
        }

        public static function get()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        private function include_files()
        {
            require_once APP_INC.'class-app-init.php';
        }

        private function actions()
        {
            add_action('init', array($this, 'app_init'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        }

        private function filters()
        {

        }

        public function app_init() {

        }

        public function enqueue_assets()
        {
            $this->enqueue_styles();
            $this->enqueue_scripts();
        }

        public function enqueue_styles()
        {
            wp_enqueue_style(APP_ID.'-style', $this->css.'appenza.css', array(), '1.0');
        }

        public function enqueue_scripts()
        {
            wp_enqueue_script(APP_ID.'-script', $this->js.'appenza.js', array('jquery'), '1.0', true);
        }

    }