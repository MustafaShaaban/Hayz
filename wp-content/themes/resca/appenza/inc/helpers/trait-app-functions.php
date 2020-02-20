<?php
    /**
     * Created by PhpStorm.
     * User: Mustafa Shaaban
     * Date: 2/20/2020
     * Time: 6:47 PM
     */

    namespace APPENZA\INC\HELPERS;


    trait App_functions
    {
        public function get_page_url($name, $type='slug') {
            $link = '';
            if (!empty($name)) {
                switch ($type) {
                    case 'slug':
                        $link = get_permalink( get_page_by_path( $name ) );
                        break;
                    case 'title':
                        $link = get_permalink( get_page_by_title( $name ) );
                        break;
                    case 'ID':
                        $link = get_permalink( $name );
                        break;
                    default:
                        break;
                }
            }
            return $link;
        }
    }