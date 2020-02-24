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
        protected $incs;

        public function __construct()
        {
            $this->includes();
            $this->incs = new \stdClass();
        }

        private function includes()
        {
//            require_once APP_INC.'class-app-shortcodes.php';
        }
    }