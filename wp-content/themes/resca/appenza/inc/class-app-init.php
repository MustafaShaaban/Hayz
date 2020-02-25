<?php
    /**
     * Created by PhpStorm.
     * User: Mustafa Shaaban
     * Date: 2/20/2020
     * Time: 5:08 PM
     */

    namespace APPENZA\INC;

    require_once APP_INC.'helpers/trait-app-functions.php';

    use APPENZA\INC\HELPERS\App_functions;

    class App_init
    {
        use App_functions;
        protected $instance;

        public function __construct()
        {
            $this->includes();
            $this->instance = new \stdClass();
            $this->instance->shortcodes = new App_shortCodes();
        }

        private function includes()
        {
            require_once APP_INC.'class-app-shortcodes.php';
        }
    }