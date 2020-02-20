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
    define('APP_ASSETS', APP_THEME_URI.'appenza/');
    define('APP_CSS', APP_ASSETS.'assets/css/');
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

            $this->inc_assets();
            $this->actions();
            $this->filters();
            $this->short_codes();
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

        private function inc_assets()
        {
            $this->styles();
            $this->scripts();
        }

        public function styles()
        {
            wp_enqueue_style(APP_ID.'-style', $this->css.'appenza.css', array(), '1.0');
        }

        public function scripts()
        {

        }

        private function actions()
        {

        }

        private function filters()
        {

        }

        private function short_codes()
        {
            add_shortcode('app_home_mealplans', [$this, 'home_plans_html']);
        }

        public function home_plans_html()
        {
            $meals = new \WP_Query([
                    'post_type' => 'meal_plans',
                    'post_status' => 'publish',
                    'posts_per_page' => 4
            ]);

            if (!$meals->have_posts()) {
                return '';
            }

            ob_start();
            ?>
            <div class="parallax ">
                <h2 class="text-center"><?= __('Meal Plan', 'appenza') ?></h2>
                <p class="desc-hayz"><?= __('Are you looking for a Delicious and Healthy Meal Plan to help you manage your Weight while enjoying Great Taste?!
                    HAYZ delicious meal plans available now with a bigger variety of food options that will satisfy your taste buds without insane restrictions. We will scientifically calculate your required calories and macro nutrients for your specific objectives and deliver you tailored meals to your door steps.', 'appenza') ?></p>
            </div>
            <div class="cards-meal-plan">
                <?php
                    if ($meals->have_posts()) {
                        foreach ($meals->posts as $meal) {
                            ?>
                            <div class="card">
                                <h1> <?= __($meal->post_title, 'appenza') ?> </h1>
                                <p> <?= __($meal->post_content, 'appenza') ?> </p>
                                <button type="button"><a href="<?= $this->inc->get_page_url('shop') ?>"><?= __('Order Online', 'appenza') ?></a></button>
                                <a href="<?= $this->inc->get_page_url($meal->ID, 'ID') ?>"><?= __('Sample 1 Week Menu', 'appenza') ?></a>
                            </div>
                            <?php
                        }
                    }
                ?>
                <div class="card card-full-width">
                    <h1> <?= __('Seek Our Advice', 'appenza') ?> </h1>
                    <p><?= __('Unsure what you need? WE CAN HELP! Contact us below and we will work with your personal needs to advise you with the plan that best meets your goals', 'appenza') ?></p>
                </div>
            </div>
            <?php
            return ob_get_clean();
        }

    }

    // TODO:: ADD PDF plugin
    // TODO:: Meal plans page custom fields
