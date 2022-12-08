<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="frontend-dashboard-wrap">
        <div class="row">
            <div class="col-lg-3">
                <div class="frontend-dashboard-sidebar">
                    <div class="dashboard-logo">
                        <img src="<?php echo ONWORK_CORE_ASSETS . 'images/logo.png' ?>" alt="Logo">
                    </div>
                    <div class="dashboard-sidebar-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Message</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Projects</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Create Projects</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Ongoing Projects</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Canceled Projects</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Completed Projects</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Ongoing Services</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Canceled Services</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Completed Services</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Wallet</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Services Wishlist</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Disputes</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Verification</a></li>
                            <li><a href="#"><i class="fa fa-home"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <header class="frontend-dashboard-header">
                    <div class="row">
                        <img src="" alt="">
                    </div>
                </header>
                <div class="frontend-dashboard-body">
                </div>
                <footer class="frontend-dashboard-footer">
                    <p class="text-center">All Rights Reserved By <a href="https://themeforest.net/user/rootpointer">RootPointer</a></p>
                </footer>
            </div>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>

</html>