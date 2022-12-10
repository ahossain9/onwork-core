<?php
/**
 * Register custom post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
if ( ! function_exists('onwork_custom_post_type') ) {
       
    function onwork_custom_post_type() {

        //Project
        register_post_type(
            'projects', array(
            'labels' => array(
                'name' => __('Projects', 'onwork-core'),
                'singular_name' => __('Project', 'onwork-core'),
                'menu_name' => __('Projects', 'onwork-core'),
                'name_admin_bar' => __('Project', 'onwork-core'),
                'add_new' => __('Add New Project', 'onwork-core'),
                'add_new_item' => __('Add New Project', 'onwork-core'),
                'new_item' => __('New Project', 'onwork-core'),
                'edit_item' => __('Edit Project', 'onwork-core'),
                'view_item' => __('View Project', 'onwork-core'),
                'all_items' => __('All Projects', 'onwork-core'),
                'search_items' => __('Search Projects', 'onwork-core'),
                'not_found' => __('No Project Found.', 'onwork-core'),
            ),
            'description'    => __( 'Description.', 'onwork-core' ),
            'menu_icon'      => 'dashicons-clipboard',
            'public'         => true,
            'has_archive'    => true,
            'show_ui'        => true,
            'show_in_menu'   => true,
            'rewrite'        => array( 'slug' => 'projects' ),
            'supports'       => array( 'title','editor', 'author' )
        ));

        // Project taxonomy
        register_taxonomy('project-categories', array('projects'), array(
            'hierarchical' => true,
            'show_ui' => true,
            'label' => __('Project Categories', 'onwork-core'),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'projects-categories'),
        ));

        register_taxonomy('project-seller-type', array('projects'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Seller Type', 'onwork-core' ),
                'search_items'               => __( 'Search Seller Type', 'onwork-core' ),
                'popular_items'              => __( 'Popular Seller Type', 'onwork-core' ),
                'all_items'                  => __( 'All Seller Type', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Seller Type', 'onwork-core' ),
                'update_item'                => __( 'Update Seller Type', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Seller Type', 'onwork-core' ),
                'new_item_name'              => __( 'New Seller Type Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Seller Type with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Seller Type', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Seller Type', 'onwork-core' ),
                'not_found'                  => __( 'No Seller Type found.', 'onwork-core' ),
                'menu_name'                  => __( 'Seller Type', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'project-seller-type'),
        ));

        register_taxonomy('project-duration', array('projects'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Project Duration', 'onwork-core' ),
                'search_items'               => __( 'Search Project Duration', 'onwork-core' ),
                'popular_items'              => __( 'Popular Project Duration', 'onwork-core' ),
                'all_items'                  => __( 'All Project Duration', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Project Duration', 'onwork-core' ),
                'update_item'                => __( 'Update Project Duration', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Project Duration', 'onwork-core' ),
                'new_item_name'              => __( 'New Project Duration Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Project Duration with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Project Duration', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Project Duration', 'onwork-core' ),
                'not_found'                  => __( 'No Project Duration found.', 'onwork-core' ),
                'menu_name'                  => __( 'Project Duration', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'project-duration'),
        ));

        register_taxonomy('english-level', array('projects'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'English Level', 'onwork-core' ),
                'search_items'               => __( 'Search English Level', 'onwork-core' ),
                'popular_items'              => __( 'Popular English Level', 'onwork-core' ),
                'all_items'                  => __( 'All English Levels', 'onwork-core' ),
                'edit_item'                  => __( 'Edit English Level', 'onwork-core' ),
                'update_item'                => __( 'Update English Level', 'onwork-core' ),
                'add_new_item'               => __( 'Add New English Level', 'onwork-core' ),
                'new_item_name'              => __( 'New English Level Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate English Level with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove English Level', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used English Levels', 'onwork-core' ),
                'not_found'                  => __( 'No English Level found.', 'onwork-core' ),
                'menu_name'                  => __( 'English Level', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'english-level'),
        )); 


        register_taxonomy('project-level', array('projects'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Project Level', 'onwork-core' ),
                'search_items'               => __( 'Search Project Level', 'onwork-core' ),
                'popular_items'              => __( 'Popular Project Level', 'onwork-core' ),
                'all_items'                  => __( 'All Project Level', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Project Level', 'onwork-core' ),
                'update_item'                => __( 'Update Project Level', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Project Level', 'onwork-core' ),
                'new_item_name'              => __( 'New Project Level Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Project Levels with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Project Level', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Project Levels', 'onwork-core' ),
                'not_found'                  => __( 'No Project Level found.', 'onwork-core' ),
                'menu_name'                  => __( 'Project Level', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'project-level'),
        ));

        register_taxonomy('project-label', array('projects'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Labels', 'onwork-core' ),
                'search_items'               => __( 'Search Labels', 'onwork-core' ),
                'popular_items'              => __( 'Popular Labels', 'onwork-core' ),
                'all_items'                  => __( 'All Labels', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Label', 'onwork-core' ),
                'update_item'                => __( 'Update Label', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Label', 'onwork-core' ),
                'new_item_name'              => __( 'New Label Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Labels with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Labels', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Labels', 'onwork-core' ),
                'not_found'                  => __( 'No Label found.', 'onwork-core' ),
                'menu_name'                  => __( 'Labels', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'labels'),
        ));

        register_taxonomy('skills', array('projects'), array(
            'hierarchical' => false,
            //'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Skills', 'onwork-core' ),
                'search_items'               => __( 'Search Skills', 'onwork-core' ),
                'popular_items'              => __( 'Popular Skills', 'onwork-core' ),
                'all_items'                  => __( 'All Skills', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Skill', 'onwork-core' ),
                'update_item'                => __( 'Update Skill', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Skill', 'onwork-core' ),
                'new_item_name'              => __( 'New Skill Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Skills with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Skills', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Skills', 'onwork-core' ),
                'not_found'                  => __( 'No Skill found.', 'onwork-core' ),
                'menu_name'                  => __( 'Skills', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            //'meta_box_cb' => false,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'skills'),
        ));

        register_taxonomy('languages', array('projects'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Languages', 'onwork-core' ),
                'search_items'               => __( 'Search Languages', 'onwork-core' ),
                'popular_items'              => __( 'Popular Languages', 'onwork-core' ),
                'all_items'                  => __( 'All Languages', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Language', 'onwork-core' ),
                'update_item'                => __( 'Update Language', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Language', 'onwork-core' ),
                'new_item_name'              => __( 'New Language Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Languages with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Languages', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Languages', 'onwork-core' ),
                'not_found'                  => __( 'No Language found.', 'onwork-core' ),
                'menu_name'                  => __( 'Languages', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'languages'),
        ));
        
        register_taxonomy('locations', array('projects'), array(
            'hierarchical' => true,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Locations', 'onwork-core' ),
                'search_items'               => __( 'Search Locations', 'onwork-core' ),
                'popular_items'              => __( 'Popular Locations', 'onwork-core' ),
                'all_items'                  => __( 'All Locations', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Location', 'onwork-core' ),
                'update_item'                => __( 'Update Location', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Location', 'onwork-core' ),
                'new_item_name'              => __( 'New Locations Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Locations with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Locations', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Locations', 'onwork-core' ),
                'not_found'                  => __( 'No Location found.', 'onwork-core' ),
                'menu_name'                  => __( 'Locations', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'locations'),
        ));


        // Services
        register_post_type('services', array(
            'labels' => array(
                'name' => __('Services', 'onwork-core'),
                'singular_name' => __('Services', 'onwork-core'),
                'menu_name' => __('Services', 'onwork-core'),
                'name_admin_bar' => __('Services', 'onwork-core'),
                'add_new' => __('Add New Service', 'onwork-core'),
                'add_new_item' => __('Add New Service', 'onwork-core'),
                'new_item' => __('New Services', 'onwork-core'),
                'edit_item' => __('Edit Services', 'onwork-core'),
                'view_item' => __('View Services', 'onwork-core'),
                'all_items' => __('All Services', 'onwork-core'),
                'search_items' => __('Search Services', 'onwork-core'),
                'not_found' => __('No Service Found.', 'onwork-core'),
            ),
            'menu_icon'      => 'dashicons-media-archive',
            'public'         => true,
            'has_archive'    => true,
            'show_ui'        => true,
            'show_in_menu'   => true,
            'rewrite'        => array( 'slug' => 'services' ),
            'supports'       => array( 'title','editor','author' )
        ));

        // Services taxonomy
        register_taxonomy('service-categories', array('services'), array(
            'hierarchical' => true,
            'show_ui' => true,
            'label' => __('Service Categories', 'onwork-core'),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'service-categories'),
        ));

        register_taxonomy('delivery-time', array('services'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Delivery Time', 'onwork-core' ),
                'search_items'               => __( 'Search Delivery Time', 'onwork-core' ),
                'popular_items'              => __( 'Popular Delivery Times', 'onwork-core' ),
                'all_items'                  => __( 'All Delivery Times', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Delivery Time', 'onwork-core' ),
                'update_item'                => __( 'Update Delivery Time', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Delivery Time', 'onwork-core' ),
                'new_item_name'              => __( 'New Delivery Time Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Delivery Times with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Delivery Time', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Delivery Times', 'onwork-core' ),
                'not_found'                  => __( 'No Delivery Time found.', 'onwork-core' ),
                'menu_name'                  => __( 'Delivery Time', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'delivery-time'),
        ));

        register_taxonomy('service-english-level', array('services'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'English Level', 'onwork-core' ),
                'search_items'               => __( 'Search English Level', 'onwork-core' ),
                'popular_items'              => __( 'Popular English Level', 'onwork-core' ),
                'all_items'                  => __( 'All English Levels', 'onwork-core' ),
                'edit_item'                  => __( 'Edit English Level', 'onwork-core' ),
                'update_item'                => __( 'Update English Level', 'onwork-core' ),
                'add_new_item'               => __( 'Add New English Level', 'onwork-core' ),
                'new_item_name'              => __( 'New English Level Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate English Level with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove English Level', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used English Levels', 'onwork-core' ),
                'not_found'                  => __( 'No English Level found.', 'onwork-core' ),
                'menu_name'                  => __( 'English Level', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'service-english-level'),
        ));

        register_taxonomy('service-locations', array('services'), array(
            'hierarchical' => true,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Locations', 'onwork-core' ),
                'search_items'               => __( 'Search Locations', 'onwork-core' ),
                'popular_items'              => __( 'Popular Locations', 'onwork-core' ),
                'all_items'                  => __( 'All Locations', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Location', 'onwork-core' ),
                'update_item'                => __( 'Update Location', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Location', 'onwork-core' ),
                'new_item_name'              => __( 'New Locations Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Locations with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Locations', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Locations', 'onwork-core' ),
                'not_found'                  => __( 'No Location found.', 'onwork-core' ),
                'menu_name'                  => __( 'Locations', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'service-locations'),
        ));


        //Buyers
        register_post_type(
            'buyers', array(
            'labels' => array(
                'name' => __('Buyers', 'onwork-core'),
                'singular_name' => __('Buyer', 'onwork-core'),
                'menu_name' => __('Buyers', 'onwork-core'),
                'name_admin_bar' => __('Buyers', 'onwork-core'),
                'add_new' => __('Add New Buyer', 'onwork-core'),
                'add_new_item' => __('Add New Buyer', 'onwork-core'),
                'new_item' => __('New Buyer', 'onwork-core'),
                'edit_item' => __('Edit Buyer', 'onwork-core'),
                'view_item' => __('View Buyer', 'onwork-core'),
                'all_items' => __('All Buyers', 'onwork-core'),
                'search_items' => __('Search Buyer', 'onwork-core'),
                'not_found' => __('No Buyer Found.', 'onwork-core'),
            ),
            'menu_icon'      => 'dashicons-businessperson',
            'public'         => true,
            'has_archive'    => true,
            'show_ui'        => true,
            'show_in_menu'   => true,
            'rewrite'        => array( 'slug' => 'buyers' ),
            'supports'       => array( 'title','editor' ),
            'capabilities' => array(
                'create_posts' => false,
            ),
            'map_meta_cap' => true
        ));

        // Buyers taxonomy
        register_taxonomy('buyer-departments', array('buyers'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Departments', 'onwork-core' ),
                'search_items'               => __( 'Search Department', 'onwork-core' ),
                'popular_items'              => __( 'Popular Departments', 'onwork-core' ),
                'all_items'                  => __( 'All Departments', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Department', 'onwork-core' ),
                'update_item'                => __( 'Update Department', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Department', 'onwork-core' ),
                'new_item_name'              => __( 'New Department Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Departments with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Department', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Departments', 'onwork-core' ),
                'not_found'                  => __( 'No Department found.', 'onwork-core' ),
                'menu_name'                  => __( 'Departments', 'onwork-core' ),
            ),
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'departments'),
        ));

        register_taxonomy('employees-number', array('buyers'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'No. of Employees', 'onwork-core' ),
                'search_items'               => __( 'Search No. of Employees', 'onwork-core' ),
                'popular_items'              => __( 'Popular No. of Employees', 'onwork-core' ),
                'all_items'                  => __( 'All No. of Employees', 'onwork-core' ),
                'edit_item'                  => __( 'Edit No. of Employees', 'onwork-core' ),
                'update_item'                => __( 'Update No. of Employees', 'onwork-core' ),
                'add_new_item'               => __( 'Add New No. of Employee', 'onwork-core' ),
                'new_item_name'              => __( 'New No. of Employee Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate No. of Employees with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove No. of Employees', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used No. of Employees', 'onwork-core' ),
                'not_found'                  => __( 'No No. of Employee found.', 'onwork-core' ),
                'menu_name'                  => __( 'No. of Employees', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'employees-number'),
        ));

        register_taxonomy('buyer-locations', array('buyers'), array(
            'hierarchical' => true,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Locations', 'onwork-core' ),
                'search_items'               => __( 'Search Locations', 'onwork-core' ),
                'popular_items'              => __( 'Popular Locations', 'onwork-core' ),
                'all_items'                  => __( 'All Locations', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Location', 'onwork-core' ),
                'update_item'                => __( 'Update Location', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Location', 'onwork-core' ),
                'new_item_name'              => __( 'New Locations Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Locations with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Locations', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Locations', 'onwork-core' ),
                'not_found'                  => __( 'No Location found.', 'onwork-core' ),
                'menu_name'                  => __( 'Locations', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'buyer-locations'),
        ));


        //Sellers
        register_post_type(
            'sellers', array(
            'labels' => array(
                'name' => __('Sellers', 'onwork-core'),
                'singular_name' => __('Seller', 'onwork-core'),
                'menu_name' => __('Sellers', 'onwork-core'),
                'name_admin_bar' => __('Seller', 'onwork-core'),
                'add_new' => __('Add New Seller', 'onwork-core'),
                'add_new_item' => __('Add New seller', 'onwork-core'),
                'new_item' => __('New seller', 'onwork-core'),
                'edit_item' => __('Edit seller', 'onwork-core'),
                'view_item' => __('View seller', 'onwork-core'),
                'all_items' => __('All sellers', 'onwork-core'),
                'search_items' => __('Search seller', 'onwork-core'),
                'not_found' => __('No seller Found.', 'onwork-core'),
            ),
            'menu_icon'      => 'dashicons-nametag',
            'public'         => true,
            'has_archive'    => true,
            'show_ui'        => true,
            'show_in_menu'   => true,
            'rewrite'        => array( 'slug' => 'sellers' ),
            'supports'       => array( 'title','editor' ),
            'capabilities' => array(
                'create_posts' => false,
            ),
            'map_meta_cap' => true
        ));

        // Sellers taxonomy
        register_taxonomy('seller-skills', array('sellers'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Skills', 'onwork-core' ),
                'search_items'               => __( 'Search Skills', 'onwork-core' ),
                'popular_items'              => __( 'Popular Skills', 'onwork-core' ),
                'all_items'                  => __( 'All Skills', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Skill', 'onwork-core' ),
                'update_item'                => __( 'Update Skill', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Skill', 'onwork-core' ),
                'new_item_name'              => __( 'New Skill Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Skills with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Skills', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Skills', 'onwork-core' ),
                'not_found'                  => __( 'No Skills found.', 'onwork-core' ),
                'menu_name'                  => __( 'Skills', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'skills'),
        ));

        register_taxonomy('seller-locations', array('sellers'), array(
            'hierarchical' => true,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Locations', 'onwork-core' ),
                'search_items'               => __( 'Search Locations', 'onwork-core' ),
                'popular_items'              => __( 'Popular Locations', 'onwork-core' ),
                'all_items'                  => __( 'All Locations', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Location', 'onwork-core' ),
                'update_item'                => __( 'Update Location', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Location', 'onwork-core' ),
                'new_item_name'              => __( 'New Locations Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Locations with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Locations', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Locations', 'onwork-core' ),
                'not_found'                  => __( 'No Location found.', 'onwork-core' ),
                'menu_name'                  => __( 'Locations', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'seller-locations'),
        ));

        register_taxonomy('seller-languages', array('sellers'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Languages', 'onwork-core' ),
                'search_items'               => __( 'Search Languages', 'onwork-core' ),
                'popular_items'              => __( 'Popular Languages', 'onwork-core' ),
                'all_items'                  => __( 'All Languages', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Language', 'onwork-core' ),
                'update_item'                => __( 'Update Language', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Language', 'onwork-core' ),
                'new_item_name'              => __( 'New Language Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Languages with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Languages', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Languages', 'onwork-core' ),
                'not_found'                  => __( 'No Language found.', 'onwork-core' ),
                'menu_name'                  => __( 'Languages', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'languages'),
        ));
        

        register_taxonomy('seller-type', array('sellers'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'Seller Type', 'onwork-core' ),
                'search_items'               => __( 'Search Seller Type', 'onwork-core' ),
                'popular_items'              => __( 'Popular Seller Type', 'onwork-core' ),
                'all_items'                  => __( 'All Selle Type', 'onwork-core' ),
                'edit_item'                  => __( 'Edit Seller Type', 'onwork-core' ),
                'update_item'                => __( 'Update Seller Type', 'onwork-core' ),
                'add_new_item'               => __( 'Add New Seller Type', 'onwork-core' ),
                'new_item_name'              => __( 'New Seller Type Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate Seller Type with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove Seller Type', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used Seller Type', 'onwork-core' ),
                'not_found'                  => __( 'No Seller Type found.', 'onwork-core' ),
                'menu_name'                  => __( 'Seller Type', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'seller-type'),
        ));

        register_taxonomy('seller-english-level', array('sellers'), array(
            'hierarchical' => false,
            'show_ui' => true,
            'labels' => array(
                'name'                       => __( 'English Level', 'onwork-core' ),
                'search_items'               => __( 'Search English Level', 'onwork-core' ),
                'popular_items'              => __( 'Popular English Level', 'onwork-core' ),
                'all_items'                  => __( 'All English Levels', 'onwork-core' ),
                'edit_item'                  => __( 'Edit English Level', 'onwork-core' ),
                'update_item'                => __( 'Update English Level', 'onwork-core' ),
                'add_new_item'               => __( 'Add New English Level', 'onwork-core' ),
                'new_item_name'              => __( 'New English Level Name', 'onwork-core' ),
                'separate_items_with_commas' => __( 'Separate English Level with commas', 'onwork-core' ),
                'add_or_remove_items'        => __( 'Add or remove English Level', 'onwork-core' ),
                'choose_from_most_used'      => __( 'Choose from the most used English Levels', 'onwork-core' ),
                'not_found'                  => __( 'No English Level found.', 'onwork-core' ),
                'menu_name'                  => __( 'English Level', 'onwork-core' ),
            ),
            'show_admin_column' => true,
            'query_var' => true,
            'meta_box_cb' => false,
            'rewrite' => array('slug' => 'seller-english-level'),
        ));

        // Payouts
        register_post_type('payouts', array(
            'labels' => array(
                'name' => __('Payouts', 'onwork-core'),
                'singular_name' => __('Payouts', 'onwork-core'),
                'menu_name' => __('Payouts', 'onwork-core'),
                'name_admin_bar' => __('Payouts', 'onwork-core'),
                'add_new' => __('Add New Payout', 'onwork-core'),
                'add_new_item' => __('Add New Payout', 'onwork-core'),
                'new_item' => __('New Payouts', 'onwork-core'),
                'edit_item' => __('Edit Payouts', 'onwork-core'),
                'view_item' => __('View Payouts', 'onwork-core'),
                'all_items' => __('All Payouts', 'onwork-core'),
                'search_items' => __('Search Payouts', 'onwork-core'),
                'not_found' => __('No Payout Found.', 'onwork-core'),
            ),
            'menu_icon'      => 'dashicons-money-alt',
            'public'         => true,
            'show_ui'        => true,
            'rewrite'        => array( 'slug' => 'payouts' ),
            'supports'       => array( 'title' ),
            'hierarchical'   => true,
            'has_archive'    => true,
            'capabilities'   => array(
                'create_posts' => false,
            ),
            'map_meta_cap' => true
        ));


        //Verification
        register_post_type(
            'verification', array(
            'labels' => array(
                'name' => __('Verification', 'onwork-core'),
                'singular_name' => __('Verification', 'onwork-core'),
                'menu_name' => __('Verification', 'onwork-core'),
                'name_admin_bar' => __('Verification', 'onwork-core'),
                'edit_item' => __('Edit Verification', 'onwork-core'),
                'view_item' => __('View Verification', 'onwork-core'),
                'all_items' => __('All Verification', 'onwork-core'),
                'search_items' => __('Search Verification', 'onwork-core'),
                'not_found' => __('No Verification Found.', 'onwork-core'),
            ),
            'menu_icon'      => 'dashicons-yes-alt',
            'public'         => false,
            'show_ui'        => true,
            'rewrite'        => array( 'slug' => 'verification' ),
            'supports'       => array( 'title' ),
            'capabilities' => array(
                'create_posts' => false,
            ),
            'map_meta_cap' => true
        ));


        // Disputes
        register_post_type('disputes', array(
            'public' => true,
            'labels' => array(
                'name' => __('Disputes', 'onwork-core'),
                'singular_name' => __('Disputes', 'onwork-core'),
                'menu_name' => __('Disputes', 'onwork-core'),
                'name_admin_bar' => __('Disputes', 'onwork-core'),
                'add_new' => __('Add New Dispute', 'onwork-core'),
                'add_new_item' => __('Add New Dispute', 'onwork-core'),
                'new_item' => __('New Disputes', 'onwork-core'),
                'edit_item' => __('Edit Disputes', 'onwork-core'),
                'view_item' => __('View Disputes', 'onwork-core'),
                'all_items' => __('All Disputes', 'onwork-core'),
                'search_items' => __('Search Disputes', 'onwork-core'),
                'not_found' => __('No Dispute Found.', 'onwork-core'),
            ),
            'menu_icon'      => 'dashicons-hammer',
            'public'         => false,
            'show_ui'        => true,
            'rewrite'        => array( 'slug' => 'disputes' ),
            'supports'       => array( 'title','editor' ),
            'hierarchical'   => false,
            'has_archive'    => false,
            'capabilities'   => array(
                'create_posts' => false,
            ),
            'map_meta_cap' => true
        ));

    }

    add_action( 'init', 'onwork_custom_post_type' );

}