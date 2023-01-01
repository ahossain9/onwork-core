<?php if (!empty($_GET['proposal_id'])) {
  $proposal_id = $_GET['proposal_id'];
}

if (is_user_logged_in()) {
  $buyer_id = get_user_meta(get_current_user_id(), 'buyer_id', true);
  global $wpdb;
  $table = 'onwork_project_proposals';

  if ($wpdb->get_var("SHOW TABLES LIKE '${table}'") == $table) {
    $query = "SELECT * FROM ${table} WHERE `id` = ${proposal_id} AND `buyer_id` = ${buyer_id} AND `status` ='ongoing' ORDER BY timestamp DESC LIMIT 1";
    $result = $wpdb->get_results($query, ARRAY_A)[0];
  }
} ?>

<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__('Ongoing Projects Details', 'prolancer'); ?></h2>
</div>
<?php if ($result) { ?>
  <div class="white-padding">
    <div class="table-responsive">
      <table class="prolancer-table">
        <thead>
          <tr>
            <th scope="col"><?php echo esc_html__('Hired Seller', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Project', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Day to complete', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Price', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Proposed Price', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Action', 'prolancer'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $project_id = $result['project_id'];
          $buyer_id = $result['buyer_id'];
          $seller_id = $result['seller_id'];
          $project = get_post($project_id); ?>
          <tr>
            <td>
              <a href="<?php echo esc_url(get_the_permalink($seller_id)) ?>" target="_blank">
                <?php $seller_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($seller_id, 'seller_profile_attachment', true)), array('50', '50'), false);

                if (!empty($seller_image)) {
                  echo wp_kses($seller_image, array(
                    "img" => array(
                      "src" => array(),
                      "alt" => array(),
                      "style" => array()
                    )
                  ));
                } else {
                  echo get_avatar(get_post_field('post_author', $seller_id), 50);
                } ?>
              </a>
            </td>
            <td>
              <a href="<?php echo get_the_permalink($project_id); ?>" target="_blank"><?php echo esc_html($project->post_title); ?></a>
            </td>
            <td><?php if (get_term_by('id', $result['day_to_complete'], 'project-duration')) {
                  echo esc_html(get_term_by('id', $result['day_to_complete'], 'project-duration')->name);
                } ?></td>
            <td>
              <?php
              $price = get_post_meta($project_id, 'project_price', true);

              if (function_exists('onwork_get_currency_symbol')) {
                echo esc_html(onwork_get_currency_symbol($price));
              } ?>
            </td>
            <td>
              <?php if (function_exists('onwork_get_currency_symbol')) {
                echo esc_html(onwork_get_currency_symbol($result['proposed_price']));
              } ?>
            </td>
            <td>
              <a href="#" class="prolancer-btn small-btn text-white" data-bs-toggle="modal" data-bs-target="#complete<?php echo esc_attr($seller_id); ?>">
                <?php echo esc_html__('Complete', 'prolancer'); ?>
              </a>
              <a href="#" id="project-cancel" class="prolancer-btn small-btn text-white bg-danger" data-nonce="<?php echo wp_create_nonce('project_project_cancel_nonce'); ?>" data-seller-id="<?php echo esc_attr($seller_id); ?>" data-buyer-id="<?php echo esc_attr($buyer_id); ?>" data-project-id="<?php echo esc_attr($project_id); ?>" data-proposal-id="<?php echo esc_attr($proposal_id); ?>"><?php echo esc_html__('Cancel', 'prolancer'); ?>
              </a>
              <!-- Modal -->
              <div class="modal fade" id="complete<?php echo esc_attr($seller_id); ?>" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <form id="review-form" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?php echo esc_html__('Write a review', 'prolancer'); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="rating-stars mb-2"></div>
                        <input class="d-none" type="text" id="rating-stars" name="rating-stars" value="" required>
                        <h6 class="mb-3"><?php echo esc_html__('Your Feedback', 'prolancer'); ?></h6>
                        <textarea name="review" placeholder="<?php echo esc_attr__('Review...', 'prolancer'); ?>" required></textarea>
                        <input type="hidden" name="project-id" value="<?php echo esc_attr($project_id); ?>">
                        <input type="hidden" name="buyer-id" value="<?php echo esc_attr($buyer_id); ?>">

                        <button type="submit" id="project-complete" data-nonce="<?php echo wp_create_nonce('project_complete_nonce'); ?>" data-proposal-id="<?php echo esc_attr($proposal_id); ?>" data-seller-id="<?php echo esc_attr($seller_id); ?>"><?php echo esc_html__('Submit', 'prolancer'); ?></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <?php
  global $wpdb;
  $table = 'onwork_project_messages';

  if ($wpdb->get_var("SHOW TABLES LIKE '${table}'") == $table) {
    $query = "SELECT * FROM ${table} WHERE `proposal_id` = ${proposal_id}";
    $messages = $wpdb->get_results($query);
    if ($messages) { ?>
      <div class="chat-box white-padding mt-4 mb-4">
        <?php

        foreach ($messages as $message) {

          $message_sender = get_user_meta(get_current_user_id(), 'buyer_id', true);
          $sender_id = $message->sender_id;
          $receiver_id = $message->receiver_id;

          if ($sender_id == $message_sender) { ?>
            <div class="chat-list message_sender">
              <div class="row">
                <div class="col-9">
                  <p><?php echo esc_html($message->message); ?></p>
                  <?php if ($message->attachment_id) { ?>
                    <a class="download" href="<?php echo esc_url(wp_get_attachment_url($message->attachment_id)); ?>" download><?php echo esc_html__('Download', 'prolancer') ?><i class="fad fa-download"></i></a>
                  <?php } ?>
                </div>
                <div class="col-3">
                  <a href="<?php echo esc_url(get_the_permalink($sender_id)) ?>" target="_blank">
                    <?php echo esc_attr(get_post_meta($sender_id, 'buyer_profile_name', true)); ?>
                    <?php $sender_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($sender_id, 'buyer_profile_attachment', true)), array('50', '50'), false);

                    if (!empty($sender_image)) {
                      echo wp_kses($sender_image, array(
                        "img" => array(
                          "src" => array(),
                          "alt" => array(),
                          "style" => array()
                        )
                      ));
                    } else {
                      echo get_avatar(get_post_field('post_author', $sender_id), 50);
                    } ?>
                  </a>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="chat-list message_receiver">
              <div class="row">
                <div class="col-3">
                  <a href="<?php echo esc_url(get_the_permalink($sender_id)) ?>" target="_blank">
                    <?php $sender_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($sender_id, 'seller_profile_attachment', true)), array('50', '50'), false);

                    if (!empty($sender_image)) {
                      echo wp_kses($sender_image, array(
                        "img" => array(
                          "src" => array(),
                          "alt" => array(),
                          "style" => array()
                        )
                      ));
                    } else {
                      echo get_avatar(get_post_field('post_author', $sender_id), 50);
                    } ?>
                    <?php echo esc_attr(get_post_meta($sender_id, 'seller_profile_name', true)); ?>
                  </a>
                </div>
                <div class="col-9">
                  <p><?php echo esc_html($message->message); ?></p>
                  <?php if ($message->attachment_id) { ?>
                    <a class="download" href="<?php echo esc_url(wp_get_attachment_url($message->attachment_id)); ?>" download><?php echo esc_html__('Download', 'prolancer') ?><i class="fad fa-download"></i></a>
                  <?php } ?>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    <?php
    } else { ?>
      <div class="white-padding mt-4 mb-4">
        <p><?php echo esc_html__('No Message found!', 'prolancer'); ?></p>
      </div>
    <?php } ?>
    <form id="send-project-message-form">
      <textarea name="message" cols="30" rows="10" placeholder="<?php echo esc_attr__('Type your message here...', 'prolancer'); ?>"></textarea>
      <input id="upload-message-attachments" type="file" class="form-control mt-3 mb-4" accept="image/pdf/doc/docx/ppt/pptx*" data-order-id="<?php echo esc_attr($proposal_id) ?>" data-post-id="<?php echo esc_attr($project_id); ?>" data-nonce="<?php echo wp_create_nonce('upload_file_nonce'); ?>">
      <input type="hidden" name="attachment_id" class="attachment-id" value="">
      <a href="#" class="send-project-message prolancer-btn" data-nonce="<?php echo wp_create_nonce('send_project_message_nonce'); ?>" data-proposal-id="<?php echo esc_attr($proposal_id) ?>" data-sender-id="<?php echo esc_attr(get_user_meta(get_current_user_id(), 'buyer_id', true)); ?>" data-receiver-id="<?php echo esc_attr($seller_id); ?>"><?php echo esc_html__('Send message', 'prolancer'); ?></a>
    </form>
  <?php }
} else { ?>
  <div class="white-padding">
    <p class="mb-0"><?php echo esc_html__('No result found!', 'prolancer'); ?></p>
  </div>
<?php } ?>