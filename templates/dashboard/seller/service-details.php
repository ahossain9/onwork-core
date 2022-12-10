<?php if (!empty($_GET['order_id'])) {
  $order_id = $_GET['order_id'];
} ?>


<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__( 'Services Details', 'prolancer' ); ?></h2>
</div>

<div class="white-padding">
  <div class="table-responsive">
    <table class="prolancer-table">
      <thead>
        <tr>
          <th scope="col"><?php echo esc_html__( 'Title' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Delivery time' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Price' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Buyer' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Status' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Action' , 'prolancer'); ?></th>
        </tr>
      </thead>
      <tbody>
      <?php
      if( is_user_logged_in() ){
        // $buyer_id = get_user_meta( get_current_user_id(), 'buyer_id' , true );
        global $wpdb;
        $table ='prolancer_service_orders';
        
        if($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
          $query = "SELECT * FROM ${table} WHERE `id` = ${order_id} ORDER BY timestamp DESC LIMIT 1";
          $result = $wpdb->get_results($query, ARRAY_A)[0];

        }
      }
     
      if ($result){

        $service_id = $result['service_id'];
        $delivery_time_id = $result['delivery_time_id'];
        $buyer_id = $result['buyer_id'];
        $seller_id = $result['seller_id'];
        $service = get_post($service_id); 

        ?>

        <tr>
          <td><a href="<?php echo get_the_permalink($service_id); ?>" target="_blank"><?php echo esc_html( $service->post_title ); ?></a></td>
          <td><?php if (get_term_by( 'id', $delivery_time_id, 'delivery-time' )) {echo esc_html(get_term_by( 'id', $delivery_time_id, 'delivery-time' )->name);} ?></td>
          <td>
            <?php if (function_exists('prolancer_get_currency_symbol')) {
              echo esc_html(prolancer_get_currency_symbol($result['service_price']));
            } ?>
          </td>
          <td>
            <a href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>" target="_blank"><img width="50" src="<?php echo esc_url(get_post_meta($buyer_id, 'buyer_profile_attachment', true)) ; ?>" alt="<?php echo esc_attr(get_post_meta($buyer_id, 'buyer_profile_name', true)) ; ?>"></a>
          </td>
          <td><?php echo esc_html( $result['status'] ); ?></td>
          <td>
            <ul class="list-inline text-center">
              <li class="list-inline-item"><a href="#"><i class="fad fa-check"></i></a></li>
              <li class="list-inline-item"><a href="#" class="cancel_project" data-project-id="<?php echo get_the_ID(); ?>"><i class="fad fa-trash-alt"></i></a></li>
            </ul>
          </td>
        </tr>
        <?php
      }?>

      </tbody>
    </table>
  </div>
</div>

<?php 
global $wpdb;
$table = 'prolancer_service_messages';

if($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
  $query = "SELECT * FROM ${table} WHERE `order_id` = ${order_id}";
  $messages = $wpdb->get_results($query);
  if($messages) { ?>
    <div class="chat-box">
    <?php

    foreach ($messages as $message) {

      $message_sender = get_user_meta( get_current_user_id(), 'seller_id' , true );
      $buyer_id = $message->buyer_id;
      $seller_id = $message->seller_id;

      if ($seller_id == $message_sender) { ?>
      <div class="chat-list">
        <div class="row">
          <div class="col-md-3">
            <a href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>" target="_blank">
              <img width="50" src="<?php echo esc_url(get_post_meta($buyer_id, 'buyer_profile_attachment', true)) ; ?>" alt="<?php echo esc_attr(get_post_meta($buyer_id, 'buyer_profile_name', true)) ; ?>">
              <?php echo esc_attr(get_post_meta($buyer_id, 'buyer_profile_name', true)) ; ?>
            </a>
          </div>
          <div class="col-md-9">
            <p><?php echo esc_html( $message->message ); ?></p>
          </div>
        </div>
      </div>
      <?php } else { ?>
      <div class="chat-list message_sender">
        <div class="row">
          <div class="col-md-9">
            <p><?php echo esc_html( $message->message ); ?></p>
          </div>
          <div class="col-md-3">
            <a href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>" target="_blank">
              <?php echo esc_attr(get_post_meta($buyer_id, 'seller_profile_name', true)) ; ?>
              <img width="50" src="<?php echo esc_url(get_post_meta($buyer_id, 'seller_profile_attachment', true)) ; ?>" alt="<?php echo esc_attr(get_post_meta($buyer_id, 'seller_profile_name', true)) ; ?>">
            </a>
          </div>
        </div>
      </div>
      <?php }
      } ?>
    </div>
  <?php  
    } else {?>
    <div class="white-padding mt-4 mb-4">
      <p><?php echo esc_html__( 'No Message found!','prolancer' ); ?></p>
    </div>
  <?php }
} ?>

<form id="send-service-message-form">
  <textarea name="message" cols="30" rows="10" placeholder="<?php echo esc_attr__( 'Type your message here...','prolancer' ); ?>"></textarea>
  <input id="upload-service-message-attachments" type="file" class="form-control" multiple accept="image/pdf/doc/docx/ppt/pptx*" data-order-id="<?php echo esc_attr($order_id) ?>">
  <input type="hidden" name="attachments" class="attachment-ids" value="">
  <a href="#" class="send-service-message prolancer-btn" data-nonce="<?php echo wp_create_nonce('send_service_message_nonce'); ?>" data-order-id="<?php echo esc_attr($order_id) ?>" data-buyer-id="<?php echo esc_attr( $seller_id ); ?>" data-seller-id="<?php echo esc_attr( $buyer_id ); ?>"><?php echo esc_html__( 'Send message','prolancer' ); ?></a>
</form>