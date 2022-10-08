<?php

/**
 * Define the metabox and field configurations.
 */
function prolancer_metaboxes()
{

    $currency_symbol = class_exists('WooCommerce') ? get_woocommerce_currency_symbol() : '';

    /**
     * Project metabox
     */
    $project = new_cmb2_box(array(
        'id'            => 'project_metabox',
        'title'         => esc_html__('Project details', 'prolancer'),
        'object_types'  => array('projects'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ));

    $project->add_field(array(
        'name'           => esc_html__('Project Categories', 'prolancer'),
        'id'             => 'project_categories',
        'taxonomy'       => 'project-categories',
        'type'           => 'taxonomy_select_hierarchical'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Seller type', 'prolancer'),
        'id'             => 'project_seller_type',
        'taxonomy'       => 'project-seller-type',
        'type'           => 'taxonomy_select',
    ));

    $project->add_field(array(
        'name'             => esc_html__('Project type', 'prolancer'),
        'id'               => 'project_type',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => array(
            'Fixed'                => esc_html__('Fixed', 'prolancer'),
            'Hourly'              => esc_html__('Hourly', 'prolancer')
        )
    ));

    $project->add_field(array(
        'name'           => esc_html__('Project Price', 'prolancer'),
        'id'             => 'project_price',
        'type'           => 'text'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Estimated Hours', 'prolancer'),
        'id'             => 'estimated_hours',
        'type'           => 'text'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Project Duration', 'prolancer'),
        'id'             => 'project_duration',
        'taxonomy'       => 'project-duration',
        'type'           => 'taxonomy_select'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Project Level', 'prolancer'),
        'id'             => 'project_level',
        'taxonomy'       => 'project-level',
        'type'           => 'taxonomy_select'
    ));

    $project->add_field(array(
        'name'           => esc_html__('English Level', 'prolancer'),
        'id'             => 'english_level',
        'taxonomy'       => 'english-level',
        'type'           => 'taxonomy_select'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Locations', 'prolancer'),
        'id'             => 'locations',
        'taxonomy'       => 'locations',
        'type'           => 'taxonomy_select_hierarchical'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Project Label', 'prolancer'),
        'id'             => 'project_label',
        'taxonomy'       => 'project-label',
        'type'           => 'taxonomy_multicheck_inline'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Project skills', 'prolancer'),
        'id'             => 'skills',
        'taxonomy'       => 'skills',
        'type'           => 'taxonomy_multicheck_inline'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Languages', 'prolancer'),
        'id'             => 'languages',
        'taxonomy'       => 'languages',
        'type'           => 'taxonomy_multicheck_inline'
    ));

    $project->add_field(array(
        'name'           => esc_html__('Attachments', 'prolancer'),
        'id'             => 'attachments',
        'type'                       => 'file_list',
        'query_args'          => array('type' => array('txt', 'image/gif', 'image/jpeg', 'image/png')),
    ));

    $project->add_field(array(
        'name'           => esc_html__('Assign Project', 'prolancer'),
        'id'             => 'assign_project',
        'type'           => 'select',
        'show_option_none' => true,
        // 'options'        =>  prolancer_get_users(array('fields' => array('user_login')))
    ));

    $project->add_field(array(
        'name'           => esc_html__('Featured', 'prolancer'),
        'id'             => 'featured_project',
        'type'                       => 'checkbox',
        'sanitization_cb' => 'prolancer_sanitize_checkbox'
    ));

    /**
     * Service metabox
     */
    $service = new_cmb2_box(array(
        'title'         => esc_html__('Service details', 'prolancer'),
        'id'            => 'service_metabox',
        'object_types'  => array('services'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ));

    $service->add_field(array(
        'name'           => esc_html__('Service Category', 'prolancer'),
        'id'             => 'service_category',
        'taxonomy'       => 'service-categories',
        'type'           => 'taxonomy_select'
    ));

    $service->add_field(array(
        'name'           => esc_html__('English Level', 'prolancer'),
        'id'             => 'service_english_level',
        'taxonomy'       => 'service-english-level',
        'type'           => 'taxonomy_select'
    ));

    $service->add_field(array(
        'name'           => esc_html__('Locations', 'prolancer'),
        'id'             => 'service_locations',
        'taxonomy'       => 'service-locations',
        'type'           => 'taxonomy_select_hierarchical'

    ));

    $service->add_field(array(
        'name'           => esc_html__('Attachments', 'prolancer'),
        'id'             => 'service_attachments',
        'type'                  => 'file_list'
    ));

    $service->add_field(array(
        'name'           => esc_html__('Featured', 'prolancer'),
        'id'             => 'featured_service',
        'type'                       => 'checkbox',
        'sanitization_cb' => 'prolancer_sanitize_checkbox'
    ));


    /**
     * Buyer metabox
     */
    $buyer = new_cmb2_box(array(
        'id'            => 'buyer_metabox',
        'title'         => esc_html__('Buyer details', 'prolancer'),
        'object_types'  => array('buyers'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ));

    $buyer->add_field(array(
        'name'           => esc_html__('Profile name', 'prolancer'),
        'id'             => 'buyer_profile_name',
        'type'           => 'text'
    ));


    $buyer->add_field(array(
        'name'           => esc_html__('Profile Title', 'prolancer'),
        'id'             => 'buyer_profile_title',
        'type'           => 'text'
    ));

    $buyer->add_field(array(
        'name'           => esc_html__('Departments', 'prolancer'),
        'id'             => 'buyer_departments',
        'taxonomy'       => 'buyer-departments',
        'type'           => 'taxonomy_select'
    ));

    $buyer->add_field(array(
        'name'           => esc_html__('No. of Employees', 'prolancer'),
        'id'             => 'employees_number',
        'taxonomy'       => 'employees-number',
        'type'           => 'taxonomy_select'
    ));

    $buyer->add_field(array(
        'name'           => esc_html__('Locations', 'prolancer'),
        'id'             => 'buyer_locations',
        'taxonomy'       => 'buyer-locations',
        'type'           => 'taxonomy_select'
    ));

    $buyer->add_field(array(
        'name'           => esc_html__('Profile Picture', 'prolancer'),
        'id'             => 'buyer_profile_attachment',
        'type'           => 'file',
        'options'              => array(
            'url'                   => true,
        ),
        'preview_size' => 'large'
    ));

    $buyer->add_field(array(
        'name'           => esc_html__('Cover Picture', 'prolancer'),
        'id'             => 'buyer_cover_attachment',
        'type'           => 'file',
        'options'              => array(
            'url'                  => true,
        ),
        'preview_size' => 'large'
    ));


    /**
     * Seller metabox
     */
    $seller = new_cmb2_box(array(
        'id'            => 'seller_metabox',
        'title'         => esc_html__('Seller details', 'prolancer'),
        'object_types'  => array('sellers'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ));

    $seller->add_field(array(
        'name' => esc_html__('Profile name', 'prolancer'),
        'id'   => 'seller_profile_name',
        'type' => 'text'
    ));


    $seller->add_field(array(
        'name' => esc_html__('Profile Title', 'prolancer'),
        'id'   => 'seller_profile_title',
        'type' => 'text'
    ));

    $seller->add_field(array(
        'name' => esc_html__('Hourly Rate', 'prolancer'),
        'id'   => 'seller_hourly_rate',
        'type' => 'text'
    ));

    $seller->add_field(array(
        'name'       => esc_html__('Seller Gender', 'prolancer'),
        'id'         => 'seller_gender',
        'type'       => 'select',
        'options'    => array(
            'Male'          => esc_html__('Male', 'prolancer'),
            'Female'   => esc_html__('Female', 'prolancer')
        )
    ));

    $seller->add_field(array(
        'name'           => esc_html__('Seller Type', 'prolancer'),
        'id'             => 'seller_type',
        'taxonomy'       => 'seller-type',
        'type'           => 'taxonomy_select'
    ));

    $seller->add_field(array(
        'name'           => esc_html__('English Level', 'prolancer'),
        'id'             => 'seller_english_level',
        'taxonomy'       => 'seller-english-level',
        'type'           => 'taxonomy_select'
    ));

    $seller->add_field(array(
        'name'           => esc_html__('Languages', 'prolancer'),
        'id'             => 'seller_languages',
        'taxonomy'       => 'seller-languages',
        'type'           => 'taxonomy_multicheck_inline'
    ));

    $seller->add_field(array(
        'name'           => esc_html__('Locations', 'prolancer'),
        'id'             => 'seller_locations',
        'taxonomy'       => 'seller-locations',
        'type'           => 'taxonomy_select'
    ));

    $seller->add_field(array(
        'name'    => esc_html__('Profile Picture', 'prolancer'),
        'id'      => 'seller_profile_attachment',
        'type'    => 'file',
        'options' => array(
            'url'     => true,
        ),
        'preview_size' => 'large'
    ));

    $seller->add_field(array(
        'name'    => esc_html__('Cover Picture', 'prolancer'),
        'id'      => 'seller_cover_attachment',
        'type'    => 'file',
        'options' => array(
            'url'     => true,
        ),
        'preview_size' => 'large'
    ));

    $seller->add_field(array(
        'name'  => esc_html__('Address', 'prolancer'),
        'id'    => 'seller_address',
        'type'  => 'textarea'
    ));


    /**
     * Payouts
     */
    $payout = new_cmb2_box(array(
        'id'            => 'payout_metabox',
        'title'         => esc_html__('Payout details', 'prolancer'),
        'object_types'  => array('payouts'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Payout method', 'prolancer'),
        'id'         => 'payout_method',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));


    $payout->add_field(array(
        'name'       => esc_html__('Payout amount', 'prolancer'),
        'id'         => 'payout_amount',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Paypal', 'prolancer'),
        'id'         => 'paypal_email',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Payoneer', 'prolancer'),
        'id'         => 'payoneer_email',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Bank', 'prolancer'),
        'id'         => 'bank_name',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Bank account number', 'prolancer'),
        'id'         => 'bank_account_number',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Routing number', 'prolancer'),
        'id'         => 'routing_number',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));


    $payout->add_field(array(
        'name'       => esc_html__('IBAN', 'prolancer'),
        'id'         => 'iban',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));


    $payout->add_field(array(
        'name'       => esc_html__('BIC / SWIFT-code', 'prolancer'),
        'id'         => 'bic_swift_code',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Bank address', 'prolancer'),
        'id'         => 'bank_address',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('First Name', 'prolancer'),
        'id'         => 'payout_first_name',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Last Name', 'prolancer'),
        'id'         => 'payout_last_name',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Address', 'prolancer'),
        'id'         => 'payout_address',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    $payout->add_field(array(
        'name'       => esc_html__('Country', 'prolancer'),
        'id'         => 'payout_country',
        'type'       => 'text',
        'attributes' => array(
            'readonly' => 'readonly'
        )
    ));

    /**
     * Disputes
     */
    $dispute = new_cmb2_box(array(
        'id'            => 'dispute_metabox',
        'title'         => esc_html__('Dispute details', 'prolancer'),
        'object_types'  => array('disputes'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true
    ));

    $dispute->add_field(array(
        'name'          => esc_html__('Buyer', 'prolancer'),
        'id'            => 'dispute_buyer',
        'type'          => 'text',
        'attributes'    => array(
            'readonly'    => 'readonly'
        )
    ));

    $dispute->add_field(array(
        'id'             => 'dispute_buyer_id',
        'type'           => 'hidden'
    ));

    $dispute->add_field(array(
        'name'           => esc_html__('Seller', 'prolancer'),
        'id'             => 'dispute_seller',
        'type'           => 'text',
        'attributes'     => array(
            'readonly'     => 'readonly'
        )
    ));

    $dispute->add_field(array(
        'id'             => 'dispute_seller_id',
        'type'           => 'hidden'
    ));

    $dispute->add_field(array(
        'name'           => esc_html__('Price ', 'prolancer') . $currency_symbol,
        'id'             => 'dispute_price',
        'type'           => 'text'
    ));
}
add_action('cmb2_admin_init', 'prolancer_metaboxes');

// Sanitize checkbox
function prolancer_sanitize_checkbox($value, $field_args, $field)
{
    // Return '1' instead of 'on'.
    return is_null($value) ? 0 : 1;
}

// Custom repeatable field
function prolancer_custom_meta_boxes()
{
    /* Add meta boxes on the 'add_meta_boxes' hook. */
    function prolancer_add_meta_boxes()
    {
        add_meta_box(
            'seller-details',      // Unique ID
            esc_html__('Seller Details', 'prolancer'),    // Title
            'seller_meta_box',   // Callback function
            'sellers',
            'normal',         // Context
            'default'         // Priority
        );
        add_meta_box(
            'service-packages',      // Unique ID
            esc_html__('Packages', 'prolancer'),    // Title
            'service_package_meta_box',   // Callback function
            'services',
            'normal',         // Context
            'default'         // Priority
        );
        add_meta_box(
            'additional-services',      // Unique ID
            esc_html__('Additional Services', 'prolancer'),    // Title
            'additional_service_meta_box',   // Callback function
            'services',
            'normal',         // Context
            'default'         // Priority
        );
        add_meta_box(
            'service-faqs',      // Unique ID
            esc_html__('FAQs', 'prolancer'),    // Title
            'service_faq_meta_box',   // Callback function
            'services',
            'normal',         // Context
            'default'         // Priority
        );
        add_meta_box(
            'verification-details',      // Unique ID
            esc_html__('Verification', 'prolancer'),    // Title
            'verification_meta_box',   // Callback function
            'verification',
            'normal',         // Context
            'default'         // Priority
        );
    }
    add_action('add_meta_boxes', 'prolancer_add_meta_boxes');

    function seller_meta_box($post)
    { ?>
        <div class="skills sortable">
            <?php
            $skills =  json_decode(stripslashes(get_post_meta($post->ID, 'seller_skills', true)), true);

            if (!empty($skills)) {
                for ($i = 0; $i < count($skills); $i++) { ?>
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-sm-1">
                                <i class="dashicons dashicons-menu"></i>
                            </div>
                            <div class="col-sm-5 my-auto">
                                <select name="seller_skills[]" class="form-control">
                                    <option><?php echo esc_html__('Skills', 'prolancer'); ?></option>
                                    <?php
                                    $terms = get_terms(array(
                                        'taxonomy' => 'seller-skills',
                                        'hide_empty' => false,
                                        'orderby'      => 'name'
                                    ));

                                    foreach ($terms as $term) { ?>
                                        <option value="<?php echo esc_attr($term->term_id) ?>" <?php if ($term->term_id == $skills[$i]['skill']) {
                                                                                                    echo 'selected ="selected"';
                                                                                                } ?>><?php echo esc_html($term->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-5 my-auto">
                                <input type="number" name='skills_percent[]' class="form-control" min="0" max="100" value="<?php echo esc_attr($skills[$i]['percent']) ?>" placeholder="<?php echo esc_html__('Percentage', 'prolancer'); ?>">
                            </div>
                            <div class="col-sm-1">
                                <i class="dashicons dashicons-trash"></i>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        <a href="#" class="add-new-skill button-primary" data-nonce="<?php echo wp_create_nonce('skill_nonce'); ?>"><?php echo esc_html__("Add New Skill", 'prolancer'); ?> </a>
    <?php }

    function service_package_meta_box($post)
    {
        global $prolancer_opt;

        $prolancer_packages = !empty($prolancer_opt['prolancer_packages']) ? $prolancer_opt['prolancer_packages'] : '';
        $prolancer_package_feature = !empty($prolancer_opt['prolancer_package_feature']) ? $prolancer_opt['prolancer_package_feature'] : '';
        $packages = json_decode(get_post_meta($post->ID, 'packages', true), true);

        if ($packages) {
            foreach ($packages as $key => $package) {
                $features = $package['features'];
            }
        } ?>
        <div class="packages">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <?php for ($i = 0; $i < $prolancer_packages; $i++) { ?>
                            <th scope="col"><?php echo esc_html__('Package ', 'prolancer') . $i ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo esc_html__('Name', 'prolancer') ?></td>
                        <?php for ($i = 0; $i < $prolancer_packages; $i++) { ?>
                            <td><input type="text" name="package_name[]" placeholder="<?php echo esc_attr('Name your package', 'prolancer'); ?>" value="<?php if (!empty($packages)) {
                                                                                                                                                            echo esc_attr($packages[$i]['name']);
                                                                                                                                                        } ?>"></td>

                        <?php } ?>
                    </tr>
                    <tr>
                        <td><?php echo esc_html__('Description', 'prolancer') ?></td>
                        <?php for ($i = 0; $i < $prolancer_packages; $i++) { ?>
                            <td><textarea name="package_description[]" placeholder="<?php echo esc_attr('Describe the details of your offering', 'prolancer'); ?>"><?php if (!empty($packages)) {
                                                                                                                                                                        echo esc_html($packages[$i]['description']);
                                                                                                                                                                    } ?></textarea></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><?php echo esc_html__('Delivery Time', 'prolancer') ?></td>
                        <?php for ($i = 0; $i < $prolancer_packages; $i++) { ?>
                            <td>
                                <select name="package_delivery_time[]" class="form-control">
                                    <option><?php echo esc_html__('Delivery Time', 'prolancer'); ?></option>
                                    <?php
                                    if (!empty($packages)) {
                                        $package_delivery_time = get_term_by('id', $packages[$i]['delivery_time'], 'delivery-time');
                                    }

                                    $delivery_times = get_terms(array(
                                        'taxonomy' => 'delivery-time',
                                        'hide_empty' => false
                                    ));

                                    foreach ($delivery_times as $delivery_time) { ?>
                                        <option value="<?php echo esc_attr($delivery_time->term_id); ?>" <?php if (!empty($package_delivery_time)) {
                                                                                                                selected($package_delivery_time->term_id, $delivery_time->term_id);
                                                                                                            } ?>><?php echo esc_html($delivery_time->name); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><?php echo esc_html__('Revisions', 'prolancer') ?></td>
                        <?php for ($i = 0; $i < $prolancer_packages; $i++) { ?>
                            <td><input type="number" name="package_revision[]" placeholder="<?php echo esc_attr('3', 'prolancer') ?>" value="<?php if (!empty($packages)) {
                                                                                                                                                echo esc_attr($packages[$i]['revision']);
                                                                                                                                            } ?>"></td>
                        <?php } ?>
                    </tr>
                    <?php foreach ($prolancer_package_feature as $feature) { ?>
                        <tr>
                            <td><?php echo esc_html(ucwords(str_replace('packagefeature', '', str_replace('_', ' ', $feature)))) ?></td>
                            <?php for ($i = 0; $i < $prolancer_packages; $i++) {
                                if (isset($package)) {
                                    $feature_value = $package['features']['packagefeature_' . str_replace(' ', '_', strtolower($feature))][$i];
                                } ?>
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input" <?php if (!empty($packages)) {
                                                                                        if ($feature_value == 'yes') {
                                                                                            echo "checked";
                                                                                        }
                                                                                    } ?>>
                                    <input type="hidden" name="<?php echo esc_attr('packagefeature_' . str_replace(' ', '_', strtolower($feature))) ?>[]" value="<?php if (!empty($packages)) {
                                                                                                                                                                    if ($feature_value == 'yes') {
                                                                                                                                                                        echo "yes";
                                                                                                                                                                    } else {
                                                                                                                                                                        echo "no";
                                                                                                                                                                    }
                                                                                                                                                                } ?>">
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td><?php echo esc_html__('Price', 'prolancer') ?></td>
                        <?php for ($i = 0; $i < $prolancer_packages; $i++) { ?>
                            <td><input type="number" name="package_price[]" placeholder="<?php echo esc_attr(prolancer_get_currency_symbol()); ?>" value="<?php echo esc_attr($packages[$i]['price']); ?>"></td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php }

    function additional_service_meta_box($post)
    {
        $additional_services =  json_decode(stripslashes(get_post_meta($post->ID, 'additional_services', true)), true);
    ?>
        <div class="additional-services sortable">
            <?php
            if (!empty($additional_services)) {
                for ($i = 0; $i < count($additional_services); $i++) { ?>
                    <div class="row mb-4">
                        <div class="col-sm-1">
                            <i class="dashicons dashicons-menu"></i>
                        </div>
                        <div class="col-sm-10 my-auto">
                            <input type="text" name='additional_service_title[]' class="form-control" value="<?php echo esc_attr($additional_services[$i]['title']) ?>" placeholder="<?php echo esc_html__('Title', 'prolancer'); ?>">
                            <textarea name='additional_service_description[]' class="form-control" value="<?php echo esc_attr($additional_services[$i]['description']) ?>" placeholder="<?php echo esc_html__('Description', 'prolancer'); ?>"><?php echo esc_html($additional_services[$i]['description']) ?></textarea>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input type="number" name='additional_service_price[]' class="form-control mb-0" value="<?php echo esc_attr($additional_services[$i]['price']) ?>" placeholder="<?php echo esc_html__('Price', 'prolancer'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <i class="dashicons dashicons-trash"></i>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        <a href="#" class="add-additional-service prolancer-btn button-primary" data-nonce="<?php echo wp_create_nonce('additional_service_nonce'); ?>"><?php echo esc_html__("Add Extra Service", 'prolancer'); ?> </a>
    <?php }

    function service_faq_meta_box($post)
    { ?>
        <div class="faqs sortable">
            <?php
            $faqs =  json_decode(stripslashes(get_post_meta($post->ID, 'service_faqs', true)), true);

            if (!empty($faqs)) {
                for ($i = 0; $i < count($faqs); $i++) { ?>
                    <div class="row mb-3">
                        <div class="col-sm-1">
                            <i class="dashicons dashicons-menu"></i>
                        </div>
                        <div class="col-sm-10 my-auto">
                            <input type="text" name='faq_title[]' class="form-control" value="<?php echo esc_attr($faqs[$i]['title']) ?>" placeholder="<?php echo esc_html__('Title', 'prolancer'); ?>">
                            <textarea name='faq_description[]' class="form-control" value="<?php echo esc_attr($faqs[$i]['description']) ?>" placeholder="<?php echo esc_html__('Description', 'prolancer'); ?>"><?php echo esc_html($faqs[$i]['description']) ?></textarea>
                        </div>
                        <div class="col-sm-1">
                            <i class="dashicons dashicons-trash"></i>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        <a href="#" class="add-new-faq button-primary"><?php echo esc_html__("Add New FAQ", 'prolancer'); ?> </a>
    <?php }

    function verification_meta_box($post)
    { ?>
        <div class="verification">
            <?php
            $verification = json_decode(stripslashes(get_user_meta($post->post_author, 'verification', true)), true); ?>
            <div class="mb-3 container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (!empty($verification['my_country_field'])) { ?>
                            <h3><?php echo esc_html__('Country', 'prolancer'); ?></h3>
                            <input type="text" class="regular-text" value="<?php echo esc_attr(WC()->countries->countries[$verification['my_country_field']]); ?>">
                            <input type="hidden" name="my_country_field" value="<?php echo esc_attr($verification['my_country_field']); ?>">
                        <?php }
                        if (!empty($verification['user_passport_attachment'])) { ?>
                            <input type="hidden" name="user_passport_attachment" value="<?php echo esc_attr($verification['user_passport_attachment']); ?>">
                            <h3><?php echo esc_html__('Passport', 'prolancer'); ?></h3>
                            <?php echo wp_get_attachment_image($verification['user_passport_attachment'], array('400', '300'), "", array("class" => "img-responsive"));  ?>
                        <?php }
                        if (!empty($verification['user_drivers_license_attachment'])) { ?>
                            <input type="hidden" name="user_drivers_license_attachment" value="<?php echo esc_attr($verification['user_drivers_license_attachment']); ?>">
                            <h3><?php echo esc_html__('Driver\'s license', 'prolancer'); ?></h3>
                            <?php echo wp_get_attachment_image($verification['user_drivers_license_attachment'], array('400', '300'), "", array("class" => "img-responsive"));  ?>
                        <?php } ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <?php if (!empty($verification['user_id_front_attachment'])) { ?>
                            <input type="hidden" name="user_id_front_attachment" value="<?php echo esc_attr($verification['user_id_front_attachment']); ?>">
                            <h3><?php echo esc_html__('Identity card front', 'prolancer'); ?></h3>
                            <?php echo wp_get_attachment_image($verification['user_id_front_attachment'], array('400', '300'), "", array("class" => "img-responsive"));  ?>
                        <?php } ?>
                    </div>
                    <div class="col-sm-6">
                        <?php if (!empty($verification['user_id_back_attachment'])) { ?>
                            <input type="hidden" name="user_id_back_attachment" value="<?php echo esc_attr($verification['user_id_back_attachment']); ?>">
                            <h3><?php echo esc_html__('Identity card back', 'prolancer'); ?></h3>
                            <?php echo wp_get_attachment_image($verification['user_id_back_attachment'], array('400', '300'), "", array("class" => "img-responsive"));  ?>
                        <?php } ?>
                    </div>

                    <input type="radio" id="approve" name="verified" value="yes" <?php if ($verification['verified'] == 'yes') {
                                                                                        echo 'checked';
                                                                                    } ?>>
                    <label for="approve"><?php echo esc_html__('Approve', 'prolancer'); ?></label>

                    <input type="radio" id="reject" name="verified" value="rejected" <?php if ($verification['verified'] == 'rejected') {
                                                                                            echo 'checked';
                                                                                        } ?>>
                    <label for="reject"><?php echo esc_html__('Reject', 'prolancer'); ?></label>
                </div>
            </div>
        </div>

<?php }

    /* Save post meta on the 'save_post' hook. */
    function prolancer_save_post($post)
    {

        // Seller Skills
        if (isset($_POST['seller_skills'])) {
            $skill_name = array_unique($_POST['seller_skills']);
            $skill_percent = $_POST['skills_percent'];
            $integerIDs = array_map('intval', $_POST['seller_skills']);

            for ($i = 0; $i < count($skill_name); $i++) {
                $skill_id = $skill_name[$i];
                $percent = $skill_percent[$i];
                $skills[] = array(
                    "skill" => $skill_id,
                    "percent" => $percent
                );
            }

            $json_skills =  json_encode($skills, JSON_UNESCAPED_UNICODE);

            wp_set_post_terms($post, $integerIDs, 'seller-skills', false);
            update_post_meta($post, 'seller_skills', $json_skills);
        } elseif (isset($_POST['seller_skills'])) {
            wp_set_post_terms($post, '', 'seller-skills', false);
            update_post_meta($post, 'seller_skills', '');
        }

        // Service Packages		
        if (isset($_POST['package_price'])) {
            global $prolancer_opt;
            $prolancer_package_feature = !empty($prolancer_opt['prolancer_package_feature']) ? $prolancer_opt['prolancer_package_feature'] : '';

            $package_name = $_POST['package_name'];
            $package_description = $_POST['package_description'];
            $package_delivery_time = $_POST['package_delivery_time'];
            $package_revision = $_POST['package_revision'];

            $package_price = $_POST['package_price'];

            foreach ($prolancer_package_feature as $feature) {
                $package_features['packagefeature_' . str_replace(' ', '_', strtolower($feature))] = $_POST['packagefeature_' . str_replace(' ', '_', strtolower($feature))];
            }

            update_post_meta($post, 'service_price', json_encode((int)$package_price[0]));

            for ($i = 0; $i < count($package_price); $i++) {
                $name = $package_name[$i];
                $description = $package_description[$i];
                $delivery_time = $package_delivery_time[$i];
                $revision = $package_revision[$i];
                $features = $package_features;
                $price = $package_price[$i];

                $packages[] = array(
                    "name" => $name,
                    "description" => $description,
                    "delivery_time" => $delivery_time,
                    "revision" => $revision,
                    "features" => $features,
                    "price" => $price
                );
            }

            $json_packages =  json_encode($packages, JSON_UNESCAPED_UNICODE);

            update_post_meta($post, 'packages', $json_packages);
        } elseif (isset($_POST['package_price'])) {
            update_post_meta($post, 'packages', '');
        }

        // Additional Services
        if (isset($_POST['additional_service_title'])) {
            $service_title = $_POST['additional_service_title'];
            $service_description = $_POST['additional_service_description'];
            $service_price = $_POST['additional_service_price'];
            $service_delivery_time = $_POST['additional_service_delivery_time'];

            for ($i = 0; $i < count($service_title); $i++) {
                $title = $service_title[$i];
                $description = $service_description[$i];
                $price = $service_price[$i];
                $delivery_time = $service_delivery_time[$i];
                $services[] = array(
                    "title" => $title,
                    "description" => $description,
                    "price" => $price,
                    "delivery_time" => $delivery_time
                );
            }

            $json_additional_services =  json_encode($services, JSON_UNESCAPED_UNICODE);

            update_post_meta($post, 'additional_services', $json_additional_services);
        } elseif (isset($_POST['faq_title'])) {
            update_post_meta($post, 'additional_services', '');
        }


        // Service FAQs
        if (isset($_POST['faq_title'])) {
            $faq_title = $_POST['faq_title'];
            $faq_description = $_POST['faq_description'];

            for ($i = 0; $i < count($faq_title); $i++) {
                $title = $faq_title[$i];
                $description = $faq_description[$i];
                $faqs[] = array(
                    "title" => $title,
                    "description" => $description
                );
            }

            $json_faqs =  json_encode($faqs, JSON_UNESCAPED_UNICODE);

            update_post_meta($post, 'service_faqs', $json_faqs);
        } elseif (isset($_POST['faq_title'])) {
            update_post_meta($post, 'service_faqs', '');
        }

        // Verification
        if (isset($_POST['verified'])) {

            $json_verification =  json_encode(array(
                "verified" =>  $_POST['verified'],
                "user_passport_attachment" => $_POST['user_passport_attachment'],
                "user_drivers_license_attachment" => $_POST['user_drivers_license_attachment'],
                "user_id_front_attachment" => $_POST['user_id_front_attachment'],
                "user_id_back_attachment" => $_POST['user_id_back_attachment'],
                "my_country_field" => $_POST['my_country_field']
            ));

            update_user_meta($_POST['post_author'], 'verification', $json_verification);
        } elseif (isset($_POST['verified'])) {
            update_user_meta(isset($_POST['post_author']), 'verification', '');
        }
    }
    add_action('save_post', 'prolancer_save_post', 10, 2);
}

add_action('load-post.php', 'prolancer_custom_meta_boxes');
add_action('load-post-new.php', 'prolancer_custom_meta_boxes');
