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

    class App_shortCodes
    {
        use App_functions;

        public function __construct()
        {
            add_shortcode('app_home_features', [$this, 'home_features_html']);
            add_shortcode('app_home_mealplans_head', [$this, 'home_plans_head_html']);
            add_shortcode('app_home_mealplans_body', [$this, 'home_plans_body_html']);
        }

        public function home_features_html()
        {
            ob_start();
            ?>
            <div class="cards-meal-plan">
                <!-- Write Your Code Here -->
            </div>
            <?php
            return ob_get_clean();
        }

        public function home_plans_head_html()
        {
            ob_start();
            ?>
            <div class="meal-plan">
                <h2 class="text-center"><?= __('Meal Plan', 'appenza') ?></h2>
                <p class="desc-hayz"><?= __('Are you looking for a Delicious and Healthy Meal Plan to help you manage your Weight while enjoying Great Taste?!
                    HAYZ delicious meal plans available now with a bigger variety of food options that will satisfy your taste buds without insane restrictions. We will scientifically calculate your required calories and macro nutrients for your specific objectives and deliver you tailored meals to your door steps.', 'appenza') ?></p>
            </div>
            <?php
            return ob_get_clean();
        }

        public function home_plans_body_html()
        {
            $meals = new \WP_Query([
                'post_type'      => 'meal_plans',
                'post_status'    => 'publish',
                'posts_per_page' => 4,
                'order'          => 'ASC',
                'orderby'        => 'ID'
            ]);

            if (!$meals->have_posts()) {
                return '';
            }

            ob_start();
            ?>
            <div class="cards-meal-plan">
                <?php
                    if ($meals->have_posts()) {
                        foreach ($meals->posts as $meal) {
                            $pdf_id = get_post_meta($meal->ID, 'pdf_file', true);
                            $pdf_url = wp_get_attachment_url($pdf_id);
                            ?>
                            <div class="card">
                                <h1> <?= __($meal->post_title, 'appenza') ?> </h1>
                                <p> <?= __($meal->post_content, 'appenza') ?> </p>
                                <button type="button"><a href="<?= $this->get_page_url('shop') ?>"><?= __('Order Online', 'appenza') ?></a></button>
                                <a href="<?= $pdf_url ?>" target="_blank"><?= __('Sample 1 Week Menu', 'appenza') ?></a>
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
