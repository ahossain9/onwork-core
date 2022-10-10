<?php

/**
 * onwork_core login and registration widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */

namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

defined('ABSPATH') || die();

class Login_Registration extends Widget_Base
{

    public function get_name()
    {
        return 'login-register';
    }

    public function get_title()
    {
        return esc_html__('Login and Register', 'onwork-core');
    }

    public function get_icon()
    {
        return 'eicon-accordion';
    }

    public function get_categories()
    {
        return ['onwork_core'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'login_and_register_section',
            [
                'label' => esc_html__('Login and Register', 'onwork-core'),
                'type' => Controls_Manager::SECTION,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        // get our input from the widget settings. 
        if (!is_user_logged_in()) { ?>
            <div class="login-and-register">
                <?php the_custom_logo(); ?>
                <nav class="mb-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <div class="nav-link active" data-bs-toggle="tab" data-bs-target="#login" aria-controls="nav-home" aria-selected="true"><?php echo esc_html__('Login', 'onwork-core') ?></div>
                        <div class="nav-link" data-bs-toggle="tab" data-bs-target="#register" aria-controls="nav-profile" aria-selected="false"><?php echo esc_html__('Register', 'onwork-core') ?></div>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        <form id="login-form">
                            <input type="text" name="username" placeholder="<?php echo esc_html__('Username', 'onwork-core') ?>">
                            <input type="password" name="password" placeholder="<?php echo esc_html__('Password', 'onwork-core') ?>">
                            <a href="#" id="login-submit" data-nonce="<?php echo wp_create_nonce('login_nonce'); ?>" class="prolancer-btn"><?php echo esc_html__('Login', 'onwork-core') ?></a>
                        </form>
                        <a href="<?php echo esc_url(home_url('/wp-login.php?action=lostpassword')); ?>" class="mt-4 pt-2 d-block lost-password" alt="<?php echo esc_attr__('Lost password', 'onwork-core'); ?>">
                            <?php echo esc_html__('Lost password', 'onwork-core'); ?>
                        </a>
                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel">
                        <form id="register-form">
                            <div class="row">
                                <div class="col-md-6"><input type="text" name="firstname" placeholder="<?php echo esc_html__('First name', 'onwork-core') ?>"></div>
                                <div class="col-md-6"><input type="text" name="lastname" placeholder="<?php echo esc_html__('Last name', 'onwork-core') ?>"></div>
                            </div>
                            <input type="text" name="username" placeholder="<?php echo esc_html__('Username', 'onwork-core') ?>">
                            <input type="email" name="email" placeholder="<?php echo esc_html__('Email', 'onwork-core') ?>">
                            <?php

                            ?>
                                <input type="password" name="password" placeholder="<?php echo esc_html__('Password', 'onwork-core') ?>">
                                <input type="password" name="re-password" placeholder="<?php echo esc_html__('Repeat password', 'onwork-core') ?>">
                          
                            <a href="#" id="register-submit" data-nonce="<?php echo wp_create_nonce('register_nonce'); ?>" class="prolancer-btn"><?php echo esc_html__('Register', 'onwork-core') ?></a>
                        </form>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <script type="text/javascript">
                <?php if ($_GET['action'] !== 'elementor') { ?>
                    location.href = '<?php echo esc_url(home_url('/')); ?>';
                <?php } ?>
            </script>
<?php }
    }
}

